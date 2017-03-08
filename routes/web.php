<?php


Route::get("/",function(){
    return redirect('/reports');
});


Route::group(['namespace' => 'Admin'], function () {
    
    Route::resource("categories",'CategoryController');
    Route::resource("topics","TopicController");
    Route::resource("reports","ReportController");
    Route::resource("cases","CaseController");
    Route::resource("tags","TagController");
    Route::put('/report_files/{id}/status',['as'=>'report_files.status','uses'=>'ReportController@status']);
});



Auth::routes();

Route::any('/messages/facebook', 'MessageController@facebook');
Route::any('/messages/twitter', 'MessageController@twitter');



Route::get('/home', 'HomeController@index');
