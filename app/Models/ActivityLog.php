<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    protected $fillable = ['action', 'description', 'user_id', 'ip_address'];

    // Relation avec le User (pour afficher le nom dans le tableau)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // --- FONCTION MAGIQUE POUR ENREGISTRER ---
    // Utilisation : ActivityLog::record('Titre', 'Détails optionnels');
    public static function record($action, $description = null)
    {
        self::create([
            'action' => $action,
            'description' => $description,
            'user_id' => Auth::id(), // Prend l'ID de l'admin connecté
            'ip_address' => Request::ip(), // Prend son IP
        ]);
    }
}