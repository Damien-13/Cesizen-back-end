<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\article;
use App\Models\articlePartage;
use App\Models\User;
use Illuminate\Http\Request;

class articleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = article::with(['user', 'articleType', 'articleCategorie', 'relationType'])
            ->orderBy('created_at', 'desc');

        // Filtre optionnel : "valide"
        if ($request->has('valide')) {
            $valide = filter_var($request->query('valide'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if ($valide !== null) {
                $query->where('valide', $valide);
            }
        }

        if ($request->has('catalogue')) {
            $userId = (int) ($request->query('user_id') ?? 0);
            $isAdmin = false;
            if ($userId === 0) {
                // user_id = 0 = uniquement les restreintes
                $query->where('restreint', false);
            } else {
                // Vérifier le rôle de l'utilisateur
                $user = User::find($userId);
                $isAdmin = $user && in_array($user->role_id, [1, 2]);

                if ($isAdmin) {
                    // aucun filtre
                } else {
                    // Utilisateur = publiques + personnelles + partagées
                    $articlesPartageesIds = articlePartage::where('user_id', $userId)
                        ->pluck('article_id');

                    $query->where(function ($q) use ($userId, $ressourcesPartageesIds) {
                        $q->where('restreint', false)
                            ->orWhere('user_id', $userId)
                            ->orWhereIn('id', $ressourcesPartageesIds);
                    });
                }
            }
        }

        $articles = $query->get();

        return response()->json([
            'status' => true,
            'message' => 'Liste des articles récupérée avec succès',
            'data' => $ressources
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'nom_fichier' => 'nullable|string|max:255',
            'restreint' => 'required|boolean',
            'url' => 'nullable|string|max:255',
            'valide' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
            'article_categorie_id' => 'required|exists:article_categories,id',
            'article_type_id' => 'required|exists:article_types,id',
            'relation_type_id' => 'required|exists:relation_types,id'
        ]);

        $article = article::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'article ajoutée avec succès',
            'data' => $article
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(article $article)
    {
        $article->load(['user', 'articleType', 'articleCategorie', 'relationType']);

        return response()->json([
            'status' => true,
            'message' => 'article trouvée avec succès',
            'data' => $article
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, article $article)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'nom_fichier' => 'nullable|string|max:255',
            'restreint' => 'required|boolean',
            'url' => 'nullable|string|max:255',
            'valide' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
            'article_categorie_id' => 'required|exists:article_categories,id',
            'article_type_id' => 'required|exists:article_types,id',
            'relation_type_id' => 'required|exists:relation_types,id'
        ]);

        $article->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'article modifiée avec succès',
            'data' => $article
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(article $article)
    {
        $article->delete();

        return response()->json([
            'status' => true,
            'message' => 'article supprimée avec succès'
        ], 200);
    }
}
