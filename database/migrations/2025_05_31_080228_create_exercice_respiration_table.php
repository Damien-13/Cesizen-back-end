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
        Schema::create('exercice_respiration', function (Blueprint $table) {
            $table->id('id_exercice_respiration'); // correspond à COUNTER dans le MCD
            $table->string('nomExercice', 100);
            $table->decimal('duree_inspiration', 10, 2);
            $table->decimal('duree_expiration', 10, 2);
            $table->decimal('duree_apnee', 10, 2);
            $table->integer('nombre_repetitions');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercice_respiration');
    }
};
