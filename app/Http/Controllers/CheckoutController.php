<?php

namespace App\Http\Controllers;

use App\Notifications\NewOrder;
use App\Notifications\ProductOutOfStock;
use App\User;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Order;
use App\Color_product;
use App\Order_product;
use App\Address;
use App\Mail\MailFromSite;
use Storage;

class CheckoutController extends Controller
{
    public function checkout(Address $deliveryAddress = null) {

        if(\Cart::getContent()->count() === 0) {
            return redirect()->back();
        }

        if($deliveryAddress === null) {
            return view('checkout.index', compact('deliveryAddress'));
        }

        if(isset($deliveryAddress)) {
            $liste = [];
            foreach(auth()->user()->addresses as $address) {
                $liste[] = $address->id;
            }

            if(in_array($deliveryAddress->id, $liste, TRUE)) {
                return view('checkout.index', compact('deliveryAddress'));
            } else {
                return redirect()->back();
            }
        }
    }

    public function store(Request $request, Address $deliveryAddress = null) {
        try {
            Stripe::setApiKey(config('stripe.secret_key'));
            $customer = Customer::create([
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken,
            ]);
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => Round(\Cart::getTotal()*100,0),
                'currency' => 'eur',
            ]);

            $error = null;

            // enregistrer la commande dans la BDD
            $order = new Order;
            $order->user_id = auth()->user()->id;
            $order->step_id = 1;
            $order->subtotal = \Cart::getSubTotal();
            $order->total = \Cart::getTotal();
            if(isset($deliveryAddress)) {
                $order->address_id = $deliveryAddress->id;
            }
            $order->save();

            $panier = \Cart::getContent();
            foreach($panier as $product) {
                $order_product = new Order_product;
                $order_product->order_id = $order->id;
                $order_product->product_id = $product->associatedModel->id;
                $order_product->color_id = $product->attributes['color']->id;
                $order_product->quantity = $product->quantity;
                $order_product->product_price = $product->price; // HT
                $order_product->save();
            }

            // enregistrer les info de payement dans un fichier de log
            Storage::disk('local')->append('stripe/stripe-logs.txt', 'Commande n°'.$order->id.' datant du : '.$order->created_at.PHP_EOL.$charge.PHP_EOL.'------------------------------------------------------------------------'.PHP_EOL);

            // envoyer un mail de confirmation
            $message['order_id'] = $order->id;
            $message['amount'] = $order->total/100;
            $message['subject'] = 'Confirmation de votre commande';
            $message['content'] = \Cart::getContent();

            \Mail::to($customer['email'])->send(new MailFromSite($message));

            // enregistrer les notifications aux admins
            $admins = User::whereAdmin(true)->get();
            foreach($admins as $admin) {
                $admin->notify(new NewOrder($order));
            }

            // modifier les stocks
            foreach($panier as $product) {
                $color_product = Color_product::where([
                    ['product_id', $product->associatedModel->id],
                    ['color_id', $product->attributes['color']->id]
                ])->first();
                $product->associatedModel->colors()->updateExistingPivot($product->attributes['color']->id, ['stock' => $color_product->stock-$product->quantity]);

                // et notifier les chefs de rayon en cas de stocks atteignant 0
                $chefsRayon = User::where('chefRayon', true)->get();
                if($color_product->stock-$product->quantity === 0){
                    foreach($chefsRayon as $chefRayon) {
                        $chefRayon->notify(new ProductOutOfStock($color_product));
                    }
                }
            }

            // vider variable session livraison
            $request->session()->forget('delivery');

            // supprimer le panier
            \Cart::clear();

        } catch (Exception $e) {
            $customer = null;
            $charge = null;
            $error = $e->getMessage();
        }

        return view('checkout.confirmation', compact('error'));
    }
}
