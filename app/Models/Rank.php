<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom_rank'];
}
