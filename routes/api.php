<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HeroController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\SeriesController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\PostDetailController;
use App\Http\Controllers\API\SeriesPartController;
use App\Http\Controllers\API\SeriesPartContentsController;

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('hero', [HeroController::class, 'store']);
    Route::get('hero/{id}/edit', [HeroController::class, 'edit']);
    Route::put('hero/{id}/update', [HeroController::class, 'update']);
    Route::delete('hero/{id}/delete', [HeroController::class, 'destroy']);

    Route::post('post', [PostController::class, 'store']);
    Route::get('post/{postId}/edit', [PostController::class, 'edit']);
    Route::put('post/{postId}/update', [PostController::class, 'update']);
    Route::delete('post/{postId}/delete', [PostController::class, 'destroy']);

    Route::post('post_details/{postId}', [PostDetailController::class, 'store']);
    Route::put('post_details/{postDetailId}', [PostDetailController::class, 'update']);
    Route::delete('post_details/{postDetailId}/', [PostDetailController::class, 'destroy']);


    Route::post('series', [SeriesController::class, 'store']);
    Route::get('series/{seriesId}', [SeriesController::class, 'edit']);
    Route::put('series/{seriesId}', [SeriesController::class, 'update']);
    Route::delete('series/{seriesId}', [SeriesController::class, 'destroy']);

    Route::post('series-part', [SeriesPartController::class, 'store']);
    Route::get('series-part/{seriesPartId}', [SeriesPartController::class, 'edit']);
    Route::put('series-part/{seriesPartId}', [SeriesPartController::class, 'update']);
    Route::delete('series-part/{seriesPartId}', [SeriesPartController::class, 'destroy']);

    Route::post('series-part-contents/{seriesPartId}', [SeriesPartContentsController::class, 'store']);
    Route::get('series-part-contents/{seriesPartContentsId}/edit', [SeriesPartContentsController::class, 'edit']);
    Route::put('series-part-contents/{seriesPartContentsId}', [SeriesPartContentsController::class, 'update']);
    Route::delete('series-part-contents/{seriesPartContentsId}', [SeriesPartContentsController::class, 'destroy']);
});

Route::get('heroes', [HeroController::class, 'index']);
Route::get('posts', [PostController::class, 'index']);
Route::get('publishedPosts', [PostController::class, 'publishedPosts']);
Route::get('post_details/{postId}', [PostDetailController::class, 'index']);
Route::get('series', [SeriesController::class, 'index']);
Route::get('publishedSeries', [SeriesController::class, 'publishedSeries']);
Route::get('series/{seriesId}/part', [SeriesPartController::class, 'index']);
Route::get('series-part-contents/{seriesPartId}', [SeriesPartContentsController::class, 'index']);
