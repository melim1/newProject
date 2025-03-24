<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NouvelleDemandeRendezVous extends Notification
{
    use Queueable;

    protected $rendezVous;

    public function __construct($rendezVous)
    {
        $this->rendezVous = $rendezVous;
    }

    public function via($notifiable)
    {
        return ['database']; // Stocker la notification en base de données
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Une nouvelle demande de rendez-vous a été reçue.',
            'rendezvous_id' => $this->rendezVous->id,
            'user_name' => $this->rendezVous->user->name,
        ];
           
    }
}