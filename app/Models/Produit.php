<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Business;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{

    protected $fillable = ['nom_produit','SKU','quantite','note','status','id_client','id_business','status','id_responsable'];

    public function client(){
        return $this->hasOne(Client::class, 'id_client');
    }
    public function business(){
        return $this->belongsTo(Business::class, 'id_business');
    }
    public function varainte(){
        return $this->hasMany(Varainte::class, 'id_produit');
    }
}
