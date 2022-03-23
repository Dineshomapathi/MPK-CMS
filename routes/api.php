<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\VideoUploadController;

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

Route::get('/content', [ContentController::class, 'getContentAPIAll']);
Route::get('/content/{id}', [ContentController::class, 'getContentAPI']);
Route::get('/contents/{title}', [ContentController::class, 'getContentAPIDROPDOWN']);

Route::get('/image', [ImageUploadController::class, 'getImageAPIAll']);
Route::get('/image/{id}', [ImageUploadController::class, 'getImageAPI']);
Route::get('/imagescategory/{category}', [ImageUploadController::class, 'getImageAPIDROPDOWNCATEGORY']);
Route::get('/imagestitle/{title}', [ImageUploadController::class, 'getImageAPIDROPDOWNTITLE']);

Route::get('/video', [VideoUploadController::class, 'getVideoAPIAll']);
Route::get('/video/{id}', [VideoUploadController::class, 'getVideoAPI']);
Route::get('/videoscategory/{category}', [VideoUploadController::class, 'getVideoAPIDROPDOWNCATEGORY']);
Route::get('/videostitle/{title}', [VideoUploadController::class, 'getVideoAPIDROPDOWNTITLE']);