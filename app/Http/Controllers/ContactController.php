<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ActivityLog;


class ContactController extends Controller
{

    public function contact()
{
    // On passe les réglages globaux si besoin (déjà fait par le middleware normalement)
    return view('contact');
}

    public function sendContact(Request $request)
    {
        // --- SECURITE ANTI-BOT (HONEYPOT) ---
        // Si le champ caché 'bot_field' est rempli, c'est un robot.
        if ($request->filled('bot_field')) {
            return back()->with('error', 'Erreur de validation (Bot détecté).');
        }
        // ------------------------------------

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        // Petit log pour toi
        ActivityLog::record('Nouveau Contact', "Message de {$request->name}");

        return back()->with('success', 'Votre message a bien été envoyé. Je vous répondrai rapidement.');
    }
}
