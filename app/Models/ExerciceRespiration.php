<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciceRespiration extends Model
{
    use HasFactory;

    // Spécifie le nom exact de la table
    protected $table = 'exercice_respiration';

    // Spécifie la clé primaire si elle a un nom spécifique
    protected $primaryKey = 'id';

    // Si la clé primaire est auto-incrémentée
    public $incrementing = true;

    // Pas de timestamps sur cette table
    public $timestamps = false;


    // Type de la clé primaire
    protected $keyType = 'int';

    // Champs pouvant être remplis en masse
    protected $fillable = [
        'nomExercice',
        'duree_inspiration',
        'duree_expiration',
        'duree_apnee',
        'nombre_repetitions',
    ];
}
