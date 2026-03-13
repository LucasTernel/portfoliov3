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

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            // max:5120 = 5MB. Si tu uploades 10 fichiers, ça fait 50MB.
            // Assure-toi que post_max_size dans .htaccess est > 50MB
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'gallery_files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'link_github' => 'nullable|url',
            'link_live' => 'nullable|url',
            'link_drive' => 'nullable|url',
            'link_video_intro' => 'nullable|url',
            'link_video' => 'nullable|url',
        ]);

        $folderName = Str::slug($request->title);
        $destinationPath = public_path("images/projects/{$folderName}");

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $thumbnailName = null;
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $thumbnailName = 'thumb_' . time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $thumbnailName);
        }

        $galleryNames = [];
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $key => $image) {
                $filename = time() . '_' . $key . '_' . $image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                $galleryNames[] = $filename;
            }
        }
        
        $techArray = $request->technologies ? array_map('trim', explode(',', $request->technologies)) : [];
        $collabArray = $request->collaborators ? array_map('trim', explode(',', $request->collaborators)) : [];

        $project = Project::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'category' => $request->category,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'technologies' => array_values($techArray),
            'collaborators' => array_values($collabArray),
            'link_github' => $request->link_github,
            'link_live' => $request->link_live,
            'link_drive' => $request->link_drive,
            'link_video_intro' => $request->link_video_intro,
            'link_video' => $request->link_video,

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

        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'folder_name' => 'required',
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        $techArray = $project->technologies ?? [];
        if ($request->has('technologies')) {
            $techArray = is_string($request->technologies) 
                ? array_map('trim', explode(',', $request->technologies)) 
                : $request->technologies;
        }

        $collabArray = $project->collaborators ?? [];
        if ($request->has('collaborators')) {
            $collabArray = is_string($request->collaborators) 
                ? array_map('trim', explode(',', $request->collaborators)) 
                : $request->collaborators;
        }

        $thumbnailName = $project->thumbnail;
        $path = public_path("images/projects/{$project->folder_name}");

        if ($request->has('delete_thumbnail') && $request->delete_thumbnail == 1) {
            if ($thumbnailName && File::exists($path . '/' . $thumbnailName)) {
                unlink($path . '/' . $thumbnailName);
            }
            $thumbnailName = null;
        }

        if ($request->hasFile('thumbnail')) {
            if ($thumbnailName && File::exists($path . '/' . $thumbnailName)) {
                unlink($path . '/' . $thumbnailName);
            }
            $file = $request->file('thumbnail');
            $thumbnailName = 'thumb_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $thumbnailName);
        }

        $gallery = $project->gallery ?? [];
        
        if ($request->has('delete_gallery_images')) {
            $gallery = array_values(array_diff($gallery, $request->input('delete_gallery_images')));
            foreach ($request->input('delete_gallery_images') as $filename) {
                $filePath = $path . '/' . $filename;
                if (File::exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
        
        if ($request->hasFile('new_gallery')) {
            foreach ($request->file('new_gallery') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $name);
                if (!in_array($name, $gallery)) $gallery[] = $name;
            }
        }

        $project->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'category' => $request->category,
            'description' => $request->description,
            'technologies' => $techArray,
            'collaborators' => $collabArray,
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
        File::deleteDirectory(public_path("images/projects/{$project->folder_name}"));

        $project->delete();
        ActivityLog::record('Suppression Projet', 'Projet ID ' . $project->id . ' supprimé.');
        return back()->with('success', 'Projet supprimé.');
    }
}