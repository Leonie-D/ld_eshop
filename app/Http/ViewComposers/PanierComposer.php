<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class PanierComposer {
    public function compose(View $view) {
        $view->with('mPanier', \Cart::getContent());
    }
}