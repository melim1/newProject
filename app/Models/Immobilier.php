<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Immobilier extends Model
{
    use HasFactory;

    protected $fillable = ['adresse', 'type', 'prix', 'surface', 'user_image', 'description', 'photos','user_id', 'caracteristiques_souhaitees'];




    // Relation avec les commentaires
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
    
}