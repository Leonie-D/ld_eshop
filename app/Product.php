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
        return $this->belongsToMany('App\Color')->withPivot('stock');
    }

    public function deal() {
        return $this->belongsTo('App\Deal');
    }

    public function tax() {
        return $this->belongsTo('App\Tax');
    }

    public function orders() {
        return $this->belongsToMany('App\Order');
    }
}
