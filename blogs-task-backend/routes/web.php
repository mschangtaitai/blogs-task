<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

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

Route::get('/alluser', [UserController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/getuser/{id}', [UserController::class, 'show']);
    Route::get('/blog/{id}', [BlogController::class, 'show']);
    Route::post('/blog', [BlogController::class, 'store']);
    Route::post('/updateblog', [BlogController::class, 'update']);
    Route::get('/blogs/{user_id}', [BlogController::class, 'index']);
    Route::get('/feed', [BlogController::class, 'feed']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::get('/comments', [CommentController::class, 'index']);
    Route::delete('/comment/{id}', [CommentController::class, 'delete']);
    Route::get('/user', [AuthenticatedSessionController::class, 'current']);
    Route::delete('/blog/{id}', [BlogController::class, 'delete']);
});

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});



require __DIR__ . '/auth.php';
