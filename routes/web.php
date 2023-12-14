<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Notifications;
use App\Livewire\Feed;
use App\Livewire\Mensagem;
use App\Livewire\Chat;
use App\Livewire\Communitys;
use App\Livewire\CommunityFeed;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::middleware(['auth'])->group(function () {

    
     Route::get('/home', Feed::class);


    Route::get('/notifications', Notifications::class);

    Route::get("/mensagens", Chat::class);

    Route::get("/comunidades", Communitys::class);

    Route::get("/comunidades/{id}", CommunityFeed::class);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
