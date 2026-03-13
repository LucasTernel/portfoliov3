<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Models\Project;
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
use App\Http\Controllers\TwoFactorController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');
Route::get('/skills', [HomeController::class, 'skills'])->name('skills');
Route::get('/experience', [HomeController::class, 'experience'])->name('experience');
Route::get('/projets', [HomeController::class, 'projects'])->name('projects');
Route::get('/liens', [HomeController::class, 'links'])->name('links');
Route::get('/projet/{slug}', [HomeController::class, 'showProject'])->name('project.details');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendContact'])->name('contact.send');
Route::get('/mentions-legales', [HomeController::class, 'mentions'])->name('mentions');

Route::get('/test-error', function () {
    abort(503); // Change 500 par 403, 419 ou 503 pour tester les autres
});

Route::get('/sitemap.xml', function () {
    $projects = Project::all();
    $urls = [
        ['loc' => route('home'), 'priority' => '1.0', 'freq' => 'weekly'],
        ['loc' => route('projects'), 'priority' => '0.9', 'freq' => 'weekly'],
        ['loc' => route('experience'), 'priority' => '0.9', 'freq' => 'monthly'],
        ['loc' => route('contact'), 'priority' => '0.9', 'freq' => 'yearly'],
    ];
    $content = view('sitemap', compact('urls', 'projects'))->render();
    return Response::make($content, 200, [
        'Content-Type' => 'application/xml',
        'X-Robots-Tag' => 'noindex',
    ]);
});

Route::prefix('admin-lt')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    Route::middleware('auth')->group(function () {

        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::get('/2fa/enable', [TwoFactorController::class, 'show2faForm'])->name('2fa.enable');
        Route::post('/2fa/enable', [TwoFactorController::class, 'enable2fa'])->name('2fa.enable.post');
        Route::get('/2fa/verify', [TwoFactorController::class, 'verifyTwoFactor'])->name('2fa.verify');
        Route::post('/2fa/verify', [TwoFactorController::class, 'verifyTwoFactorStore']);

        Route::middleware('2fa')->group(function () {
            
            Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

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

            Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
            Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('admin.projects.update');

            Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
            Route::post('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
            
            Route::get('/logs', [LogController::class, 'index'])->name('admin.logs.index');
            Route::get('/logs/export', [LogController::class, 'export'])->name('admin.logs.export');

            Route::get('/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
            Route::get('/contacts/{id}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
            Route::post('/contacts/{id}/reply', [AdminContactController::class, 'reply'])->name('admin.contacts.reply');
            Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');
        });
    });
});