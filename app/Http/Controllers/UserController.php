<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;
use App\Address_user;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user == auth()->user() || $user->admin) {
            return view('users.edit', compact('user'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($user->id == auth()->user()->id || $user->admin) {

            // idéalement dans un try and catch...
            $user->name = $request->name;
            $user->firstname = $request->firstname;
            $user->email = $request->email;
            if(isset($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            if(isset($request->number) && isset($request->roadName) && isset($request->zip) && isset($request->city)) {
                $address = new Address;
                $address->number = $request->number;
                $address->road_name = $request->roadName;
                $address->postal_code = $request->zip;
                $address->city = $request->city;

                $address->save();

                $address_user = new Address_user;
                if(isset($request->addressName)){
                    $address_user->name = $request->addressName;
                }
                $address_user->address_id = $address->id;
                $address_user->user_id = $user->id;

                $address_user->save();
            }

            // toast
            $request->session()->flash('title', 'Good news');
            $request->session()->flash('message', 'Your profil has been updated');

            return redirect()->route('user.show', compact('user'));
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
    public function destroy($id)
    {
        // admin seulement ?
    }
}
