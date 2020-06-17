<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Order;

class CheckoutController extends Controller
{
    public function checkout() {
        return view('checkout.index');
    }

    public function store(Request $request) {
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
            $error = '';
        } catch (Exception $e) {
            $customer = '';
            $charge = '';
            $error = $e->getMessage();
        }

        // enregistrer la commande dans la BDD
        // $order = new Order;
        // $order->user_id = ;
        // $order->step_id = 0;
        // $order->subtotal =;
        // $order->total =;

        // $order_details = new Order_product;
        // $order_details->order_id = ;
        // $order_details->product_id = ;
        // $order_details->color_id = ;
        // $order_details->quantity = ;
        // $order_details->product_price = ;

        // enregistrer les info de payement dans un fichier de log

        // envoyer un mail de confirmation
        // $message['order_id'] = 434; //pour de faux
        // $message['amount'] = $charge['amount']/100;
        // $message['subject'] = 'Confirmation de votre commande';

        // \Mail::to($customer['email'])->send(new MailFromSite($message));
        
        // supprimer le panier
        // \Cart::session(auth()->user()->id)->clear();

        return view('checkout.confirmation', compact('customer', 'charge', 'error'));
    }
}
