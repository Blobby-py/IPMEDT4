<?php


use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskUpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingleTaskController;

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

// Example of a custom rout
Route::put('/tasks/update', [TaskUpdateController::class, 'update']);

Route::get('/tasks/display/{id}', [SingleTaskController::class, 'display']);

Route::get('/tasks/showFinished/{user_id}', [TaskController::class, 'showFinished']);


Route::post('/tasks/store', [TaskController::class, 'store']);
Route::get('/tasks/show/{user_id}', [TaskController::class, 'show']);
Route::delete('/tasks/destroy/{id}', [TaskController::class, 'destroy']);

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/auth/me', [AuthController::class, 'me']);