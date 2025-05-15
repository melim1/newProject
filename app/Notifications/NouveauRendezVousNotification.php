<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NouveauRendezVousNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $rendezVousId;

    public function __construct($rendezVousId)
    {
        $this->rendezVousId = $rendezVousId;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Notification par email et dans la base de données
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nouvelle demande de rendez-vous')
                    ->line('Une nouvelle demande de rendez-vous a été soumise.')
                    ->action('Voir le rendez-vous', url('/rdvs/'.$this->rendezVousId))
                    ->line('Merci d\'utiliser notre application!');
    }

    public function toArray($notifiable)
    {
        return [
            'rendez_vous_id' => $this->rendezVousId,
            'message' => 'Nouvelle demande de rendez-vous reçue de ' . $this->rendezVous->nom_complet,
            'link' => '/rdvs'.$this->rendezVousId,

            'user_id' => $this->rendezVous->user_id,
            'nom_complet' => $this->rendezVous->nom_complet,
            'email' => $this->rendezVous->email,
            'immobilier_id' => $this->rendezVous->immobilier_id,
            'type' => $this->rendezVous->type,
            'immobilier_photo' => $this->rendezVous->immobilier->user_image, // Récupérer l'URL de la photo

     
        ];
    }
}

