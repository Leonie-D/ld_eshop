<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Color;
use App\Color_product;
use App\Http\Requests\StockFormRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
    public function show(Product $product)
    {
        $previousProduct = Product::where('id', '<', $product->id)->orderBy('id', 'desc')->first();
        if ($previousProduct === null) {
            $previousProduct = Product::orderBy('id', 'desc')->first();
        }

        $nextProduct = Product::where('id', '>', $product->id)->orderBy('id', 'asc')->first();
        if ($nextProduct === null) {
            $nextProduct = Product::orderBy('id', 'asc')->first();
        }

        return view('products.show', compact('product', 'previousProduct', 'nextProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if(auth()->user()->chefRayon) {
            return view('products.edit', compact('product'));
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
    public function update(StockFormRequest $request, Product $product, Color $color)
    {
        if(auth()->user()->chefRayon) {
            $color_product = Color_product::where([
                ['product_id', $product->id],
                ['color_id', $color->id]
            ])->first();
            $product->colors()->updateExistingPivot($color->id, ['stock' => $color_product->stock + $request->stock]);

            // toast
            $request->session()->flash('title', 'Good news');
            $request->session()->flash('message', 'Stock has been updated');

            return redirect()->route('product.edit', compact('product'));
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
        //
    }
}
