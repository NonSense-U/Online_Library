<?php

use App\Http\Controllers\V1\Accounts\AuthController;
use App\Http\Controllers\V1\Admin\AuthorController;
use App\Http\Controllers\V1\Admin\BookController;
use App\Http\Controllers\V1\Admin\GenreController;
use App\Http\Controllers\V1\Admin\PublisherController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function(){
    dd('smile darling UwU');
});


//! Accounts
Route::post('/signup',[AuthController::class,'signup']);
Route::post('/login', [AuthController::class,'login']);
Route::delete('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');


//! Books
Route::put('/books/{book_id}', [BookController::class, 'updateBook']);
Route::post('/books/add', [BookController::class, 'addBook']);
Route::delete('/books/delete/{book_id}',[BookController::class,'deleteBook']);
Route::get('/books/{book_id}',[BookController::class,'getBook']);
Route::get('/books',[BookController::class,'index']);


//! Authors
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{auhtor_id}', [AuthorController::class, 'getAuthor']);
Route::post('/authors/add', [AuthorController::class, 'addAuthor']);
Route::delete('/authors/delete/{author_id}', [AuthorController::class, 'deleteAuthor']);
Route::put('/authors/{author_id}', [AuthorController::class, 'updateAuthor']);

//! Publishers
Route::get('/publishers', [PublisherController::class, 'index']);
Route::get('/publishers/{publisher_id}', [PublisherController::class, 'getPublisher']);
Route::post('/publishers/add', [PublisherController::class, 'addPublisher']);
Route::put('/publishers/{publisher_id}',[PublisherController::class, 'updatePublisher']);
Route::delete('/publishers/delete/{publisher_id}', [PublisherController::class, 'deletePublisher']);

//! Genres
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{genre_id}', [GenreController::class, 'getGenre']);
Route::post('/genres/add', [GenreController::class, 'addGenre']);
Route::put('/genres/{genre_id}', [GenreController::class, 'updateGenre']);
Route::delete('/genres/delete/{genre_id}', [GenreController::class,'deleteGenre']);


Route::middleware(['auth:sanctum'])->group(function(){

});
