<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Address extends Model
{
    public function users() {
        return $this->belongsToMany('App\User');
    }
}
