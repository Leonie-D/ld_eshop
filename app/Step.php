<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Step extends Model
{
    public $timestamps = false;
    
    public function orders() {
        return $this->hasMany('App\Order');
    }
}
