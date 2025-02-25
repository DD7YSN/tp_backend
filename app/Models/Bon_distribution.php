<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bon_distribution extends Model
{
    protected $fillable = ['id_livreur','id_status','bon_payement','bon_ramassage','date','relancer','jutification_de_relancer'];
    
    public function coli(){
        return $this->hasMany(Coli::class, 'bon_distribution');
    }

    public function zones()
    {
    return $this->hasManyThrough(
        Zone::class, 
        Ville::class,
        'id_ville',        
        'id_zone',        
        'id',        
        'zone'       
    );
    }
    public function livreur(){
        return $this->belongsTo(Utilisateur::class, 'id_livreur');
    }

}
