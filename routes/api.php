<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

 


Route::post('/student-login', [AuthController::class, 'login']);
Route::post('/registration', [AuthController::class, 'create']);






//Users

Route::middleware(['auth', 'checkUserRole'])->group(function () {
    Route::get('/employee', [ListController::class, 'employee']);
    Route::get('/student', [ListController::class, 'student']);
    Route::get('/student/search', [ListController::class, 'search']);
    Route::get('/employee/search', [ListController::class, 'search']);
    Route::post('/employee/create', [ListController::class, 'create']);
    Route::post('/student/create', [ListController::class, 'create_stud']);
    Route::put('/employee/update/{id}',[ListController::class,'update']);
    Route::put('/student/update/{id}',[ListController::class,'update_stud']);
    Route::delete('/employee/delete/{id}',[ListController::class,'delete']);
    Route::delete('/student/delete/{id}',[ListController::class,'delete_stud']);
    });