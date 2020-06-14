<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;
use App\Color;
use App\Step;

class Order extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function step() {
        return $this->belongsTo('App\Step');
    }

    public function products() {
        return $this->belongsToMany('App\Product');
    }

    public function colors() {
        return $this->belongsToMany('App\Color');
    }
}
