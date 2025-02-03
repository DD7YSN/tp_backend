<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Varainte extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom_varainte','SKU','quantite','id_produit','status','id_responsable'];

    public function produit(){
        return $this->belongsTo(Produit::class, 'id_produit');
    }
    public function utilisateur(){
        return $this->hasOne(Utilisateur::class, 'id_responsable');
    }
}
