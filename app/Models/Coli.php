<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coli extends Model
{
    protected $fillable = ['track_number','telephone','adresse','bon_distribution','id_business','marchandise','id_ville','destinataire','ouvrir',
                    'date_creation','bon_ramassage','prix','id_client','pret_preparation','etat',
                    'coli_type','commentaire','id_status'];

    function status(){
        return $this->belongsTo(Status::class, 'id_status');
    }
    function ville(){
        return $this->belongsTo(Ville::class, 'id_ville');
    }
    public function business(){
        return $this->belongsTo(Business::class, 'id_business');
    }
    public function utilisateur(){
        return $this->belongsTo(Utilisateur::class, 'id_client');
    }
    public function bon_ramassage(){
        return $this->belongsTo(Bon_ramassage::class, 'bon_ramassage');
    }
    public function coliStock(){
        return $this->hasMany(Coli_stock::class, 'id_coli');
    }
    public function client(){
        return $this->belongsTo(Client::class, 'id_client');
    }
    public function bon_distribution(){
        return $this->belongsTo(Bon_distribution::class, 'bon_distribution');
    }
    public function bon_envoi(){
        return $this->belongsTo(Bon_envoi::class, 'bon_envoi');
    }
}
