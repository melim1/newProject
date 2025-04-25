<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\User;
 
use Illuminate\Support\Facades\Notification;

 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View; 

use App\Notifications\NouveauRendezVousNotification; // Import de votre notification
use App\Notifications\RendezVousConfirmationNotification; // Si vous créez une notification de confirmation
 
use Illuminate\Support\Facades\Mail;
use App\Mail\RendezVousStatusUpdated; // Assurez-vous que cette classe est également importée
use App\Mail\RendezVousRefused; 
use App\Notifications\RendezVousAccepted;
use App\Notifications\PouveauRendezVousNotification;

class RendezVousController extends Controller
{
   
   
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez être connecté pour prendre un rendez-vous.'
            ], 401);
        }
    
        $user = auth()->user();
    
        $request->validate([
            'immobilier_id' => 'required|exists:immobiliers,id',
            'type' => 'required|in:vente,location',
            'telephone' => [
    'nullable',
    'string',
    'max:20',
    'regex:/^(05|06|07)[0-9]{8}$/'
],
        ]);
    
        try {
            if (empty($user->phone) && $request->filled('telephone')) {
                $user->phone = $request->telephone;
                $user->save();
            }
    
            $dateActuelle = now()->toDateString();
            $heureActuelle = now()->format('H:i');
    
            $rendezVous = RendezVous::create([
                'nom_complet' => $user->name,
                'email' => $user->email,
                'telephone' => $user->phone ?? $request->telephone,
                'message' => $request->message ?? 'Demande de rendez-vous automatique',
                'immobilier_id' => $request->immobilier_id,
                'user_id' => $user->id,
                'type' => $request->type,
                'statut' => 'en attente',
                'date_visite' => $dateActuelle,
                'heure_visite' => $heureActuelle,
            ]);
    
            $admin = User::where('email', 'admin@gmail.com')->first();
            if ($admin) {
                $admin->notify(new PouveauRendezVousNotification($rendezVous));
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Votre demande de rendez-vous a été envoyée avec succès.'
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite: ' . $e->getMessage()
            ], 500);
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
        // Validation des données
        $request->validate([
            'date_visite' => 'nullable|date',
            'heure_visite' => 'nullable',  // Ensures the format is HH:MM
            'statut' => 'nullable|in:en attente,validé,refusé',
        ]);
        
        // Trouver le rendez-vous à mettre à jour
        $rendezVous = RendezVous::findOrFail($id);
    
        // Mettre à jour les informations du rendez-vous
        $rendezVous->update([
            'date_visite' => $request->date_visite,
            'heure_visite' => $request->heure_visite,
            'statut' => $request->statut,
        ]);
    
        // Rediriger l'utilisateur vers une autre page avec un message de succès
        return redirect()->route('rdvs.index')->with('success', 'Rendez-vous mis à jour avec succès');
    }
    
}
