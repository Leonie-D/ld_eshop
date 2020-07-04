<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Color;
use App\Color_product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // reconstitution du panier détaillé
        foreach($order->products as $item){
            $color =  Color::find($item->pivot->color_id);

            $panier[] = [
                "itemName" => $item->name,
                "itemColor" => $color->name,
                "itemPicture" => Color_product::where([['product_id', $item->id],['color_id', $color->id]])->first()->picture,
                "itemPrice" => $item->priceTtc(),
                "itemQuantity" => $item->pivot->quantity,
            ];
        }

        return view('orders.show', compact('order', 'panier'));
    }

    public function update(Request $request, Order $order)
    {
        if(auth()->user()->admin) {

            // idéalement dans un try and catch...
            $order->step_id = $request->updateStep;

            $order->save();

            // toast
            $request->session()->flash('title', 'Good news');
            $request->session()->flash('message', 'Order status has been updated');

            return redirect()->route('order.index');
        } else {
            return redirect()->back();
        }
    }
}
