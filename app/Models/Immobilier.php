<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Immobilier extends Model
{
    use HasFactory;

    protected $fillable = ['adresse', 'type', 'prix', 'surface', 'user_image', 'description'];

}