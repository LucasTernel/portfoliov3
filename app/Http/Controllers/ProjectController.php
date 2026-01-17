<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ActivityLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    // Ajout de la méthode SHOW pour voir le détail dans l'admin
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function store(Request $request)
    {
        // 1. VALIDATION
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            
            // Validation des images
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'gallery_files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            
            // Validation des liens optionnels (doit être une URL valide si rempli)
            'link_github' => 'nullable|url',
            'link_live' => 'nullable|url',
            'link_drive' => 'nullable|url',
            'link_video_intro' => 'nullable|url',
            'link_video' => 'nullable|url',
        ]);

        // 2. DOSSIER & CHEMIN
        $folderName = Str::slug($request->title);
        $destinationPath = resource_path("images/projects/{$folderName}");

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        // 3. UPLOAD THUMBNAIL
        $thumbnailName = null;
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $thumbnailName = 'thumb_' . $file->getClientOriginalName();
            $file->move($destinationPath, $thumbnailName);
        }

        // 4. UPLOAD GALLERY
        $galleryNames = [];
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $image) {
                $filename = $image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                $galleryNames[] = $filename;
            }
        }

        // 5. TRAITEMENT LISTES (String "a,b" -> Array ["a","b"])
        
        // Technologies
        $techArray = $request->technologies ? explode(',', $request->technologies) : [];
        $techArray = array_map('trim', $techArray);

        // Collaborateurs
        $collabArray = $request->collaborators ? explode(',', $request->collaborators) : [];
        $collabArray = array_map('trim', $collabArray);


        // 6. INSERTION BDD
        Project::create([
            // Textes
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'category' => $request->category,
            'short_description' => $request->short_description,
            'description' => $request->description,
            
            // Tableaux JSON
            'technologies' => array_values($techArray),
            'collaborators' => array_values($collabArray), // <--- Nouveau
            
            // Liens
            'link_github' => $request->link_github,
            'link_live' => $request->link_live,
            'link_drive' => $request->link_drive,
            'link_video_intro' => $request->link_video_intro,
            'link_video' => $request->link_video,

            // Images
            'folder_name' => $folderName,
            'thumbnail' => $thumbnailName,
            'gallery' => $galleryNames,
        ]);

        ActivityLog::record('Création Projet', 'Nouveau projet : ' . $request->title);

        return redirect()->route('admin.projects.index')
                         ->with('success', 'Projet créé avec succès !');
    }

public function edit($id)
{
    $project = Project::findOrFail($id);
    return view('admin.projects.edit', compact('project'));
}

public function update(Request $request, $id)
{
    $project = Project::findOrFail($id);

    // 1. Validation
    $request->validate([
        'title' => 'required',
        'category' => 'required',
        'folder_name' => 'required',
        'thumbnail' => 'nullable|image|max:2048', // Image de couverture
    ]);

    // 2. Gestion des Technologies (String "HTML, CSS" -> Array)
    $techArray = $project->technologies ?? [];
    if ($request->has('technologies')) {
        // Si c'est une chaine (ex: "HTML, CSS"), on explose. Sinon on garde tel quel.
        $techArray = is_string($request->technologies) 
            ? array_map('trim', explode(',', $request->technologies)) 
            : $request->technologies;
    }

    // 3. Gestion des Collaborateurs (String "Pierre, Paul" -> Array)
    $collabArray = $project->collaborators ?? [];
    if ($request->has('collaborators')) {
        $collabArray = is_string($request->collaborators) 
            ? array_map('trim', explode(',', $request->collaborators)) 
            : $request->collaborators;
    }

    // 4. Gestion de l'image de couverture (Thumbnail)
    $thumbnailName = $project->thumbnail;
    // Si on demande la suppression
    if ($request->has('delete_thumbnail') && $request->delete_thumbnail == 1) {
        // Optionnel : unlink(...)
        $thumbnailName = null;
    }
    // Si on upload une nouvelle
    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $thumbnailName = 'thumb_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(resource_path("images/projects/{$request->folder_name}"), $thumbnailName);
    }

    // 5. Gestion de la Galerie (Suppression + Ajout)
    $gallery = $project->gallery ?? [];
    
    // Suppression
    if ($request->has('delete_gallery_images')) {
        $gallery = array_values(array_diff($gallery, $request->input('delete_gallery_images')));
    }
    
    // Ajout
    if ($request->hasFile('new_gallery')) {
        foreach ($request->file('new_gallery') as $file) {
            $name = $file->getClientOriginalName();
            $file->move(resource_path("images/projects/{$request->folder_name}"), $name);
            if (!in_array($name, $gallery)) $gallery[] = $name;
        }
    }

    // 6. Mise à jour en base
    $project->update([
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'category' => $request->category,
        'description' => $request->description,
        'technologies' => $techArray,
        'collaborators' => $collabArray, // Nouveau champ
        
        // Tous les liens
        'link_live' => $request->link_live,
        'link_github' => $request->link_github,
        'link_drive' => $request->link_drive,
        'link_video' => $request->link_video,
        'link_video_intro' => $request->link_video_intro,
        
        'folder_name' => $request->folder_name,
        'thumbnail' => $thumbnailName,
        'gallery' => $gallery,
    ]);

    ActivityLog::record('Mise à jour Projet', 'Projet ID ' . $project->id . ' mis à jour.');

    return redirect()->route('admin.projects.index')->with('success', 'Projet mis à jour avec succès !');
}

    public function destroy(Project $project)
    {
        $project->delete();
        ActivityLog::record('Suppression Projet', 'Projet ID ' . $project->id . ' supprimé.');
        return back()->with('success', 'Projet supprimé.');
    }
}