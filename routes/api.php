<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Users Routes

Route::group([
    'prefix' => 'users',
], function() {
    Route::post('/login', [UsersController::class, 'login']);
    Route::post('/register', [UsersController::class, 'register']);
    Route::get('/', [UsersController::class, 'me']);
});

// Tests Data Routes

Route::group([
    'prefix' => 'tests',
    'middleware' => 'auth:sanctum'
], function() {
    Route::get('/', [TestsDataController::class, 'all']);
    Route::post('/', [TestsDataController::class, 'store']);
    Route::post('/{testData}', [TestsDataController::class, 'show']);
});