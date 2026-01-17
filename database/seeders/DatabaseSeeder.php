<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\SettingsSeeder;
use Illuminate\Support\Facades\Hash; // On utilise Hash pour la sécurité

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Si tu veux supprimer les anciens users avant de recréer :
        // User::truncate(); 

        User::create([
            'name' => 'Lucas Admin',
            'email' => 'lucas.ternel62@gmail.com',
            'password' => Hash::make('Ep140423&@'), // Hash::make est recommandé par Laravel
            'role' => 'admin', // <--- C'EST ICI QUE TU DONNES LE STATUT ADMIN
        ]);
        
        // N'oublie pas d'appeler le seeder des Settings s'il existe
        $this->call(SettingsSeeder::class);
    }
}
