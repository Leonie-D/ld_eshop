<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Address_user;
use App\User;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $userId)
    {
        $address = new Address;
        $address->number = $request->number;
        $address->road_name = $request->roadName;
        $address->postal_code = $request->zip;
        $address->city = $request->city;

        $address->save();

        $address_user = new Address_user;
        if(isset($request->name)){
            $address_user->name = $request->name;
        }
        $address_user->address_id = $address->id;
        $address_user->user_id = $userId;

        $address_user->save();

        return $address;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $userId, Address $address)
    {
        $addressName = Address_user::where([
            ['user_id', '=', $userId],
            ['address_id', '=', $address->id]
        ])->value('name');
        
        return view('addresses.edit', compact('address', 'addressName', 'userId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $userId, Address $address)
    {
        
        if( auth()->user()->id === $userId || auth()->user()->admin) {

            if(isset($request->number) && isset($request->roadName) && isset($request->zip) && isset($request->city)) {
                $address->number = $request->number;
                $address->road_name = $request->roadName;
                $address->postal_code = $request->zip;
                $address->city = $request->city;

                $address->save();

                if(isset($request->addressName)){
                    $address_user = Address_user::where([
                        ['user_id', '=', $userId], // non, pb si c'est l'admin qui modifie...
                        ['address_id', '=', $address->id]
                    ])->first();
                    $address_user->name = $request->addressName;
                }

                $address_user->save();
            }

            // toast
            $request->session()->flash('title', 'Good news');
            $request->session()->flash('message', 'Your address has been updated');

            return redirect()->route('user.show', ['user' => $userId]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $userId, Address $address)
    {
        // théoriquement, suffisant de supprimer uniquement l'association user/address car l'address en tant que telle peut être utilisée par un autre utilisateur (pas dans mon cas... car je crée une nouvelle address même si identique à une déjà en base...)
        Address_user::where([
            ['address_id', '=', $address->id],
            ['user_id', $userId]
            ])->delete();
        return redirect()->route('user.edit', ['user' => User::find($userId)]);
    }

    public function select(Request $request, int $userId) { // ici prévoir une validation des données du formulaire
       
        // si nouvelle adresse on la crée et sauvegarde en base
        if($request->address === 'new') {
            // $address = new Address;
            // $address->number = $request->number;
            // $address->road_name = $request->roadName;
            // $address->postal_code = $request->zip;
            // $address->city = $request->city;

            // $address->save();

            // $address_user = new Address_user;
            // $address_user->name = $request->name;
            // $address_user->address_id = $address->id;
            // $address_user->user_id = $userId;

            // $address_user->save();

            // dans tous les cas, on renvoi l'adresse retenue à la page pour le futur stockage en base de la commande
            $deliveryAddress = store($userId);
        } else {
            $deliveryAddress = Address::findOrFail($request->address);
        }

        return view('checkout.index', compact('deliveryAddress'));
    }
}
