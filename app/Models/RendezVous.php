<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    protected $table = 'rendez_vous'; // Spécifiez le nom de la table manuellement
    
    protected $fillable = [
        'nom_complet',
        'email',
        'telephone',
        'message',
        'user_id',
        'immobilier_id',
        'type', // Ajoutez ce champ
        'statut',
        'date_visite', 
        'heure_visite', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function immobilier()
    {
        return $this->belongsTo(Immobilier::class);
    }


}
