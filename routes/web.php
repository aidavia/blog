<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('/posts/{post:uuid}', [PostController::class, 'show'])->name('posts.show');

Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');

Route::get('/admin/posts/{post:uuid}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');

require __DIR__.'/auth.php';
