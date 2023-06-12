<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExcursionController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HelpController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', [HomeController::class, 'display'])->name('home.display');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/excursion/{id}', [ExcursionController::class, 'display'])->name('excursion.display');

Route::post('/excursion/save-comment', [ExcursionController::class, 'saveComment'])->name('excursion.saveComment');
Route::post('/excursion/favorites', [ExcursionController::class, 'saveFavorites'])->name('excursion.saveFavorites');
Route::post('/booking', [ExcursionController::class, 'booking'])->name('excursion.booking');

Route::get('/catalog', [CatalogController::class, 'display'])->name('catalog.display');
Route::post('/catalog', [CatalogController::class, 'display'])->name('catalog.search');

Route::get('/help', [HelpController::class, 'display'])->name('help.display');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
