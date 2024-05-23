<?php

use App\Enums\Permissions;
use App\Http\Controllers\JobAdController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', [JobAdController::class, 'index'])->middleware('verified')->name('dashboard');

    Route::group(['prefix' => 'job-ads'], function () {
        Route::get('create', [JobAdController::class, 'create'])->name('job-ads.create');
        Route::post('store', [JobAdController::class, 'store'])->name('job-ads.store');
        Route::get('{jobAd}/approve', [JobAdController::class, 'approve'])->name('job-ads.approve')->middleware('can:'.Permissions::ModerateJobAds->value);
        Route::get('{jobAd}/mark-as-spam', [JobAdController::class, 'markAsSpam'])->name('job-ads.mark-as-spam')->middleware('can:'.Permissions::ModerateJobAds->value);
    });
});

Route::get('job-ads/{jobAd}', [JobAdController::class, 'show'])->name('job-ads.show');

require __DIR__.'/auth.php';
