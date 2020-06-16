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

    public function add(Request $request, Product $product, Color $color){
        
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
        $request->session()->flash('title', 'Good news');
        $request->session()->flash('message', 'Selected product has been added to your cart');
        return redirect()->back();
    }

    public function remove($productId){
        if(\Cart::getContent()->count() > 0) { // on ne peut utiliser cette méthode que sur un panier existant

            // un try and catch ici serait bien pour le cas ou le productId n'est pas dans le panier...
            \Cart::remove($productId);
            return redirect()->route('panier.index');

        } else {

            return redirect()->back();

        }
    }

    public function update($productId, string $method){

        if(\Cart::getContent()->count() > 0) { // on ne peut utiliser cette méthode que sur un panier existant

            // un try and catch ici serait bien pour le cas ou le productId n'est pas dans le panier ou si une string autre que _ ou + est saisie
            if($method === '-'){
                $quantity = -1;
            } elseif($method === '+') {
                $quantity = +1;
            } 

            \Cart::update($productId, array(
                'quantity' => $quantity,
            ));

            return redirect()->route('panier.index');

        } else {

            return redirect()->back();

        }

    }

    public function confirm(Request $request){
        if(\Cart::getContent()->count() > 0) {
            return view('panier.confirm', ['delivery' => $request->delivery]);
        } else {
            return redirect()->back();
        }
    }
}
