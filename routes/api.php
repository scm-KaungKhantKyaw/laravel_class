<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\API\CategoryController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', function() {
    return Post::paginate(2);
});

Route::get('posts/{id}', function($id) {
    return Post::find($id);
});

// Route::get('category', [CategoryController::class, 'index']);
// Route::get('category/{id}', [CategoryController::class, 'show']);
// Route::post('category', [CategoryController::class, 'store']);
// Route::put('category/{id}', [CategoryController::class, 'update']);
// Route::delete('category/{id}', [CategoryController::class, 'destory']);

Route::get('product', [ProductController::class, 'index']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::post('product', [ProductController::class, 'store']);
Route::put('product/{id}', [ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class, 'destory']);

Route::apiResource('category', CategoryController::class);
