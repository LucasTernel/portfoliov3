<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\PortfolioInfo;


class ContactController extends Controller
{

    private function getInfo()
    {
        return PortfolioInfo::first() ?? new PortfolioInfo();
    }

    public function contact()
    {
        return view('contact', ['info' => $this->getInfo()]);
    }

    public function sendContact(Request $request)
    {
        if ($request->filled('bot_field')) {
            ActivityLog::record('Contact Bot', 'Un bot a tenté d\'envoyer un message via le formulaire de contact et a écrit : ' . $request->input('bot_field'));
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

        ActivityLog::record('Nouveau Contact', "Message de {$request->name}");

        return back()->with('success', 'Votre message a bien été envoyé. Je vous répondrai rapidement.');
    }
}
