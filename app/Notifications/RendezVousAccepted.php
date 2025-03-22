<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RendezVousAccepted extends Notification
{
    use Queueable;

    protected $rdv;

    public function __construct($rdv)
    {
        $this->rdv = $rdv;
    }

    // On utilise uniquement la notification "database"
    public function via($notifiable)
    {
        return ['database'];
    }

  public function toDatabase($notifiable)
{
    $prefix = $this->rdv->type === 'vente' ? 'vente' : 'location';
    return [
        'rdv_id'  => $this->rdv->id,
        'message' => 'Votre demande de rendez-vous pour la maison située à ' . $this->rdv->immobilier->adresse . ' a été validée.',
        'url'     => route('app_historique', ['rdv_type' => $prefix, 'rdv' => $this->rdv->id]),
    ];
}
}
