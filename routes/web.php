<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;


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

Route::get("/", 'App\Http\Controllers\Controller@home');

Route::get("/video={id}/{src}", 'App\Http\Controllers\Controller@video');

Route::get("/login", 'App\Http\Controllers\Controller@display_login');

Route::get("/logout", 'App\Http\Controllers\Controller@logout');

Route::post("/login", 'App\Http\Controllers\LoginController@login');

Route::get("/home/{type?}/{ricerca?}", "App\Http\Controllers\SectionController@load");

Route::get("/subscriptions", "App\Http\Controllers\SectionController@myCreators");

Route::post("/myFavourites", "App\Http\Controllers\InteractionsController@favouritesManager");
