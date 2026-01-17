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
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        
        // 1. Maintenance
        $table->boolean('maintenance_mode')->default(false);
        $table->dateTime('maintenance_scheduled_at')->nullable(); // Date auto-déclenchement
        $table->dateTime('maintenance_ends_at')->nullable()->after('maintenance_scheduled_at');
        
        // 2. Disponibilité (Freelance)
        $table->boolean('is_available')->default(true);
        
        // 3. Google Analytics (ID de suivi type G-XXXXX)
        $table->string('ga_tracking_id')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
