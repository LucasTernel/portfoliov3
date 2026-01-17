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
    Schema::create('portfolio_infos', function (Blueprint $table) {
        $table->id();
        $table->string('fullname')->default('Lucas Ternel');
        $table->string('job_title')->default('Développeur Web');
        $table->string('email')->default('contact@lucasternel.com');
        $table->string('phone')->default('06-11-72-89-94');
        $table->string('location')->default('Frémicourt, France');
        $table->string('linkedin')->default('linkedin.com/in/lucas-ternel');
        $table->string('youtube')->default('youtube.com/@lucasternel');
        $table->string('instagram')->default('instagram.com/lucas.ternel');
        $table->string('github')->default('github.com/LucasTernel');
        $table->boolean('available')->default(true); // Pour le bouton vert/rouge
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_infos');
    }
};
