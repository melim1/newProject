<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Immobilier;

class CommentController extends Controller
{
    // Afficher les commentaires pour un bien immobilier
    public function show($id)
    {
        $immobilier = Immobilier::with('comments.user')->findOrFail($id);
        return view('accueil.vente.detail', compact('immobilier'));
    }

    // Ajouter un commentaire
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'immobilier_id' => 'required|exists:immobiliers,id',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth()->id(); // ID de l'utilisateur connecté
        $comment->immobilier_id = $request->input('immobilier_id'); // ID du bien immobilier
        $comment->save();

        return redirect()->back()->with('success', 'Commentaire ajouté avec succès !');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
    
        $comment = Comment::findOrFail($id);
    
        // Vérifier que l'utilisateur est bien l'auteur du commentaire
        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }
    
        $comment->content = $request->input('content');
        $comment->save();
    
        return redirect()->back()->with('success', 'Commentaire modifié avec succès !');
    }
    
    public function destroy($id)
    {

          $comment = Comment::find($id);
            // Vérifier que l'utilisateur est bien l'auteur du commentaire
        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }
    
            if ($comment) {
                $comment->delete();
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false], 404);
        
    }


}