<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Address_user;

class AddressController extends Controller
{
    public function select(Request $request, $userId) { // ici prévoir une validation des données du formulaire
       
        // si nouvelle adresse on la crée et sauvegarde en base
        if($request->address === 'new') {
            $address = new Address;
            $address->number = $request->number;
            $address->road_name = $request->roadName;
            $address->postal_code = $request->zip;
            $address->city = $request->city;

            $address->save();

            $address_user = new Address_user;
            $address_user->name = $request->name;
            $address_user->address_id = $address->id;
            $address_user->user_id = $userId;

            $address_user->save();

            // dans tous les cas, on renvoi l'adresse retenue à la page pour le futur stockage en base de la commande
            $deliveryAddress = $address;
        } else {
            $deliveryAddress = Address::findOrFail($request->address);
        }

        return view('checkout.index', compact('deliveryAddress'));
    }
}
