<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrer extends Model
{
    protected $table = 'administrer';

    public $incrementing = false; // Pas de clé auto-incrémentée
    public $timestamps = false; // Pas de colonnes created_at/updated_at

    protected $primaryKey = null; // Clé composite → on ne définit pas de clé primaire unique

    protected $fillable = [
        'id_utilisateur',
        'id_exercice_respiration',
    ];

    // Relations utiles
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function exercice()
    {
        return $this->belongsTo(ExerciceRespiration::class, 'id_exercice_respiration');
    }
}
