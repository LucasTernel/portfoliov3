<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Affiche le formulaire de login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Traite la connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirection vers le dashboard admin
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function index()
    {
        // On récupère les vrais chiffres
        $projectsCount = \App\Models\Project::count();

        // Si tu n'as pas encore de table contacts, mets 0 ou remplace par Contact::count()
        $contactsCount = 0; 
        // $contactsCount = Contact::where('is_read', false)->count(); // Exemple pour les non-lus

        return view('admin.dashboard', compact('projectsCount', 'contactsCount'));
    }
}