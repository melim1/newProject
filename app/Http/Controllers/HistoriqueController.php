<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RendezVous;

class HistoriqueController extends Controller
{
    /**
     * Affiche le profil de l'utilisateur et ses demandes de rendez-vous avec
     * les informations complètes du bien immobilier associé.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        // Récupérer toutes les demandes de rendez-vous de l'utilisateur avec le bien associé
        $demandes = RendezVous::where('user_id', $user->id)
            ->with('immobilier')  // Charge la relation pour récupérer toutes les infos du bien
            ->get();

        // Séparer les demandes par type si nécessaire
        $demandesVente = $demandes->where('type', 'vente');
        $demandesLocation = $demandes->where('type', 'location');

        return view('accueil.historique', [
            'user'              => $user,
            'demandesVente'     => $demandesVente,
            'demandesLocation'  => $demandesLocation,
        ]);
    }
}
