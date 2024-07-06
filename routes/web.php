<?php

use App\Http\Controllers\DomaineController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferentielController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StandardController;
use App\Http\Controllers\UserController;
use App\Models\Section;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('home', [HomeController::class,'index'])->name('home');
Route::get('adminHome', [HomeController::class,'adminHome'])->name('admin.home');
Route::get('personnalHome', [HomeController::class,'personnalHome'])->name('personnal.home');

// route pour le telechargement d'un referentiel
Route::get('referentiels/{referentiel}/download', [ReferentielController::class,'download'])->name('referentiel.download');

Route::name('admin.')->group(function () {
    Route::resource('service', ServiceController::class)->except('show');
    Route::resource('section', SectionController::class)->except('show');
    Route::resource('referentiel', ReferentielController::class)->except('show');
    Route::resource('domaine', DomaineController::class)->except('show');
    Route::resource('admin/stand', StandardController::class)->except('show');
    Route::resource('evaluateur', UserController::class)->except('show');
    // 
    Route::post('evaluateur/droitEva', [UserController::class, 'updateDroitEvaluateur'])->name('droit_eva');
    Route::post('evaluateur/updateEvaluateur', [UserController::class, 'updateEvaluateur'])->name('evaluateur');
    Route::get('evaluateur/search', [UserController::class, 'searchUser'])->name('search');

    // routes/web.php
    Route::get('admin/stand/preview/{id}', [StandardController::class, 'preview'])->name('stand.preview');

});

Route::name('personnal.')->group(function () {
    Route::get('personnal/referentiel', [HomeController::class,'referentiel'])->name('referentiel');
    Route::get('personnal/domaine', [HomeController::class,'domaine'])->name('domaine');
    Route::resource('stand', StandardController::class)->except('show');
});

// breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
