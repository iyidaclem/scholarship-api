<?php

use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Users
Route::post("/create", [UserController::class, "store"]);
Route::get("/users", [UserController::class, "index"]);
Route::post("/update/{id}", [UserController::class, "update"]);
Route::delete("/delete/{id}", [UserController::class, "destroy"]);

// Scholarships

Route::post("/scholarship/create", [ScholarshipController::class, "store"]);
Route::get("/scholarship", [ScholarshipController::class, "index"]);
Route::post("/scholarship/update/{id}", [ScholarshipController::class, "update"]);
Route::delete("/scholarship/delete/{id}", [ScholarshipController::class, "destroy"]);

