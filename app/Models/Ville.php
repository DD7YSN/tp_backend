<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $fillable = ['nom_ville', 'id_zone', 'ref', 'frais_livraison', 'frais_retour', 'frais_refus'];
    public function utilisateur(){
        return $this->hasMany(Utilisateur::class, 'id');
    }
    public function coli(){
        return $this->hasOne(Coli::class, 'id');
    }
    public function zone(){
        return $this->belongsTo(Zone::class, 'id_zone');
    }
}
