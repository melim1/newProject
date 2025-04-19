<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\Notification;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
     // Compte et affiche les notifications non lues
     public function index()
{
    // Récupère l'utilisateur authentifié
    $user = Auth::user();

    // Compter les notifications non lues
    $unreadNotificationsCount = $user->notifications()->whereNull('read_at')->count();

    // Passer la variable à la vue
    return view('layouts.admin', compact('unreadNotificationsCount'));
}

     
     
     



     

    public function markAsRead($id = null)
    {
        if ($id) {
            $notification = auth()->user()->notifications()->findOrFail($id);
            $notification->markAsRead();
        } else {
            auth()->user()->unreadNotifications->markAsRead();
        }
        
        return response()->json(['success' => true]);
    }






public function marquerLue($id)
{
    $notification = auth()->user()->notifications()->findOrFail($id);
    $notification->markAsRead();

    return redirect()->back()->with('success', 'Notification marquée comme lue.');
}








     // Affiche les notifications détaillées avec les rendez-vous associés
     public function notif()
     {
         $notifications = DatabaseNotification::where('type', 'App\Notifications\PouveauRendezVousNotification')
             ->latest()
             ->paginate(10); // Paginer les notifications
 
         // Récupérer les rendez-vous associés à chaque notification
         foreach ($notifications as $notification) {
             $data = $notification->data;
             $rdv = RendezVous::with('user', 'immobilier')
                 ->find($data['rendez_vous_id'] ?? null); // Récupère le rendez-vous lié à la notification
 
             $notification->rdv = $rdv;
         }
 
         return view('layouts.notif', compact('notifications'));
     }
 


    
}