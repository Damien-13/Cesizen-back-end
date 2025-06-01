<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('administrer', function (Blueprint $table) {
            $table->unsignedBigInteger('id_utilisateur');
            $table->unsignedBigInteger('id_exercice_respiration');

            // Définir les clés étrangères 
            $table->foreign('id_utilisateur')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_exercice_respiration')->references('id_exercice_respiration')->on('exercice_respiration')->onDelete('cascade');

            // Clé primaire composite pour éviter les doublons
            $table->primary(['id_utilisateur', 'id_exercice_respiration']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administer');
    }
};
