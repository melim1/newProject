<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\RendezVous;

class RendezVousRefused extends Mailable
{
    use Queueable, SerializesModels;

    public $rendezVous; // Déclarer la variable publique

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\RendezVous  $rendezVous
     * @return void
     */
    public function __construct(RendezVous $rendezVous)
    {
        $this->rendezVous = $rendezVous; // Passer l'objet RendezVous
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Votre demande de rendez-vous a été refusée')
            ->view('emails.rendezvous_refused'); // Vue de l'e-mail de refus
    }
}