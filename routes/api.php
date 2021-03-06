<?php

use Illuminate\Http\Request;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */


Route::group(['namespace' => 'Api','middleware'=>['auth']],function(){
    Route::resource("cases","CaseController");
    Route::resource("categories","CategoryController");
    Route::resource("users","UserController");
    Route::resource("roles","RoleController");
    Route::resource("messageTemplates","MessageTemplateController");
    Route::delete("messageTemplates","MessageTemplateController@destroy");

    Route::get("search","SearchController@search");
});




