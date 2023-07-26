<?php

use App\Http\CommentAPIController;
use App\Http\Controllers\TaskAPIController;
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

Route::get('/tasks', [TaskAPIController::class, 'index']);
Route::get('/tasks/{id}', [TaskAPIController::class, 'show']);
Route::post('/tasks', [TaskAPIController::class, 'store']);
Route::put('/tasks/{id}', [TaskAPIController::class, 'update']);
Route::delete('/tasks/{id}', [TaskAPIController::class, 'destroy']);

Route::prefix('comments')->group(function () {
    Route::get('/{taskId}', [CommentAPIController::class, 'getComment']);
    Route::post('/{taskId}/add', [CommentAPIController::class, 'addComment']);
    Route::put('/{taskId}/{commentId}', [CommentAPIController::class, 'updateComment']);
    Route::delete('/{taskId}/{commentId}', [CommentAPIController::class, 'deleteComment']);
});
