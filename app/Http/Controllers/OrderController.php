<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Color;
use App\Color_product;

class OrderController extends Controller
{
    public function show(Order $order) {

        // reconstitution du panier détaillé
        foreach($order->products as $item){
            $color =  Color::find($item->pivot->color_id);

            $panier[] = [
                "itemName" => $item->name,
                "itemColor" => $color->name,
                "itemPicture" => Color_product::where([['product_id', $item->id],['color_id', $color->id]])->first()->picture,
                "itemPrice" => $item->price,
                "itemQuantity" => $item->pivot->quantity,
            ];
        }

        return view('orders.show', compact('order', 'panier'));
    }
}
