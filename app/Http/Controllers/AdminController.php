<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Contact; // <--- INDISPENSABLE : Importe le modèle

class AdminController extends Controller
{
    public function index()
    {
        // 1. Compter les projets
        $projectsCount = Project::count();

        // 2. Compter le TOTAL des contacts (pour la stat du bas)
        $totalContactsCount = Contact::count();

        // 3. Compter les NON-LUS (pour la notif du haut)
        // C'est cette variable qui manquait
        $unreadContactsCount = Contact::where('is_read', false)->count();

        // 4. Envoyer le tout à la vue
        return view('admin.dashboard', compact(
            'projectsCount', 
            'totalContactsCount', 
            'unreadContactsCount' // <--- C'est ici que ça bloquait
        ));
    }
}