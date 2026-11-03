<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\JanazahController;
use App\Http\Controllers\GraveyardController;
use App\Http\Controllers\AdminController;

// Public Home & Guide
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/emergency-guide', [HomeController::class, 'emergencyGuide'])->name('guide');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'showCategory'])->name('services.category');

// Emergency Requests & Tracking
Route::get('/request/create', [ServiceRequestController::class, 'create'])->name('requests.create');
Route::post('/request/store', [ServiceRequestController::class, 'store'])->name('requests.store');
Route::get('/request/track', [ServiceRequestController::class, 'track'])->name('requests.track');
Route::get('/request/{tracking_code}', [ServiceRequestController::class, 'show'])->name('requests.show');

// Janazah Announcements & Notice Board
Route::get('/janazah', [JanazahController::class, 'index'])->name('janazah.index');
Route::get('/janazah/create', [JanazahController::class, 'create'])->name('janazah.create');
Route::post('/janazah/store', [JanazahController::class, 'store'])->name('janazah.store');
Route::get('/janazah/{unique_code}', [JanazahController::class, 'show'])->name('janazah.show');

// Graveyards Directory
Route::get('/graveyards', [GraveyardController::class, 'index'])->name('graveyards.index');
Route::get('/graveyards/{id}', [GraveyardController::class, 'show'])->name('graveyards.show');

// Admin Management
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/requests/{id}/status', [AdminController::class, 'updateRequestStatus'])->name('admin.requests.update-status');
