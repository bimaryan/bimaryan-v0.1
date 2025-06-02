<?php

use App\Http\Controllers\WEB\Admin\DashboardController;
use App\Http\Controllers\WEB\Auth\Logincontroller;
use App\Http\Controllers\WEB\Home\AboutController;
use App\Http\Controllers\WEB\Home\BlogController;
use App\Http\Controllers\WEB\Home\ContactController;
use App\Http\Controllers\WEB\Home\HomeController;
use App\Http\Controllers\WEB\Home\ProjectsController;
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
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/login', [Logincontroller::class, 'index'])->name('login');
Route::post('/login', [Logincontroller::class, 'store'])->name('login.store');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
