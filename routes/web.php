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

    // routes liés aux produits // ATTENTION : certaines méthodes accessibles uniquement pour admin et/ou chef de rayon
    Route::resource('/product', 'ProductController');

    // routes liés aux catégories // ATTENTION : certaines méthodes accessibles uniquement pour admin et/ou chef de rayon
    Route::resource('/category', 'CategoryController');

    // routes liées au panier
    Route::prefix('panier')->group(function(){
        Route::get('', 'PanierController@index')->name('panier.index');
        Route::get('/add/{product}/{color}', 'PanierController@add')->name('panier.add');
        Route::get('/remove/{productId}', 'PanierController@remove')->name('panier.remove');
        Route::get('/update/{productId}/{method}', 'PanierController@update')->name('panier.update');
        Route::post('/confirm', 'PanierController@confirm')->name('panier.confirm');
        Route::get('/authenticate', 'PanierController@authenticate')->name('panier.authenticate');
    });

    // accès nécissitant authentification (finalisation commande, modification profil, accès backoffice)
    Route::group(['middleware' => ['auth']], function() {
        // Visualisation et édition de profil
        // ATTENTION : certaines méthodes accessibles uniquement pour admin
        Route::resource('/user', 'UserController')->except(['create']);
        Route::resource('/{user}/address', 'AddressController')->except(['index, create, show']);
        Route::get('/order/{order}', 'OrderController@show')->name('order.show');

        // payement
        Route::get('/chekout', 'CheckoutController@checkout')->name('checkout');
        Route::post('/chekout/store/{deliveryAddress?}', 'CheckoutController@store')->name('checkout.store');
        Route::post('/{user}/address', 'AddressController@select')->name('address.select');

    });
    Auth::routes();
});

/*
Route::get('/home', 'HomeController@index')->name('home');
*/