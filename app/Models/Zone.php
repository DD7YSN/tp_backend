<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = ['nom_zone'];
    public function ville(){
        return $this->hasMany(Ville::class, 'id_zone');
    }
}
