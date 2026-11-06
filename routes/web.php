<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\SosController;
use App\Http\Controllers\WarningController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - BaliGuard Tourist Safety & Emergency Response System
|--------------------------------------------------------------------------
*/

// Public Tourist Portal
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/guidelines', [HomeController::class, 'guidelines'])->name('guidelines');
Route::get('/map', [HomeController::class, 'map'])->name('map');

// Incident Reporting & Tracking
Route::get('/report', [IncidentController::class, 'create'])->name('report.create');
Route::post('/report', [IncidentController::class, 'store'])->name('report.store');
Route::get('/track/{code?}', [IncidentController::class, 'track'])->name('report.track');

// SOS & Emergency API
Route::post('/api/sos', [SosController::class, 'trigger'])->name('api.sos.trigger');
Route::get('/api/sos/{ticket_id}', [SosController::class, 'checkStatus'])->name('api.sos.status');

// Google Gemini AI Safety Chatbot
Route::post('/api/chat', [ChatbotController::class, 'chat'])->name('api.chat');
Route::get('/api/chat/history', [ChatbotController::class, 'history'])->name('api.chat.history');
Route::post('/api/chat/clear', [ChatbotController::class, 'clear'])->name('api.chat.clear');

// Dispatcher & Admin Panel
Route::prefix('admin')->middleware('admin.auth')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // SOS Dispatch Feed
    Route::get('/sos', [AdminController::class, 'sosIndex'])->name('sos.index');
    Route::post('/sos/{id}', [AdminController::class, 'updateSos'])->name('sos.update');
    
    // Incident Management
    Route::get('/incidents', [AdminController::class, 'incidentsIndex'])->name('incidents.index');
    Route::post('/incidents/{id}', [AdminController::class, 'updateIncident'])->name('incidents.update');
    
    // Early Warning Broadcasts
    Route::get('/warnings', [WarningController::class, 'index'])->name('warnings.index');
    Route::post('/warnings', [WarningController::class, 'store'])->name('warnings.store');
    Route::post('/warnings/{id}/toggle', [WarningController::class, 'toggle'])->name('warnings.toggle');
    Route::delete('/warnings/{id}', [WarningController::class, 'destroy'])->name('warnings.destroy');
});
