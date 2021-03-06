<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::group(['middleware' => ['language']], function() {

    // localisation
    Route::get('/lang/{lang}', function($lang){
        // modification de la langue du système
        if (! in_array($lang, ['en', 'fr'])) {
            abort(400);
        }
        \Session::put('locale',$lang);
        // on reste sur la page
        return redirect()->back();
    })->name('lang');

    // accueil
    Route::get('/', 'WelcomeController@index')->name('home');

    // accès nécissitant authentification (finalisation commande, modification profil, accès backoffice)
    Route::group(['middleware' => ['auth']], function() {
        

    });
    Auth::routes();
});

/*
Route::get('/home', 'HomeController@index')->name('home');
*/