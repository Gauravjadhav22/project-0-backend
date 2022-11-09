<?php

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

//public routes
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

//private routes
Route::middleware('auth:sanctum')->group(
    function () {

        Route::get('/user', [\App\Http\Controllers\AuthController::class, 'user']);
        Route::put('/updateuser/{id}', [\App\Http\Controllers\AuthController::class, 'updateUser']);
        Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
        Route::post('/addstudent', [\App\Http\Controllers\StudentController::class, 'addStudent']);
        Route::patch('/updatestudent/{id}', [\App\Http\Controllers\StudentController::class, 'updateStudent']);
        Route::delete('/deletestudent/{id}', [\App\Http\Controllers\StudentController::class, 'deleteStudent']);
        Route::get('/getstudents', [\App\Http\Controllers\StudentController::class, 'getStudents']);
        Route::get('/getstudent/{id}', [\App\Http\Controllers\StudentController::class, 'getStudent']);
    }
);