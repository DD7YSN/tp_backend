<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $timestamps = false;

    protected $fillable = ['id_type','nom_magasin','register_commerce','site_web','rank'];

    public function utilisateur(){
        return $this->hasOne(Utilisateur::class, 'id');
    }
    public function type(){
        return $this->belongsTo(Type::class, 'id_type');
    }
    public function rank(){
        return $this->belongsTo(Rank::class, 'rank');
    }

}
