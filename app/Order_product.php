<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{
    protected $table = 'order_product'; // préciser le nom de la table dans la BdD
    public $id = false; // pour ne pas utiliser la méthode ->id()
    public $timestamps = false; // pour ne pas utiliser la méthode ->timestamps()
}
