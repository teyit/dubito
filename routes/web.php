<?php


Route::get("/",function(){
    return redirect('/reports');
});


Route::group(['namespace' => 'Admin'], function () {
    
    Route::resource("categories",'CategoryController');
    Route::resource("topics","TopicController");
    Route::resource("reports","ReportController");
    Route::put('/report_files/{id}/status',['as'=>'report_files.status','uses'=>'ReportController@status']);
    Route::resource("cases","CaseController");
    Route::resource("tags","TagController");
});



Auth::routes();

Route::any('/messages/facebook', 'MessageController@facebook');
Route::any('/messages/twitter', 'MessageController@twitter');
Route::any('/messages/test', 'MessageController@test');


Route::get('/home', 'HomeController@index');
