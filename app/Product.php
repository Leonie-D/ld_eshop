<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Color;
use App\Deal;
use App\Taxe;
use App\Order;

class Product extends Model
{
    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function color() {
        return $this->belongsTo('App\Color');
    }

    public function deal() {
        return $this->belongsTo('App\Deal');
    }

    public function taxe() {
        return $this->belongsTo('App\Taxe');
    }

    public function orders() {
        return $this->belongsToMany('App\Order');
    }
}
