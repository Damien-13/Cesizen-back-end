<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\articlePartage;
use App\Models\User;
use Illuminate\Http\Request;

class articlePartageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = articlePartage::with(['destinataire', 'article'])
            ->join('users', 'article_partages.user_id', '=', 'users.id')
            ->where('users.actif', 1)
            ->orderBy('users.nom')
            ->orderBy('users.prenom')
            ->orderBy('users.email')
            ->select('article_partages.*');

        if ($request->has('article_id')) {
            $query->where('article_id', $request->query('article_id'));
        }

        $articlePartages = $query->get();

        return response()->json([
            'status' => true,
            'message' => 'Liste des articles récupérée avec succès',
            'data' => $articlePartages
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'email_destinataire' => 'required|email|exists:users,email',
        ]);

        //Vérifie si utilisateur existe
        $user = User::where('email', $validated['email_destinataire'])
            ->where('actif', 1)
            ->first();
            
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Aucun utilisateur trouvé avec cet email.',
            ], 404);
        }

        $articlePartage = articlePartage::create([
            'article_id' => $validated['article_id'],
            'user_id' => $user->id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Partage de ressouce ajouté avec succès',
            'data' => $articlePartage
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(articlePartage $articlePartage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, articlePartage $articlePartage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(articlePartage $articlePartage)
    {
        $articlePartage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Partage de article supprimé avec succès'
        ], 200);
    }
}
