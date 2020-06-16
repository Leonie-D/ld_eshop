<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

// DATA
use App\Category;

class CategoriesComposer {
    public function compose(View $view) {
        $view->with('mCategories', Category::all());
    }
}