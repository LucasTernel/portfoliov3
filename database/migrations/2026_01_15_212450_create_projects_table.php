<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            // Infos de base
            $table->string('title');
            $table->string('subtitle')->nullable(); // Mieux vaut nullable si pas rempli
            $table->string('category');
            $table->text('short_description')->nullable();
            $table->longText('description');
            
            // Listes (JSON)
            $table->json('technologies')->nullable();
            $table->json('collaborators')->nullable(); // <--- AJOUTÉ
            
            // Liens (Optionnels)
            $table->string('link_github')->nullable();      // <--- AJOUTÉ
            $table->string('link_live')->nullable();        // <--- AJOUTÉ
            $table->string('link_drive')->nullable();       // <--- AJOUTÉ
            $table->string('link_video_intro')->nullable(); // <--- AJOUTÉ
            $table->string('link_video')->nullable();       // <--- AJOUTÉ

            // Images
            $table->string('folder_name');
            $table->string('thumbnail')->nullable();
            $table->json('gallery')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
