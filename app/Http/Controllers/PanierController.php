<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Color;

class PanierController extends Controller
{
    public function index(){
        $collection = \Cart::getContent();

        // CONDITION TVA
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'TVA 20%',
            'type' => 'tax',
            'target' => 'total', // this condition will be applied to cart's total when getTotal() is called.
            'value' => '20%',
        ));
        \Cart::condition($condition);

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
        
        \Cart::add([
            'id' => $product->id.'-'.$color->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array('color' => $color, 'order' => $order),
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
        if(isset($request->delivery) && \Cart::getContent()->count() > 0) { // le panier n'est pas vide et le choix de la livraison a bien été fait

            session()->put('delivery', $request->delivery); // pour y accéder facilement quel que soit le chemin emprunté par l'utilisateur entre le panier et le payement

            // Set url for redirection after login or register
            session()->put('url.intended', route('checkout'));

            if(auth()->check()) { // deja authentifié, on passe à la suite
                return redirect()->route('checkout');
            } else { // pas encore authentifié, direction page dédiée à login ou register
                return redirect()->route('panier.authenticate');
            }

        } else {
            return redirect()->back();
        }
    }

    public function authenticate() {
        return view('panier.authenticate');
    }
}
