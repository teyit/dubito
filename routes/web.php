<?php


Route::get("/",function(){
    return redirect('/login');
});


Route::get('/deneme', function(){
    return 'aa';
});

Auth::routes();

Route::get('/social/redirect/{provider}',   ['as' => 'social.redirect',   'uses' => 'Auth\SocialController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => 'social.handle',     'uses' => 'Auth\SocialController@getSocialHandle']);



//Route::get('/', function(){
//    return redirect('/login');
//});








Route::get("preview",function(){
	$tags = get_meta_tags($_GET['url']);
	dd($tags);
});

Route::group(['namespace' => 'Admin','middleware'=>'auth'], function () {

    Route::get('/',['as'=>"admin.dashboard",'uses'=>'DashboardController@index']);

    Route::get('case/{is_archived}',['as'=>'case.is_archived','uses'=>'CaseController@index']);

    Route::resource("categories",'CategoryController');
    Route::resource("messages",'MessageController');
    Route::get("threads",'MessageController@showSenders');
    Route::put('mark-as-review','MessageController@review');

    Route::resource("topics","TopicController");



    //Reviews
    Route::resource("reviews","ReviewController");


    //Reports
    Route::resource("reports","ReportController");
    Route::post("custom-store-reports",['as'=>'custom.store.reports','uses'=>'ReportController@customStore']);
    Route::put("custom-update-reports/{report_id}",['as'=>'custom.update.reports','uses'=>'ReportController@customUpdate']);
    Route::post('removeReportFile/{case_id}',['as'=>'report.file.remove','uses'=>'ReportController@removeReportFile']);
    Route::put('/report_files/{id}/status',['as'=>'report_files.status','uses'=>'ReportController@status']);


    //Cases
    Route::resource("cases","CaseController");
    Route::post('addCaseTag/{case_id}',['as'=>'case.tag.store','uses'=>'CaseController@addCaseTag']);
    Route::post('addCaseFile/{case_id}',['as'=>'case.file.store','uses'=>'CaseController@addCaseFile']);
    Route::post('removeCaseFile/{case_id}',['as'=>'case.file.remove','uses'=>'CaseController@removeCaseFile']);
    Route::post('assignUserToCase/{case_id}',['as'=>'case.user.assign','uses'=>'CaseController@assignUserToCase']);
    Route::post('/caseSendToArchive/{case_id}',['as'=>'case.sendarchive','uses'=>'CaseController@caseSendToArchive']);
    Route::put('caseStatus/{case_id}',['as'=>'case.status.update','uses'=>'CaseController@caseStatusUpdate']);



    Route::resource("tags","TagController");
    Route::resource('links',"LinkController");
    Route::resource('evidences',"EvidenceController");

    //Logs

    Route::resource("logs","LogController");

});



Route::get('/deneme', function(){

    $aa = \Carbon\Carbon::parse('2017-05-22 21:17:45');
    $now = \Carbon\Carbon::now();

    $xx = $now->diffInMinutes($aa);
    dd($xx);

});


Route::any('new-google-document/{title}',['as'=>'new.google.document','uses'=>'ServiceController@newGoogleDocument']);


Route::any('/service/messages/facebook', 'ServiceController@facebook');
Route::any('/service/messages/twitter', 'ServiceController@twitter');



Route::get('/home', 'HomeController@index');
