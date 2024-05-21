<?php

use App\Http\Src\v1\Controllers\AuthController;
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function ($router) {
    Route::post('/add-student', [AuthController::class, 'addStudent']);
    Route::get('/get-students', [AuthController::class, 'getStudents']);
    Route::get('/get-profile/{id}', [AuthController::class, 'getProfile']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    Route::delete('/delete/{id}', [AuthController::class, 'deleteStudent']);
});

