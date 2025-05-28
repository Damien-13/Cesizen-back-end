<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\articleCategorie;
use Illuminate\Http\Request;

class articleCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = articleCategorie::orderBy('lib_article_categorie');

        //Paramètres optionnels
        if ($request->has('visible')) {
            $visible = filter_var($request->query('visible'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE); //CAST en booléen
            if ($visible !== null) {
                $query->where('visible', $visible);
            }
        }

        $articleCategories = $query->get();

        return response()->json([
            'status' => true,
            'message' => 'Liste des catégories de article récupérée avec succès',
            'data' => $articleCategories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lib_article_categorie' => 'required|string|max:50',
            'visible' => 'required|boolean',
        ]);

        $articleCategorie = articleCategorie::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Catégorie de article ajoutée avec succès',
            'data' => $articleCategorie
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(articleCategorie $articleCategorie)
    {
        return response()->json([
            'status' => true,
            'message' => 'Catégorie de article trouvée avec succès',
            'data' => $articleCategorie
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $articleCategorie = articleCategorie::find($id);

        if ($articleCategorie) {
            // Validation des données
            $validated = $request->validate([
                'lib_article_categorie' => 'required|string|max:100',
                'visible' => 'required|boolean',
            ]);

            // Mise à jour de la article
            $articleCategorie->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Catégorie de article modifiée avec succès',
                'data' => $articleCategorie
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Vérifier si article utilise cette catégorie
        $articleCategorie = articleCategorie::find($id);
        if ($articleCategorie) {
            if ($articleCategorie->articles()->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cette catégorie ne peut être supprimée : elle est utilisée par une article.'
                ], 400);
            } else {
                $articleCategorie->delete();
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Catégorie de article supprimée avec succès'
        ], 200);
    }
}
