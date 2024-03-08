<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
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

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::get('/getuser', [UserController::class, 'show']);
Route::get('/alluser', [UserController::class, 'index']);
Route::delete('/users/{id}', [UserController::class, 'delete']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/blog', [BlogController::class, 'store']);
    Route::post('/updateblog', [BlogController::class, 'update']);
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::get('/comments', [CommentController::class, 'index']);
    Route::get('/user', [AuthenticatedSessionController::class, 'current']);
});
