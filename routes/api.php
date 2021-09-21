<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\Admin\PostController as AdminPostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostController::class, 'index'])->name('api.posts.index');
Route::get('/posts/{post:uuid}', [PostController::class, 'show'])->name('api.posts.show');
Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('api.admin.posts.index');
Route::post('/admin/posts', [AdminPostController::class, 'store'])->name('api.admin.posts.store');
Route::get('/admin/posts/{post:uuid}/edit', [AdminPostController::class, 'edit'])->name('api.admin.posts.show');
Route::patch('/admin/posts/{post:uuid}', [AdminPostController::class, 'update'])->name('api.admin.posts.update');
Route::delete('/admin/posts/{post:uuid}', [AdminPostController::class, 'destroy'])->name('api.admin.posts.destroy');
