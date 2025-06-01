<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExerciceRespiration;
use App\Models\Administrer;
use Illuminate\Support\Facades\Auth;

class ExerciceRespirationController extends Controller
{

    public function index()
    {
        $exercices = ExerciceRespiration::select(
            'id_exercice_respiration',
            'nomExercice',
            'duree_inspiration',
            'duree_expiration',
            'duree_apnee',
            'nombre_repetitions'
        )
        ->orderByDesc('id_exercice_respiration')
        ->get();

        return response()->json([
            'exercices' => $exercices
        ]);
    }


    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nomExercice' => 'required|string|max:100',
            'duree_inspiration' => 'required|numeric',
            'duree_expiration' => 'required|numeric',
            'duree_apnee' => 'required|numeric',
            'nombre_repetitions' => 'required|integer|min:1',
        ]);


        // Création de l'exercice
        $exercice = ExerciceRespiration::create($validated);

        // Liaison avec l'utilisateur authentifié
        Administrer::create([
            'id_utilisateur' => Auth::id(),
            'id_exercice_respiration' => $exercice->id_exercice_respiration,
        ]);

        return response()->json([
            'message' => 'Exercice créé et associé avec succès.',
            'exercice' => $exercice
        ], 201);
    }
}
