<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Order;

class Color extends Model
{
    public $timestamps = false;
    
    public function products() {
        return $this->hasMany('App\Product');
    }

    public function orders() {
        return $this->hasMany('App\Order');
    }
}
