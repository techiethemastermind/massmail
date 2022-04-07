<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\SubscriberController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\TemplateController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/subscriber', [SubscriberController::class, 'index'])->name('subscriber');
Route::post('/subscriber/email', [SubscriberController::class, 'sendEmail'])->name('subscribers.email.send');
Route::post('/subscribers/import', [SubscriberController::class, 'csvImport'])->name('subscribers.import');

// Setting
Route::resource('mailedits', TemplateController::class);
Route::post('mailedits/publish', [TemplateController::class, 'publish'])->name('template.publish');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
