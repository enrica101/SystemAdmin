<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::post('/requests', [AuthController::class, 'storeCoordinates']);
Route::get('/requests', [AuthController::class, 'allCcoordinates']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('responder/register/id', [ResponderController::class, 'createResponder']);
Route::post('/login', [AuthController::class, 'login']);
    


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
