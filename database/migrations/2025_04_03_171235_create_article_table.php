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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->string('nom_fichier')->nullable();
            $table->boolean('restreint');
            $table->string('url')->nullable();
            $table->boolean('valide');
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->foreignId('article_categorie_id')->constrained()->onDelete('restrict');
            $table->foreignId('article_type_id')->constrained()->onDelete('restrict');
            $table->foreignId('relation_type_id')->constrained()->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
