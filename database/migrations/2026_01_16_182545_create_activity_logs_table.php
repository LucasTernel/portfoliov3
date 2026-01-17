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
    Schema::create('activity_logs', function (Blueprint $table) {
        $table->id();
        $table->string('action');           // Ex: "Connexion", "Suppression Projet"
        $table->text('description')->nullable(); // Détails (ex: "Projet ID 4 supprimé")
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Qui ?
        $table->string('ip_address')->nullable(); // IP pour la sécurité
        $table->timestamps(); // Date (created_at)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
