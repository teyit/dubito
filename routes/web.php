<?php


Route::get("/",function(){
    return redirect('/messages');
});




Route::get('test', function(){
    $aa = pathinfo('https://scontent.xx.fbcdn.net/v/t34.0-12/17391857_10212784508193353_1675430441_n.jpg?_nc_ad=z-m&oh=5c95d43bba7a219039c4e2268b42432c&oe=58CF3144');

    dd($aa);
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
    Route::resource('links',"LinkController");
    Route::post('addCaseTag/{case_id}',['as'=>'case.tag.store','uses'=>'CaseController@addCaseTag']);
    Route::put('caseStatus/{case_id}',['as'=>'case.status.update','uses'=>'CaseController@caseStatusUpdate']);



    Route::put('/report_files/{id}/status',['as'=>'report_files.status','uses'=>'ReportController@status']);
});



Auth::routes();

Route::any('/service/messages/facebook', 'ServiceController@facebook');
Route::any('/service/messages/twitter', 'ServiceController@twitter');



Route::get('/home', 'HomeController@index');
