<?php

declare(strict_types=1);

use App\Http\Controllers\CommentController;
use App\Http\Controllers\IssueTypesController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', static function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
Route::get('/tasks', [TaskController::class, 'get'])->name('tasks.get');
Route::get('/issues', [IssueTypesController::class, 'show'])->name('issue.index');
Route::get('/issue/create', [IssueTypesController::class, 'createForm'])->name('issue.create');
Route::post('/issue/create', [IssueTypesController::class, 'create'])->name('issue.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
Route::put('/task/update/{id}', [TaskController::class, 'update'])->name('task.update');
Route::post('/task/delete/{id}', [TaskController::class, 'destroy'])->name('task.delete');
Route::get('/task/show/{id}', [TaskController::class, 'showSingle'])->name('task.show');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});
Auth::routes();

