<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Color;

class PanierController extends Controller
{
    public function index(){
        $panier = \Cart::getContent();

        return view('panier.index', compact('panier'));
    }

    public function add(Product $product, Color $color){
        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array('color' => $color),
            'associatedModel' => $product,
        ]);

        // on peut mettre un message précisant que le produit a été mis au panier et rester sur cette page
        return redirect()->back();
    }

    public function remove(Product $product, Color $color){
        
    }

    public function update(Product $product, Color $color, string $method){
        // tester que $method vaut + ou -, rien d'autre
    }
}
