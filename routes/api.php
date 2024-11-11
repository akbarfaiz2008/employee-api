<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Account
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Employee
Route::get('/list-employee', [EmployeeController::class, 'index']);
Route::get('/view-employee/{id}', [EmployeeController::class, 'show']);
Route::post('/create-employee', [EmployeeController::class, 'store']);
Route::post('/update-employee/{id}', [EmployeeController::class, 'update']);
Route::post('/delete-employee/{id}', [EmployeeController::class, 'destroy']);
