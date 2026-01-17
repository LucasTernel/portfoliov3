<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
    'maintenance_mode', 
    'maintenance_scheduled_at', 
    'maintenance_ends_at',
    'is_available', 
    'ga_tracking_id',
    'ga_property_id', // <--- AJOUTER ICI
];

protected $casts = [
    'maintenance_mode' => 'boolean',
    'is_available' => 'boolean',
    'maintenance_scheduled_at' => 'datetime',
    'maintenance_ends_at' => 'datetime', // <--- Nouveau
];
}