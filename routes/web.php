<?php


Route::get("/",function(){
    return redirect('/login');
});

Auth::routes();
Route::get('/social/redirect/{provider}',   ['as' => 'social.redirect',   'uses' => 'Auth\SocialController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => 'social.handle',     'uses' => 'Auth\SocialController@getSocialHandle']);




//Route::get('/', function(){
//    return redirect('/login');
//});



Route::get('/redirect_url', function(){

});


Route::get('/test', function(){


    $code = \Illuminate\Support\Facades\Session::get('code');

    $client = new \Google_Client();
    $client->setAuthConfig(storage_path().'/google/credential.json');
    $client->addScope(\Google_Service_Drive::DRIVE);

    $redirect_uri = route('social.handle','google');


    $client->setRedirectUri($redirect_uri);

    $auth_url  = $client->createAuthUrl();

    if(!$code){
        return redirect($auth_url);
    }




    if($client->isAccessTokenExpired()){
        \Session::forget('code');
    }

    $client->authenticate(\Session::get('code'));

    $accessToken = $client->getAccessToken();


    $client->setAccessToken($accessToken);

    $service = new \Google_Service_Drive($client);

    $fileMetadata = new \Google_Service_Drive_DriveFile(array(
        'name' =>'title',
        'mimeType' => 'application/vnd.google-apps.document'));
    $file = $service->files->create($fileMetadata, array(
        'fields' => 'id'));

    return $file->id;


});




Route::get('/deneme', function(){
    return 'ddeneme';
});

Route::get("preview",function(){
	$tags = get_meta_tags($_GET['url']);
	dd($tags);
});

Route::group(['namespace' => 'Admin','middleware'=>'auth'], function () {

    Route::get('/dashboard',['as'=>"admin.dashboard",'uses'=>'DashboardController@index']);

    Route::get('case/{is_archived}',['as'=>'case.is_archived','uses'=>'CaseController@index']);

    Route::resource("categories",'CategoryController');
    Route::resource("messages",'MessageController');
    Route::resource("topics","TopicController");




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



});


Route::any('new-google-document/{title}',['as'=>'new.google.document','uses'=>'ServiceController@newGoogleDocument']);


Route::any('/service/messages/facebook', 'ServiceController@facebook');
Route::any('/service/messages/twitter', 'ServiceController@twitter');



Route::get('/home', 'HomeController@index');
