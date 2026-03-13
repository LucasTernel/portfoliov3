<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\ActivityLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::latest()->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function edit($id)
{
    $experience = Experience::findOrFail($id);

    return view('admin.experiences.edit', compact('experience'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'role' => 'required',
        'date_range' => 'required',
        'description' => 'required',
        'liste_input' => 'nullable|string', 
        'images_files.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
    ]);

    $folderName = Str::slug($request->title);
    
    $destinationPath = public_path("images/experiences/{$folderName}");

    if (!File::exists($destinationPath)) {
        File::makeDirectory($destinationPath, 0755, true);
    }

    $imageNames = [];
    if ($request->hasFile('images_files')) {
        foreach ($request->file('images_files') as $file) {
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            
            $imageNames[] = $filename;
        }
    }

    $listeArray = $request->liste_input 
        ? array_values(array_filter(explode("\n", str_replace("\r", "", $request->liste_input)))) 
        : [];

    Experience::create([
        'title' => $request->title,
        'role' => $request->role,
        'date_range' => $request->date_range,
        'description' => $request->description,
        'folder_name' => $folderName, 
        'liste' => $listeArray,   
        'images' => $imageNames  
    ]);

    ActivityLog::record('Création Expérience', 'Expérience "' . $request->title . '" créée.');

    return redirect()->route('admin.experiences.index')
                     ->with('success', 'Expérience créée avec succès !');
}


public function update(Request $request, Experience $experience)
{
    $request->validate([
        'title' => 'required',
        'role' => 'required',
        'date_range' => 'required',
        'description' => 'required',
        'folder_name' => 'required',
        'new_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
    ]);

    $listeArray = array_filter(explode("\n", str_replace("\r", "", $request->liste)));

    $images = $experience->images ?? [];

    if ($request->has('delete_images')) {
        $toDelete = $request->input('delete_images');
        $images = array_values(array_diff($images, $toDelete));
        
        foreach($toDelete as $filename) {
            $path = public_path("images/experiences/{$experience->folder_name}/{$filename}");
            if(file_exists($path)) unlink($path);
        }
        
    }

    if ($request->hasFile('new_images')) {
        foreach ($request->file('new_images') as $file) {
            $filename = $file->getClientOriginalName();
            $file->move(public_path("images/experiences/{$request->folder_name}"), $filename);
            
            if (!in_array($filename, $images)) {
                $images[] = $filename;
            }
        }
    }

    $experience->update([
        'title' => $request->title,
        'role' => $request->role,
        'date_range' => $request->date_range,
        'description' => $request->description,
        'folder_name' => $request->folder_name,
        'liste' => $listeArray,
        'images' => $images
    ]);

    ActivityLog::record('Mise à jour Expérience', 'Expérience ID ' . $experience->id . ' mise à jour.');
    return redirect()->route('admin.experiences.index')->with('success', 'Expérience mise à jour !');
}
    public function destroy(Experience $experience)
    {
        $path = public_path("images/experiences/{$experience->folder_name}");
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
        

        $experience->delete();
        ActivityLog::record('Suppression Expérience', 'Expérience ID ' . $experience->id . ' supprimée.');
        return back()->with('success', 'Expérience supprimée.');
    }
}