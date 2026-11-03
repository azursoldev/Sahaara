<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\JanazahController;
use App\Http\Controllers\GraveyardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;

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

// Authentication Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login'); // Standard fallback
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Panel Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Requests
    Route::get('/requests', [AdminController::class, 'requests'])->name('requests');
    Route::post('/requests/{id}/status', [AdminController::class, 'updateRequestStatus'])->name('requests.update-status');
    
    // Services
    Route::get('/services', [AdminController::class, 'services'])->name('services');
    Route::post('/services/store', [AdminController::class, 'storeService'])->name('services.store');
    Route::delete('/services/{id}', [AdminController::class, 'deleteService'])->name('services.delete');
    
    // Graveyards
    Route::get('/graveyards', [AdminController::class, 'graveyards'])->name('graveyards');
    Route::post('/graveyards/store', [AdminController::class, 'storeGraveyard'])->name('graveyards.store');
    Route::delete('/graveyards/{id}', [AdminController::class, 'deleteGraveyard'])->name('graveyards.delete');
    
    // Janazah Announcements
    Route::get('/janazahs', [AdminController::class, 'janazahs'])->name('janazahs');
    Route::delete('/janazahs/{id}', [AdminController::class, 'deleteJanazah'])->name('janazahs.delete');
    
    // Volunteers & Field Providers
    Route::get('/volunteers', [AdminController::class, 'volunteers'])->name('volunteers');
    Route::post('/volunteers/store', [AdminController::class, 'storeVolunteer'])->name('volunteers.store');
    Route::delete('/volunteers/{id}', [AdminController::class, 'deleteVolunteer'])->name('volunteers.delete');
    
    // Cities
    Route::get('/cities', [AdminController::class, 'cities'])->name('cities');
    Route::post('/cities/store', [AdminController::class, 'storeCity'])->name('cities.store');
    Route::delete('/cities/{id}', [AdminController::class, 'deleteCity'])->name('cities.delete');
});
