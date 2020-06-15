<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Color;

class PanierController extends Controller
{
    public function index(){
        $collection = \Cart::getContent();

        if($collection->count()>0) {

            // fixer l'ordre des produits à l'affichage du panier
            $panier = $collection->sortBy(function($product, $key){
                return $product->attributes['order'];
            });

            return view('panier.index', compact('panier'));

        } elseif(url()->previous() != route('panier.index')) { 

            // si on essaye d'accéder au panier alors qu'il est vide, on reste sur notre page
            return redirect()->back();

        } else {

            // si on vide le panier, on revient à l'accueil
            return redirect()->route('home');

        }
    }

    public function add(Product $product, Color $color){

        // récupérer la 'place' du dernier article ajouté pour l'incrémenter pour l'ajout en cours
        // permet de fixer l'ordre des produits à l'affichage du panier
        $panier = \Cart::getContent();
        foreach($panier as $item) {
            $arr[] = $item->attributes['order'];
        }
        if(isset($arr)){
            $order = max($arr) + 1;
        } else {
            $order = 1;
        }

        // create condition instance
        $tvaTax = new \Darryldecode\Cart\CartCondition(array(
            'name' => $product->tax->name,
            'type' => 'tax',
            'value' => '+'.($product->tax->value * 100).'%',
            'target' => 'total',
        ));
        
        \Cart::add([
            'id' => $product->id.'-'.$color->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array('color' => $color, 'order' => $order),
            'conditions' => $tvaTax,
            'associatedModel' => $product,
        ]);

        // afficher message précisant que le produit a été mis au panier et rester sur cette page
        $request->session()->flash('message', 'Votre produit a bien été ajouté au panier');
        return redirect()->back();
    }

    public function remove($productId){
        \Cart::remove($productId);

        return redirect()->route('panier.index');
    }

    public function update($productId, string $method){
        if($method === '-'){
            $quantity = -1;
        } elseif($method === '+') {
            $quantity = +1;
        }

        \Cart::update($productId, array(
            'quantity' => $quantity,
        ));

        return redirect()->route('panier.index');
    }
}
