<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\articleType;
use Illuminate\Http\Request;

class articleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articleTypes = articleType::orderBy('lib_article_type')->get();

        return response()->json([
            'status' => true,
            'message' => 'Liste des types de article récupérée avec succès',
            'data' => $articleTypes
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lib_article_type' => 'required|string|max:100',
            'visible' => 'required|boolean',
        ]);

        $articletype = articleType::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Type de article ajouté avec succès',
            'data' => $articletype
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(articleType $articletype)
    {
        return response()->json([
            'status' => true,
            'message' => 'Type de article trouvé avec succès',
            'data' => $articletype
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, articleType $articleType)
    {
        $validated = $request->validate([
            'lib_article_type' => 'required|string|max:100',
            'visible' => 'required|boolean',
        ]);

        $articleType->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Type de article modifié avec succès',
            'data' => $articleType
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(articleType $articleType)
    {
        $articleType->delete();

        return response()->json([
            'status' => true,
            'message' => 'Type de article supprimé avec succès'
        ], 200);
    }
}
