<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public $timestamps = false;

    function client(){
        return $this->hasOne(Client::class, 'id');
    }
    function coli(){
        return $this->hasMany(Coli::class, 'id_business');
    }
    function produit(){
        return $this->hasMany(Produit::class, 'id_business');
    }
}
