<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
    'title', 'subtitle', 'category', 'short_description', 'description', 
    'technologies', 'collaborators', // <--- Ajoute ça
    'link_github', 'link_live', 'link_drive', 'link_video_intro', 'link_video', // <--- Ajoute ça
    'folder_name', 'thumbnail', 'gallery'
];

protected $casts = [
    'technologies' => 'array',
    'collaborators' => 'array', // <--- Ajoute ça pour que Laravel gère le JSON
    'gallery' => 'array',
];
}