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
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->id();

            $table->string('nom_complet');
            $table->string('email');
            $table->string('telephone');
            $table->text('message');
            $table->unsignedBigInteger('user_id'); // Clé étrangère vers User
            $table->unsignedBigInteger('immobilier_id'); // Clé étrangère vers Immobilier
            $table->string('type');
            $table->string('statut');
            $table->date('date_visite');
            $table->time('heure_visite');
            $table->timestamps();


                // Définir les clés étrangères
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('immobilier_id')->references('id')->on('immobiliers')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rendez_vous');
    }
};
