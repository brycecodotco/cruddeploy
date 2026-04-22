<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;

Route::get('/', function () {
    return redirect('/books');
});


Route::get('/books',[BooksController::class,'index']);
Route::post('/storebook',[BooksController::class,'store']);
Route::get('/books/{id}/edit',[BooksController::class,'edit']);
Route::put('/books/{id}',[BooksController::class,'update']);
Route::delete('/books/{id}',[BooksController::class,'destroy']);