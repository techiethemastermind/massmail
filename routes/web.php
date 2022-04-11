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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::resource('subscriber', SubscriberController::class);
Route::post('/subscriber/email', [SubscriberController::class, 'sendEmail'])->name('subscribers.email.send');
Route::post('/subscribers/import', [SubscriberController::class, 'csvImport'])->name('subscribers.import');
Route::post('/subscriber/status', [SubscriberController::class, 'chageStatus'])->name('subscriber.status');

// Setting
Route::resource('mailedits', TemplateController::class);
Route::post('mailedits/publish', [TemplateController::class, 'publish'])->name('template.publish');
Route::post('mailedits/test', [TemplateController::class, 'sendTestEmail'])->name('template.test');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/queue/run', [SubscriberController::class, 'runJob'])->name('job.run');
