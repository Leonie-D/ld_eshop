<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class WelcomeController extends Controller
{
    public function index() {
        $someProducts = Product::latest()->take(3)->get();

        return view('index', compact('someProducts'));
    }
}
