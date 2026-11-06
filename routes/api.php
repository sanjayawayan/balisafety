<?php

use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\SosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/sos/trigger', [SosController::class, 'trigger']);
Route::get('/sos/{ticket_id}', [SosController::class, 'checkStatus']);
Route::post('/chatbot/message', [ChatbotController::class, 'chat']);
Route::get('/chatbot/history', [ChatbotController::class, 'history']);
