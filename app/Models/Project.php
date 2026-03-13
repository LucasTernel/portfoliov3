<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
    'title', 'subtitle', 'category', 'short_description', 'description', 
    'technologies', 'collaborators',
    'link_github', 'link_live', 'link_drive', 'link_video_intro', 'link_video',
    'folder_name', 'thumbnail', 'gallery'
];

protected $casts = [
    'technologies' => 'array',
    'collaborators' => 'array',
    'gallery' => 'array',
];
}