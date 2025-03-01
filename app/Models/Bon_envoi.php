<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bon_envoi extends Model
{
    public function zoneTable(){
        return $this->belongsTo(Zone::class, 'zone');
    }
    public function livreur(){
        return $this->hasOne(Utilisateur::class, 'bon_livraison');
    }
    public function bon_ramassage(){
        return $this->hasMany(Bon_ramassage::class, 'bon_envoi');
    }
}
