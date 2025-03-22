<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();



            $table->text('content'); // Contenu du commentaire
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Clé étrangère vers la table users
            $table->foreignId('immobilier_id')->constrained('immobiliers')->onDelete('cascade'); // Clé étrangère vers la table immobiliers
          

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
