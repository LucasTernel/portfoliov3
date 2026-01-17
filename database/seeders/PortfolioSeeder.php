<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PortfolioInfo; // Assure-toi que le chemin est bon

class PortfolioSeeder extends Seeder
{
    public function run()
    {
        // On vide la table avant pour éviter les doublons
        PortfolioInfo::truncate();

        PortfolioInfo::create([
            'fullname' => 'Lucas Ternel',
            'job_title' => 'Développeur Web',
            'email' => 'contact@lucasternel.com',
            'phone' => '06-11-72-89-94',
            'location' => 'Frémicourt, France',
            'linkedin' => 'linkedin.com/in/lucas-ternel-9017762bb/',
            'youtube' => 'youtube.com/@lucasternel',
            'instagram' => 'instagram.com/lucas.ternel',
            'github' => 'github.com/LucasTernel',
            'available' => true,
        ]);
    }
}
