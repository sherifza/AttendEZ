<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChatController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Chat
    // Display the chat dashboard
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');

    // Handle chat messages
    Route::post('/send-chat-message', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');
    Route::post('/change-chat-status', [ChatController::class,  'changeChatStatus'])->name('users.changeChatStatus');
    Route::get('/chat-messages/{fromUser}/{toUser}', [ChatController::class, 'getMessages'])->name('chat.getMessages');
    Route::get('/users', [UserController::class, 'index'])
        ->middleware(['auth', 'verified', 'isManager'])
        ->name('users');

    Route::resource('courses', CourseController::class);
});

require __DIR__.'/auth.php';
