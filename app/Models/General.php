<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    protected $fillable=['nom','id_monnie','telephone_a','telephone_b','fix','email',
                'site_lien','lien_admin','lien_client','zone_principal','adresse'];
    public function zone()  {
        return $this->belongsTo(Zone::class, 'zone_principal');
    }
    public function monnie()  {
        return $this->belongsTo(Monnie::class, 'id_monnie');
    }
}
