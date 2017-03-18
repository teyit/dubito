<?php


Route::get("/",function(){
    return redirect('/messages');
});




Route::get('test', function(){

    $message = \App\Model\Message::find(1);

    $message->files()->attach(1);

    dd($message);

});


Route::get("preview",function(){
	$tags = get_meta_tags($_GET['url']);
	dd($tags);
});

Route::group(['namespace' => 'Admin','middleware'=>'auth'], function () {
    
    Route::resource("categories",'CategoryController');
    Route::resource("messages",'MessageController');
    Route::resource("topics","TopicController");
    Route::resource("reports","ReportController");
    Route::resource("cases","CaseController");
    Route::resource("tags","TagController");
    Route::resource('cases.links',"LinkController");
    Route::post('addCaseTag/{case_id}',['as'=>'case.tag.store','uses'=>'CaseController@addCaseTag']);

    Route::put('/report_files/{id}/status',['as'=>'report_files.status','uses'=>'ReportController@status']);
});



Auth::routes();

Route::any('/service/messages/facebook', 'ServiceController@facebook');
Route::any('/service/messages/twitter', 'ServiceController@twitter');



Route::get('/home', 'HomeController@index');
