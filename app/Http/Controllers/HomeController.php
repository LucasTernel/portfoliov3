<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\PortfolioInfo;
use App\Models\Project; 


class HomeController extends Controller
{
    // Méthode privée pour éviter de répéter le code de récupération des infos
    private function getInfo()
    {
        return PortfolioInfo::first() ?? new PortfolioInfo();
    }

    public function index()
    {
        return view('index', ['info' => $this->getInfo()]);
    }

    public function about()
    {
        // Tu devras créer resources/views/about.blade.php
        return view('about', ['info' => $this->getInfo()]);
    }

    public function skills()
    {
        // Tu devras créer resources/views/skills.blade.php
        return view('skills', ['info' => $this->getInfo()]);
    }

    public function experience()
    {
        $experiences = Experience::orderBy('id', 'desc')->get();
        $info = \App\Models\PortfolioInfo::first(); // Ou via ta méthode getInfo()
        return view('experience', compact('info', 'experiences'));
    }


public function projects()
{
    $info = $this->getInfo();
    $projects = Project::orderBy('created_at', 'desc')->get();
    return view('projects', compact('info', 'projects'));
}

    public function links()
    {
        // Tu devras créer resources/views/projects.blade.php
        return view('links', ['info' => $this->getInfo()]);
    }

    public function showProject($slug)
    {
        // On cherche le projet où 'folder_name' correspond au slug de l'URL
        $project = Project::where('folder_name', $slug)->firstOrFail();

        return view('projects.show', compact('project'));
    }
}