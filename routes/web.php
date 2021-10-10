<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskListsController;

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

Route::inertia('/', 'Homepage')->name('homepage');

Route::middleware('auth')->group(function () {
    Route::match(['post', 'get'], '/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('tasks', TasksController::class)->only('store', 'update', 'destroy');
    Route::resource('task-lists', TaskListsController::class)->only('store', 'update', 'destroy');
});

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

require __DIR__.'/auth.php';
