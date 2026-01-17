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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('title');       
            $table->string('date_range');  
            $table->string('role');        
            $table->text('description');   
            $table->json('liste')->nullable(); // Tes points
            $table->string('folder_name');      // Le nom du dossier (ex: "nuit-mmi")
            $table->json('images')->nullable(); // La liste des fichiers (ex: ["1.jpg", "2.jpg"])
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
