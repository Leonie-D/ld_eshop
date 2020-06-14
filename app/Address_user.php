<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address_user extends Model
{
    protected $table = 'address_user'; // préciser le nom de la table dans la BdD
    public $id = false; // pour ne pas utiliser la méthode ->id()
    public $timestamps = false; // pour ne pas utiliser la méthode ->timestamps()
}
