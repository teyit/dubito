<?php


//Route::get("/",function(){
//    return redirect('/messages');
//});

Auth::routes();




Route::get('/deneme', function(){
    $aa = findLinkFromText('Bu haberdeki pankartı teyit etmenizi rica ederim. Gerçekten bunu yapmışlar mı? https://l.facebook.com/l.php?u=https%3A%2F%2Fgoo.gl%2F0fRwjc&h=ATNB85y2l97dHIj7MZKrDsYRZ9QXZfQBlVAsH1Win3pA_kcWedNfqiegDW73sk9qhh7W7SZ740rYDA3CzP4HDgEEr_JT_8ruBZvhcZrvoZmk&s=1&enc=');

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
    Route::resource('evidences',"EvidenceController");
    Route::post('addCaseTag/{case_id}',['as'=>'case.tag.store','uses'=>'CaseController@addCaseTag']);
    Route::post('addCaseFile/{case_id}',['as'=>'case.file.store','uses'=>'CaseController@addCaseFile']);
    Route::post('removeCaseFile/{case_id}',['as'=>'case.file.remove','uses'=>'CaseController@removeCaseFile']);
    Route::put('assignUserToCase/{case_id}',['as'=>'case.user.assign','uses'=>'CaseController@assignUserToCase']);


    Route::put('caseStatus/{case_id}',['as'=>'case.status.update','uses'=>'CaseController@caseStatusUpdate']);


    Route::put('/report_files/{id}/status',['as'=>'report_files.status','uses'=>'ReportController@status']);
});




Route::any('/service/messages/facebook', 'ServiceController@facebook');
Route::any('/service/messages/twitter', 'ServiceController@twitter');



Route::get('/home', 'HomeController@index');
