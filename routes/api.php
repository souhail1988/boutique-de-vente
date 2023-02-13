<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/categories', [CategoriesController::class, 'index']);
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/show/{id}', [ProductController::class, 'show']);
    Route::post('/create', [ProductController::class, 'create'])->middleware('auth:sanctum');
    Route::put('/update/{id}', [ProductController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

