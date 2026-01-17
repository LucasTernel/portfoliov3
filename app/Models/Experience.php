<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'date_range', 'role', 'description', 'liste', 'folder_name', 'images'];
    protected $casts = [
        'liste' => 'array',
        'images' => 'array',
    ];
}
