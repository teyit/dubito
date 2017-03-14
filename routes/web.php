<?php


Route::get("/",function(){
    return redirect('/reports');
});




Route::get("preview",function(){
	$tags = get_meta_tags($_GET['url']);
	dd($tags);
});

Route::group(['namespace' => 'Admin','middleware'=>'auth'], function () {
    
    Route::resource("categories",'CategoryController');
    Route::resource("topics","TopicController");
    Route::resource("reports","ReportController");
    Route::resource("cases","CaseController");
    Route::resource("tags","TagController");
    Route::put('/report_files/{id}/status',['as'=>'report_files.status','uses'=>'ReportController@status']);
});


Route::get('messages', function(){
    return view('messages');
});


Auth::routes();

Route::any('/messages/facebook', 'MessageController@facebook');
Route::any('/messages/twitter', 'MessageController@twitter');



Route::get('/home', 'HomeController@index');
