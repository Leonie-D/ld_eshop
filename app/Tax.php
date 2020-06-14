<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Order;

class Tax extends Model
{
    public $timestamps = false;
    
    public function products() {
        return $this->hasMany('App\Product');
    }
}
