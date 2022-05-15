<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BookReviewController;

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
//---------------------IndexController---------------------//
Route::get('/', [IndexController::class, 'home']);
Route::get('/book-detail/{keyword}', [IndexController::class, 'bookdetail']);
Route::get('/book-view-online/{keyword}', [IndexController::class, 'bookviewonline']);
Route::get('/book-with-category/{keyword}', [IndexController::class, 'bookwithcategory']);
Route::post('/search', [IndexController::class, 'search']);
Route::post('/autocomplete-ajax', [IndexController::class, 'search_ajax']);
Route::get('/book-review-home', [IndexController::class, 'review_index']);
Route::post('/review-search', [IndexController::class, 'review_search']);
Route::get('/more-book', [IndexController::class, 'more_book']);
//---------------------ReviewController---------------------//
Route::resource('/book-review', BookReviewController::class);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
//---------------------CategoryController---------------------//
Route::resource('/category', CategoryController::class);
//---------------------BookController---------------------//
Route::resource('/book', BookController::class);
//---------------------ChapterController---------------------//
Route::resource('/chapter', ChapterController::class);