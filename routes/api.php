<?php

use App\Http\Controllers\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/tasks", [TaskController::class, "get"]);
Route::post("/tasks", [TaskController::class, "create"]);
Route::get("/tasks/{id}/status", [TaskController::class, "status"]);
Route::get("/tasks/{id}/stop", [TaskController::class, "stop"]);

Route::post("/group", [GroupController::class, "create"]);
Route::get("/group/{id}/status", [GroupController::class, "status"]);
Route::get("/group/{id}/stop", [GroupController::class, "stop"]);
