<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\RendezVous;

class PouveauRendezVousNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $rendezVous;

    public function __construct(RendezVous $rendezVous)
    {
        $this->rendezVous = $rendezVous;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle demande de rendez-vous')
            ->line('Une nouvelle demande de rendez-vous a été soumise.')
            ->line('Nom: ' . $this->rendezVous->nom_complet)
            ->line('Email: ' . $this->rendezVous->email)
            ->line('Téléphone: ' . $this->rendezVous->telephone)
            ;
    }

  
    public function toArray($notifiable)
    {
        return [
            'rendez_vous_id' => $this->rendezVous->id,
            'message' => 'Nouvelle demande de rendez-vous de ' . $this->rendezVous->nom_complet,
            'link' => '/admin/rendez-vous/' . $this->rendezVous->id,
            'user_id' => $this->rendezVous->user_id,
            'nom_complet' => $this->rendezVous->nom_complet,
            'email' => $this->rendezVous->email,
            'immobilier_id' => $this->rendezVous->immobilier_id,
            'type' => $this->rendezVous->type,
            'immobilier_photo' => $this->rendezVous->immobilier->user_image, // Récupérer l'URL de la photo

        ];
    }
    
    
}