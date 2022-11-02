<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\ResponderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public Routes

// User Routes
// Route::post('/requests', [AuthController::class, 'storeCoordinates']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Request Routes
Route::get('/requests', [RequestsController::class, 'showRequests']);
Route::get('/requests/available', [RequestsController::class, 'allAvailableRequests']);
Route::post('/requests/create',[RequestsController::class, 'generateRequest']);
//cancelled and completed requests will go through this route below.
Route::post('/requests/addToArchive',[RequestsController::class, 'archiveDispatchRequest']);
Route::post('/requests/update',[RequestsController::class, 'updateRequest']);
Route::post('/requests/profile/history',[RequestsController::class, 'getProfileHistoryRequest']);
Route::post('/requests/cancel',[RequestsController::class, 'forceCancel']);


// Responder Route
Route::post('/responder/location',[ResponderController::class, 'updateLocation']);
Route::post('/responder/response',[ResponderController::class, 'createResponse']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
