<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    protected $fillable = ['action', 'description', 'user_id', 'ip_address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function record($action, $description = null)
    {
        self::create([
            'action' => $action,
            'description' => $description,
            'user_id' => Auth::id(), 
            'ip_address' => Request::ip(),
        ]);
    }
}