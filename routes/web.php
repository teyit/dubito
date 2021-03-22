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

Route::get('/test','\App\Http\Controllers\Admin\MessageController@test');

Route::get("preview",function(){
	$tags = get_meta_tags($_GET['url']);
	dd($tags);
});

Route::get('public/evidences',['as'=>'case.public','uses'=>'Admin\CaseController@evidences_list']);
Route::get('public/{news_feed}',['as'=>'case.public','uses'=>'Admin\CaseController@feed']);
Route::get('public/evidences/{case_id}',['as'=>'case.public','uses'=>'Admin\CaseController@evidences']);

Route::group(['namespace' => 'Admin','middleware'=>['auth']], function () {

    Route::get('/',['as'=>"admin.dashboard",'uses'=>'DashboardController@index']);

    Route::get('case/{folder}',['as'=>'case.folder','uses'=>'CaseController@index']);

    Route::resource("categories",'CategoryController');
    Route::resource("messages",'MessageController');
    Route::get("threads",'MessageController@showSenders');
    Route::post("messages/new",'MessageController@postNew');
    Route::get("messages/{thread_id}/show_page",['as'=>'messages.show_page','uses'=>'MessageController@showPage']);
    Route::put('mark-as-review','MessageController@review');
	Route::put('remove-as-review','MessageController@removeReview');

    Route::resource("topics","TopicController");



    //Reviews
    Route::resource("reviews","ReviewController");

    //User
    Route::resource("users","UserController");
    Route::post('assignRoleToUser/{user_id}',['as'=>'user.role.assign','uses'=>'UserController@assignRoleToUser']);
    Route::post('assignStatusToUser/{user_id}',['as'=>'user.status.assign','uses'=>'UserController@assignStatusToUser']);

//
Route::resource("mailList","MailListController");

    //Reports
    Route::get('report/{folder}',['as'=>'report.folder','uses'=>'ReportController@index']);
    Route::resource("reports","ReportController");
    Route::get('allreports',['uses'=>'ReportController@showAll']);

    Route::post("custom-store-reports",['as'=>'custom.store.reports','uses'=>'ReportController@customStore']);
    Route::put("custom-update-reports/{report_id}",['as'=>'custom.update.reports','uses'=>'ReportController@customUpdate']);
    Route::post('removeReportFile/{case_id}',['as'=>'report.file.remove','uses'=>'ReportController@removeReportFile']);
    Route::put('/report_files/{id}/status',['as'=>'report_files.status','uses'=>'ReportController@status']);


    //Cases
    Route::get('cases/{case_id}/press',['as'=>'case.press','uses'=>'CaseController@press']);
    Route::get('cases/{case_id}/press_review',['as'=>'case.press_review','uses'=>'CaseController@press_review']);
    Route::resource("cases","CaseController");



    Route::post('addCaseTag/{case_id}',['as'=>'case.tag.store','uses'=>'CaseController@addCaseTag']);
    Route::post('addCaseImage/{case_id}',['as'=>'case.image.store','uses'=>'CaseController@addCaseImage']);
    Route::post('addCaseFile/{case_id}',['as'=>'case.file.store','uses'=>'CaseController@addCaseFile']);
    Route::post('removeCaseFile/{case_id}',['as'=>'case.file.remove','uses'=>'CaseController@removeCaseFile']);
    Route::post('assignUserToCase/{case_id}',['as'=>'case.user.assign','uses'=>'CaseController@assignUserToCase']);
	Route::post('assignUserToCase/',['as'=>'case.user.assign','uses'=>'CaseController@assignUserToCase']);
    Route::post('change-title/{case_id}',['as'=>'change.title','uses'=>'CaseController@changeTitle']);
    Route::post('change-category/{case_id}',['as'=>'change.category','uses'=>'CaseController@changeCategory']);

	Route::get('caseFolder/{case_id}',['as'=>'case.folder.update','uses'=>'CaseController@setFolder']);
    Route::put('caseFolder/{case_id}',['as'=>'case.folder.update','uses'=>'CaseController@setFolder']);
    Route::put('caseStatus/{case_id}',['as'=>'case.status.update','uses'=>'CaseController@caseStatusUpdate']);
	Route::post('caseStatus/',['as'=>'case.status.query','uses'=>'CaseController@caseStatusUpdate']);

    
    Route::post('caseActivity/{case_id}',['as'=>'case.activity.add','uses'=>'CaseController@addActivity']);
    Route::post('caseActivity/{case_id}/{activity_id}',['as'=>'case.activity.update','uses'=>'CaseController@updateActivity']);
    Route::post('setPublished/{case_id}',['as'=>'case.published.set','uses'=>'CaseController@setPublished']);
    Route::post('setPublished/',['as'=>'case.published.set','uses'=>'CaseController@setPublished']);
    Route::post('cases/setPublishedLink/{case_id}',['as'=>'case.published.set','uses'=>'CaseController@setPublishedLink']);
    Route::post('cases/setNoAnalysis/{case_id}',['as'=>'case.noAnalysis.set','uses'=>'CaseController@setNoAnalysis']);
    Route::get('tag/{folder}',['as'=>'tag','uses'=>'TagController@feed']);
    Route::get('category/{folder}',['as'=>'tag','uses'=>'CategoryController@feed']);




    Route::resource("tags","TagController");
    Route::resource('links',"LinkController");
    Route::resource('evidences',"EvidenceController");

    //Logs

    Route::resource("logs","LogController");

});

Route::get('/deneme', function(){


});


Route::any('new-google-document/{title}',['as'=>'new.google.document','uses'=>'ServiceController@newGoogleDocument']);


Route::any('/service/messages/facebook', 'ServiceController@facebook');
Route::any('/service/messages/twitter', 'ServiceController@twitter');
Route::any('/service/teyitlink/callback','ServiceController@teyitlink');


Route::get('/home', 'HomeController@index');
