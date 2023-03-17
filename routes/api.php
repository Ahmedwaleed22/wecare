<?php

use App\Http\Controllers\PatientsController;
use App\Http\Controllers\TestsController;
use App\Http\Controllers\TestsDataController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Users Routes
Route::group([
    'prefix' => 'users',
], function() {
    Route::post('/login', [UsersController::class, 'login']);
    Route::post('/register', [UsersController::class, 'register']);
    Route::middleware('auth:sanctum')->get('/me', [UsersController::class, 'me']);
});

// Patient Data Routes
Route::group([
    'prefix' => 'patients',
    'middleware' => 'auth:sanctum'
], function() {
    Route::get('/', [PatientsController::class, 'all']);
    Route::post('/', [PatientsController::class, 'store']);
    Route::get('/{patient}', [PatientsController::class, 'show']);
});

// Tests Data Routes
Route::group([
    'prefix' => 'tests',
    'middleware' => 'auth:sanctum'
], function() {
    Route::get('/', [TestsController::class, 'all']);
    Route::get('/submited-data', [TestsDataController::class, 'all']);
    Route::get('/submited-data/{testData}', [TestsDataController::class, 'show']);
    Route::get('/{test}', [TestsController::class, 'get']);
    Route::post('/', [TestsDataController::class, 'store']);
});