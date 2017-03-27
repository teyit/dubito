<?php


//Route::get("/",function(){
//    return redirect('/messages');
//});

Auth::routes();




Route::get('/', function(){
    return redirect('/home');
});


Route::get("preview",function(){
	$tags = get_meta_tags($_GET['url']);
	dd($tags);
});

Route::group(['namespace' => 'Admin','middleware'=>'auth'], function () {

    Route::get('case/{is_archived}',['as'=>'case.is_archived','uses'=>'CaseController@index']);

    Route::resource("categories",'CategoryController');
    Route::resource("messages",'MessageController');
    Route::resource("topics","TopicController");
    Route::resource("reports","ReportController");
    Route::resource("cases","CaseController");
    Route::resource("tags","TagController");
    Route::resource('links',"LinkController");
    Route::resource('evidences',"EvidenceController");
    Route::post('addCaseTag/{case_id}',['as'=>'case.tag.store','uses'=>'CaseController@addCaseTag']);
    Route::post('addCaseFile/{case_id}',['as'=>'case.file.store','uses'=>'CaseController@addCaseFile']);
    Route::post('removeCaseFile/{case_id}',['as'=>'case.file.remove','uses'=>'CaseController@removeCaseFile']);
    Route::post('assignUserToCase/{case_id}',['as'=>'case.user.assign','uses'=>'CaseController@assignUserToCase']);
    Route::post('/caseSendToArchive/{case_id}',['as'=>'case.sendarchive','uses'=>'CaseController@caseSendToArchive']);

    Route::put('caseStatus/{case_id}',['as'=>'case.status.update','uses'=>'CaseController@caseStatusUpdate']);


    Route::put('/report_files/{id}/status',['as'=>'report_files.status','uses'=>'ReportController@status']);
});




Route::any('/service/messages/facebook', 'ServiceController@facebook');
Route::any('/service/messages/twitter', 'ServiceController@twitter');



Route::get('/home', 'HomeController@index');
