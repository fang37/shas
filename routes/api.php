<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/create', [APIController::class, 'create']);
Route::post('/id', [APIController::class, 'getId']);
Route::post('/upload', [APIController::class, 'image']);

// Route::post('/upload', function(Request $request) {
//     $content = $request->file('image')->get();
//     return response()->json([
//         'message' => 'data berhasil masuk'
//     ], 200);
// });
