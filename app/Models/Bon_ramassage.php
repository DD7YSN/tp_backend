<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bon_ramassage extends Model
{
    protected $fillable = ['id_client','ref_ramassage','date','status','bon_envoi','id_ramasseur','ville_ramassage'];

    public function coli(){
        return $this->hasMany(Coli::class, 'bon_ramassage');
    }
    public function ville(){
        return $this->belongsTo(Ville::class, 'ville_ramassage');
    }
    public function bon_envoi(){
        return $this->belongsTo(Bon_envoi::class, 'bon_envoi');
    }

}
