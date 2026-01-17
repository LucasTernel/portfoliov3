<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyToContact;

class AdminContactController extends Controller
{
    // LISTE DES MESSAGES
    public function index()
    {
        $contacts = Contact::latest()->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    // VOIR UN MESSAGE + FORMULAIRE RÉPONSE
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Marquer comme lu si ce n'est pas fait
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    // ENVOYER LA RÉPONSE
    public function reply(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        
        $request->validate(['reply_message' => 'required|string']);

        // Envoi du mail
        Mail::to($contact->email)->send(new ReplyToContact($contact, $request->reply_message));

        // Mise à jour BDD
        $contact->update(['replied_at' => now()]);

        // Log
        ActivityLog::record('Réponse Contact', "Réponse envoyée à {$contact->email}");

        return back()->with('success', 'Réponse envoyée avec succès !');
    }
    
    // SUPPRIMER
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        ActivityLog::record('Suppression Contact', "Message de {$contact->email} supprimé");
        
        return redirect()->route('admin.contacts.index')->with('success', 'Message supprimé.');
    }
}
