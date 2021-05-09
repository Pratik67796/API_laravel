<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\user_image;
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

Route::get('/select','api_user_controler@list');
Route::post('/insert','api_user_controler@create');
Route::delete('/delete/{id}','api_user_controler@del');
Route::put('/update','api_user_controler@edit');


Route::post('login','api_user_controler@login');
Route::post('uploadfile','api_user_controler@upload');
#Route::post('register', 'authlogin@register');

