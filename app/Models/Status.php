<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['nom_status','color'];

    public function coli(){
        return $this->hasMany(Coli::class, 'id');
    }
}
