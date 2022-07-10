<?php

use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MainController;

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

Route::get('/', MainController::class)->name('home');
Route::get('/book/react', ['as' => 'book.react', 'uses' => 'App\Http\Controllers\AjaxController@react']);
Route::resource('book', BookController::class);
