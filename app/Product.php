<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Color;
use App\Deal;
use App\Tax;
use App\Order;

class Product extends Model
{
    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function colors() {
        return $this->belongsToMany('App\Color')->withPivot('stock', 'picture');
    }

    public function orders() {
        return $this->belongsToMany('App\Order')->withPivot('quantity');
    }

    public function priceTtc() {
        return $this->price * 1.2;
    }
}
