<?php

use App\Livewire\Pages\Account\Distributions;
use App\Livewire\Pages\Account\Mixtape\CreateApp;
use App\Livewire\Pages\Account\Mixtapes;
use App\Livewire\Pages\Account\Settings;
use App\Livewire\Pages\Account\Tracks;
use App\Livewire\Pages\Portal\Index;
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

Route::get('/', Index::class);
Route::get('/beats', \App\Livewire\Pages\Portal\Beats::class)->name('portal.beats');
Route::get('/mixtapes', \App\Livewire\Pages\Portal\Mixtapes::class)->name('portal.mixtapes');


// ---------  ЛИЧНЫЙ КАБИНЕТ --------- //

Route::middleware(['verified'])->prefix('account')->group(function () {
    Route::get('/mixtapes', Mixtapes::class)->name('account.mixtapes');
    Route::get('/tracks', Tracks::class)->name('account.tracks');
    Route::get('/distributions', Distributions::class)->name('account.distributions');
    Route::get('/beats', \App\Livewire\Pages\Account\Beats::class)->name('account.beats');
    Route::get('/settings', Settings::class)->name('account.settings');

    Route::get('/mixtapes/create_part/{mixtape_id}', \App\Livewire\Pages\Account\Mixtape\App::class)->name('account.mixtape.create_part');
    Route::get('/distribution/create_app', \App\Livewire\Pages\Account\Distribution\App::class)->name('account.distribution.create_app');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
