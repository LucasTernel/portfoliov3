<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\AdminContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// A Propos
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');

// Skills (Compétences)
Route::get('/skills', [HomeController::class, 'skills'])->name('skills');

// Expérience
Route::get('/experience', [HomeController::class, 'experience'])->name('experience');

// Mes Projets
Route::get('/projets', [HomeController::class, 'projects'])->name('projects');

Route::get('/liens', [HomeController::class, 'links'])->name('links');


Route::get('/projet/{slug}', [HomeController::class, 'showProject'])->name('project.details');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendContact'])->name('contact.send');

/* --- ESPACE ADMIN (URL personnalisée : /admin-lt) --- */

Route::prefix('admin-lt')->group(function () {

    // 1. Routes Publiques (Login)
    // Le ->name('login') est important pour que Laravel sache où rediriger si on n'est pas connecté
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // 2. Routes Protégées (Nécessite d'être connecté)
    Route::middleware('auth')->group(function () {
        

        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::resource('experiences', ExperienceController::class)->names([
            'index' => 'admin.experiences.index',
            'create' => 'admin.experiences.create',
            'store' => 'admin.experiences.store',
            'destroy' => 'admin.experiences.destroy',
            'edit' => 'admin.experiences.edit',
            'update' => 'admin.experiences.update',
        ]);

        Route::resource('projects', ProjectController::class)->names([
            'index' => 'admin.projects.index',
            'create' => 'admin.projects.create',
            'store' => 'admin.projects.store',
            'destroy' => 'admin.projects.destroy',
        ]);

        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
        Route::post('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
        
        Route::get('/logs', [LogController::class, 'index'])->name('admin.logs.index');
        Route::get('/logs/export', [LogController::class, 'export'])->name('admin.logs.export');

        Route::get('/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
        Route::get('/contacts/{id}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
        Route::post('/contacts/{id}/reply', [AdminContactController::class, 'reply'])->name('admin.contacts.reply');
        Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');

        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('admin.projects.update');
        
    });

Route::get('/sitemap.xml', function () {
    // 1. On récupère les projets pour les lister aussi (optionnel mais conseillé)
    $projects = Project::all();

    // 2. On définit les pages prioritaires (Celles que tu veux en Sitelinks)
    $urls = [
        ['loc' => route('home'), 'priority' => '1.0', 'freq' => 'weekly'],
        ['loc' => route('projects.index'), 'priority' => '0.9', 'freq' => 'weekly'], // Page Projets
        ['loc' => route('experience'), 'priority' => '0.9', 'freq' => 'monthly'],   // Page Expérience
        ['loc' => route('contact'), 'priority' => '0.9', 'freq' => 'yearly'],      // Page Contact
    ];

    $content = view('sitemap', compact('urls', 'projects'))->render();

    return Response::make($content, 200, [
        'Content-Type' => 'application/xml',
        'X-Robots-Tag' => 'noindex',
    ]);
});

});