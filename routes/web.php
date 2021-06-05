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

Route::post("/accountSettings", "App\Http\Controllers\InteractionsController@infoManager");

Route::post("/uploadVideo", "App\Http\Controllers\CreatorController@newVideo");

Route::get("/video/of/{crid}", "App\Http\Controllers\CreatorController@getVideos");

Route::get("/content/{id}/{src}", "App\Http\Controllers\Controller@videoPage");

Route::post("/subscribe", "App\Http\Controllers\InteractionsController@subscribe");

Route::post("/unsubscribe", "App\Http\Controllers\InteractionsController@unsubscribe");

Route::post("/support", "App\Http\Controllers\InteractionsController@support");

Route::post("/unsupport", "App\Http\Controllers\InteractionsController@unsupport");

Route::get("/join_us", "App\Http\Controllers\Controller@display_joinus");

Route::post("/join_us", "App\Http\Controllers\Controller@joinus");

Route::get("/leave_us", "App\Http\Controllers\Controller@leave_us");

Route::get("/image_palette/{category?}", "App\Http\Controllers\ApiController@imagePalette");
