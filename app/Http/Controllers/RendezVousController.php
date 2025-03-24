<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View; 
use Illuminate\Support\Facades\Mail;
use App\Mail\RendezVousStatusUpdated; // Assurez-vous que cette classe est également importée
use App\Mail\RendezVousRefused; 
use App\Notifications\RendezVousAccepted;


class RendezVousController extends Controller
{
    public function store(Request $request)
    {
        // Valider les données
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'telephone'   => [
                'required',
                'string',
                'size:10',
                'regex:/^(05|06|07)[0-9]{8}$/'
            ],
            'message'       => 'nullable|string',
            'immobilier_id' => 'required|exists:immobiliers,id',
            'type'          => 'required|in:vente,location',
            // 'statut' est défini par défaut à "en attente"
        ]);
    
        try {
            // Requête SQL brute pour insérer les données dans la table rendez_vous
            DB::insert('
                INSERT INTO rendez_vous (nom_complet, email, telephone, message, immobilier_id, user_id, created_at, updated_at, type, date_visite, heure_visite, statut)
                VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, NULL, NULL, "en attente")
            ', [
                $request->nom_complet,
                $request->email,
                $request->telephone,
                $request->message,
                $request->immobilier_id,
                auth()->id(),
                $request->type,
            ]);
    
            // Si la requête est AJAX, renvoyer du JSON
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Votre demande a été envoyée avec succès.'
                ]);

                
            }
    
            return redirect()->back()->with('success', 'Votre demande de rendez-vous a été envoyée avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer un message d'erreur
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur s\'est produite lors de l\'enregistrement de votre demande.'
                ], 500);
            }
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'enregistrement de votre demande.');
        }
    }





    public function index(Request $request): View
    {
        // Récupérer tous les rendez-vous
        $rendezVous = RendezVous::orderBy('created_at', 'DESC')->paginate(10);

        // Retourner la vue avec les rendez-vous
        return view('layouts.index', compact('rendezVous'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }



    public function update(Request $request, $id)
    {
        // Valider les données
        $request->validate([
            'date_visite' => 'nullable|date',
            'heure_visite' => 'nullable|date_format:H:i',
            'statut' => 'required|in:en attente,validé,refusé',
        ]);
    
        // Récupérer le rendez-vous
        $rendezVous = RendezVous::findOrFail($id);
    
        // Mettre à jour les informations
        $rendezVous->update([
            'date_visite' => $request->date_visite,
            'heure_visite' => $request->heure_visite,
            'statut' => $request->statut,
        ]);
    
        // Si le rendez-vous est validé, envoyer la notification à l'utilisateur
        if ($request->statut === 'validé') {
            // Vous pouvez également envoyer un e-mail ici si besoin
            $rendezVous->user->notify(new \App\Notifications\RendezVousAccepted($rendezVous));
            Mail::to($rendezVous->email)->send(new \App\Mail\RendezVousStatusUpdated($rendezVous));

        } elseif ($request->statut === 'refusé') {
            // Par exemple, envoyer un e-mail de refus
            Mail::to($rendezVous->email)->send(new \App\Mail\RendezVousRefused($rendezVous));
        }
    
        return redirect()->route('rdvs.index')
            ->with('success', 'Le rendez-vous a été mis à jour avec succès.');
    }
    
}
