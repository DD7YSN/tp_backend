<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{

    protected $fillable = ['nom','cin','telephone','email','password','local','adresse','id_banque','numero_compte','id_role','status'];

    function client(){
        return $this->hasOne(Client::class, 'id_utilisateur');
    }
    function banque(){
        return $this->belongsTo(Banque::class, 'id_banque');
    }
    function ville(){
        return $this->belongsTo(Ville::class, 'local');
    }
    function role(){
        return $this->belongsTo(Role::class, 'id_role');
    }
}
