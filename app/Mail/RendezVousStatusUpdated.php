<?php

namespace App\Mail;

use App\Models\RendezVous;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RendezVousStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $rendezVous; // Cette variable est publique et accessible dans la vue

    /**
     * Créer une nouvelle instance.
     *
     * @param  \App\Models\RendezVous  $rendezVous
     * @return void
     */
    public function __construct(RendezVous $rendezVous)
    {
        $this->rendezVous = $rendezVous;
    }

    /**
     * Construire le message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Votre rendez-vous a été validé')
            ->view('emails.rendezvous_accepte');
    }
}