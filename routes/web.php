<?php


Route::get("/",function(){
    return 'Dubito';
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

Route::get('/home', 'HomeController@index');
