<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Import important pour gérer les dossiers

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
    // Récupère l'expérience par son ID ou renvoie une erreur 404 si elle n'existe pas
    $experience = Experience::findOrFail($id);

    // Retourne la vue d'édition en passant l'objet experience
    return view('admin.experiences.edit', compact('experience'));
}

public function update(Request $request, Experience $experience)
{
    // 1. Validation de base
    $request->validate([
        'title' => 'required',
        'role' => 'required',
        'date_range' => 'required',
        'description' => 'required',
        'folder_name' => 'required',
        'new_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
    ]);

    // 2. Gestion de la liste (TextArea -> Array)
    $listeArray = array_filter(explode("\n", str_replace("\r", "", $request->liste)));

    // 3. Gestion des images existantes
    $images = $experience->images ?? [];

    // --- SUPPRESSION DES PHOTOS COCHÉES ---
    if ($request->has('delete_images')) {
        $toDelete = $request->input('delete_images');
        // On filtre le tableau pour enlever les noms de fichiers supprimés
        $images = array_values(array_diff($images, $toDelete));
        
        // Optionnel : Supprimer physiquement le fichier du dossier
        /*
        foreach($toDelete as $filename) {
            $path = resource_path("images/experiences/{$experience->folder_name}/{$filename}");
            if(file_exists($path)) unlink($path);
        }
        */
    }

    // --- AJOUT DES NOUVELLES PHOTOS ---
    if ($request->hasFile('new_images')) {
        foreach ($request->file('new_images') as $file) {
            $filename = $file->getClientOriginalName();
            // On déplace le fichier (assurez-vous que le dossier folder_name existe)
            $file->move(resource_path("images/experiences/{$request->folder_name}"), $filename);
            
            if (!in_array($filename, $images)) {
                $images[] = $filename;
            }
        }
    }

    // 4. Update final
    $experience->update([
        'title' => $request->title,
        'role' => $request->role,
        'date_range' => $request->date_range,
        'description' => $request->description,
        'folder_name' => $request->folder_name,
        'liste' => $listeArray,
        'images' => $images
    ]);

    return redirect()->route('admin.experiences.index')->with('success', 'Expérience mise à jour !');
}
    // SUPPRESSION
    public function destroy(Experience $experience)
    {
        // Optionnel : Supprimer le dossier dans resources si on supprime l'expérience
        /*
        $path = resource_path("images/experiences/{$experience->folder_name}");
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
        */

        $experience->delete();
        return back()->with('success', 'Expérience supprimée.');
    }
}