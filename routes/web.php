<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/api', function () {
    return view('api');
})->name('api');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('content', \App\Http\Controllers\ContentController::class);
    Route::resource('videoupload', \App\Http\Controllers\VideoUploadController::class);
    Route::resource('imageupload', \App\Http\Controllers\ImageUploadController::class);
    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::get('category', [CategoryController::class, 'index'])->name('category');
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});