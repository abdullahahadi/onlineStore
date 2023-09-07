<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/{name?}',function($name = null){
    return 'Hi from laravel 8 '. $name;
});//only accepts string value not numeric: added in RouteServiceProvider

Route::get('/product/{id?}',function($id = null){
    return 'Hi from laravel 8 '. $id;
})->where('id','[0-9]+');//only accepts numeric values not string

Route::match(['get','post','put'], '/students', function(Request $req){
    return 'Requested method is '. $req->method();
});

Route::any('/posts', function(Request $req){
    return 'Requested method is '. $req->method();
});