<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Order;

class Deal extends Model
{
    public function products() {
        return $this->hasMany('App\Product');
    }
}
