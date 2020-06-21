<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Order;

class Address extends Model
{
    public function users() {
        return $this->belongsToMany('App\User')->withPivot('name');
    }

    public function orders() {
        return $this->belongsToMany('App\Order');
    }
}
