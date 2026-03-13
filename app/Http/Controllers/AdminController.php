<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        $projectsCount = Project::count();

        $totalContactsCount = Contact::count();

        $unreadContactsCount = Contact::where('is_read', false)->count();

        return view('admin.dashboard', compact(
            'projectsCount', 
            'totalContactsCount', 
            'unreadContactsCount'
        ));
    }
}