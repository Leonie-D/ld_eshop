<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color_product extends Model
{
    protected $table = 'color_product'; // préciser le nom de la table dans la BdD
    public $id = false; // pour ne pas utiliser la méthode ->id()
    public $timestamps = false; // pour ne pas utiliser la méthode ->timestamps()
}
