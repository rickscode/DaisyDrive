<?php

use App\Http\Controllers\ProfileController;
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

// Default route for the home page
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard route, accessible only to authenticated and verified users
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// FileController routes grouped with authentication and verification middleware
Route::controller(\App\Http\Controllers\FileController::class)
    ->middleware(['auth', 'verified'])
    ->group(function () {
        // Route for displaying user's files
        Route::get('/my-files', 'myFiles')->name('myFiles');
        // Route for creating a folder
        Route::get('/folder/create', 'creatFolder')->name('folder.create');
    });

// ProfileController routes grouped with authentication middleware
Route::middleware('auth')->group(function () {
    // Route for editing user's profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route for updating user's profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route for deleting user's profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication-related routes
require __DIR__.'/auth.php';
