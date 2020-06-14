<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Step extends Model
{
    public function orders() {
        return $this->hasMany('App\Order');
    }
}
