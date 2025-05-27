<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WeddingSettingController;
use App\Http\Controllers\Admin\WeddingStoryController;
use App\Http\Controllers\Admin\WeddingGalleryController;
use App\Http\Controllers\Admin\WeddingBankAccountController;
use App\Http\Controllers\Admin\WeddingGuestController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Wedding public routes
Route::get('/', [App\Http\Controllers\WeddingController::class, 'index'])->name('wedding.index');
Route::get('/ravia', [App\Http\Controllers\WeddingController::class, 'ravia'])->name('wedding.ravia');
Route::post('/rsvp', [App\Http\Controllers\WeddingController::class, 'rsvp'])->name('wedding.rsvp');
Route::get('/guest-messages', [App\Http\Controllers\WeddingController::class, 'guestMessages'])->name('wedding.guest-messages');

// Auth routes (Breeze)
require __DIR__.'/auth.php';

// Admin routes (protected by auth middleware)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Settings
    Route::get('/settings', [WeddingSettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [WeddingSettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/upload', [WeddingSettingController::class, 'uploadImage'])->name('settings.upload');

    // Stories
    Route::resource('stories', WeddingStoryController::class);

    // Gallery
    Route::resource('galleries', WeddingGalleryController::class);

    // Bank Accounts
    Route::resource('bank-accounts', WeddingBankAccountController::class);

    // Guests
    Route::resource('guests', WeddingGuestController::class);
});
