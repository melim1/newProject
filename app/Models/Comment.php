<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;





    protected $fillable = [
        'content', 'user_id', 'immobilier_id',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }



     // Relation avec le bien immobilier
     public function immobilier()
     {
         return $this->belongsTo(Immobilier::class);
     }
     

}
