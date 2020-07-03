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
        return view('users.index');
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
        if($user == auth()->user() || auth()->user()->admin) {
            return view('users.show', compact('user'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user == auth()->user() || auth()->user()->admin) {
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
        if($user->id == auth()->user()->id || auth()->user()->admin) {

            // idéalement dans un try and catch...
            $user->name = $request->name;
            $user->firstname = $request->firstname;
            $user->email = $request->email;
            if(isset($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

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
    public function destroy(User $user)
    {
        if(auth()->user()->admin) {
            dd($user);
            //on conserve ses commandes mais on supprime ses adresses
            // suppression discutable des clients mais pour l'exo ok !
            foreach($user->addresses as $address){

                Address_user::where([
                    ['address_id', $address->id],
                    ['user_id', $user->id]
                ])->delete();

                $address->delete();

            }

            $user->delete();

            return redirect()->route('backoffice');

        } else {
            return redirect()->back();
        }
    }
}
