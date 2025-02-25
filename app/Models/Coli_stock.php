<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coli_stock extends Model
{
    protected $fillable = ['id_coli','SKU','quantite'];

    public function coli()
    {
        return $this->belongsTo(Coli::class, 'id_coli');
    }

    public function bonDistribution()
    {
        return $this->belongsTo(Bon_distribution::class, 'bon_distribution');
    }
}
