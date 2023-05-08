<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
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

/*Route::get('/profile', function () {
    return view('profile.profile');
});*/

Route::get('/profile', [\App\Http\Controllers\profileController::class, 'index']);
Route::get('/profile/{id}', 'App\Http\Controllers\ProfileController@viewProfile')->name('profile.view');


Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index');
Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');
//Route::patch('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');