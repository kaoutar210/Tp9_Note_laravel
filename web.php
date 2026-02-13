<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|


Route::get('/', function () {
    return view('welcome');
});

Route::get('/classe/{classe}/stagiaire/{nom}', function ($classe, $nom) {
    return "La stagiaire $nom appartient à la classe $classe";
})
->where('nom', '[A-Za-z]{4,24}')
->where('classe', '[A-Za-z]{4,10}[0-9]{3}');


Route::get('/classe/{classeId}/stagiaire/{stagiaireId}', function ($classeId, $stagiaireId) {
    return "Classe : $classeId | Stagiaire : $stagiaireId";
})->name('classeStagiaire');

use App\Http\Controllers\StagiaireController;

Route::resource('stagiaires', StagiaireController::class);

use App\Http\Controllers\FormationController;

Route::resource('formations', FormationController::class);


Route::get('/classe/{classeId}', function ($classeId) {
    return "Classe : $classeId ";
})->middleware('role');
use App\Http\Controllers\QuoteController;

Route::get('/quotes', [QuoteController::class, 'index']);
Route::get('/randomQuote', [QuoteController::class, 'random']);
Route::get('/quotes/author/{name}', [QuoteController::class, 'filterParAuteur']);
Route::post('/quotes/filter', [QuoteController::class, 'filterByAuthor']);

use App\Http\Controllers\UnitConverterController;

Route::get('/unit-converter', [UnitConverterController::class, 'showForm']);
Route::post('/unit-converter/convert', [UnitConverterController::class, 'convert']);

use App\Http\Controllers\HealthController;

Route::get('/', [HealthController::class, 'index'])->name('home');
// PARTIE I
Route::get('/calculimc', [HealthController::class, 'showformIMC'])->name('imc.form');
Route::get('/resultatimc', [HealthController::class, 'calculerIMC'])->name('imc.result');

// PARTIE II
Route::get('/calculBmr', [HealthController::class, 'showformBMR'])->name('bmr.form');
Route::get('/resultatBmr', [HealthController::class, 'calculerBMR'])->name('bmr.result');

// PARTIE III
Route::get('/calculeau', [HealthController::class, 'showformeau'])->name('eau.form');
Route::get('/resultateau', [HealthController::class, 'calculereau'])->name('eau.result');

// PARTIE IV
Route::get('/conversion', [HealthController::class, 'showformConversion'])->name('conversion.form');
Route::get('/resultatconversion', [HealthController::class, 'calculerConversion'])->name('conversion.result');

//PARTIE V
Route::get('/calculjournal', [HealthController::class, 'showformjournal'])->name('journal.form');
Route::get('/resultatjournal', [HealthController::class, 'calculerjournal'])->name('journal.result');

// Tp3
use App\Http\Controllers\TacheController;

Route::get('/', function () {
    return redirect()->route('taches.index');
});

Route::get('/taches', [TacheController::class, 'index'])->name('taches.index');
Route::get('/taches/create', [TacheController::class, 'create'])->name('taches.create');
Route::post('/taches', [TacheController::class, 'store'])->name('taches.store');
Route::get('/taches/{id}', [TacheController::class, 'show'])->name('taches.show');
Route::get('/taches/{id}/edit', [TacheController::class, 'edit'])->name('taches.edit');
Route::put('/taches/{id}', [TacheController::class, 'update'])->name('taches.update');
Route::delete('/taches/{id}', [TacheController::class, 'destroy'])->name('taches.destroy');
Route::post('/taches/{id}/toggle', [TacheController::class, 'toggleStatus'])->name('taches.toggle');

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class);

Route::resource('authors', AuthorController::class);

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CoursController;

Route::resource('etudiants', EtudiantController::class);

Route::post('etudiants/{id}/notes', [EtudiantController::class, 'ajouterNote'])
    ->name('etudiants.ajouterNote');
Route::post('etudiants/{id}/absences', [EtudiantController::class, 'ajouterAbsence'])
    ->name('etudiants.ajouterAbsence');

Route::resource('cours', CoursController::class);*/

use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\SpeakerController;

Route::get('/', function () {
    return redirect()->route('events.index');
});

Route::resource('events', EventController::class);
Route::post('events/{event}/add-participant', [EventController::class, 'addParticipant'])->name('events.add-participant');
Route::get('events/{event}/pdf', [EventController::class, 'generatePdf'])->name('events.pdf');
Route::get('events/{event}/export', [EventController::class, 'exportParticipants'])->name('events.export');
Route::post('events/{event}/import', [EventController::class, 'importParticipants'])->name('events.import');

Route::resource('participants', ParticipantController::class);
Route::resource('speakers', SpeakerController::class);
