<?php



Route::get('/', function () {
    return view('home');
});
Route::get('login', function () {
    return view('login');
});

Route::get('about', function(){

    return view('about');

});

Route::get('password/reset','Auth\PasswordController@showLinkRequestForm');
Route::post('password/reset','Auth\PasswordController@postReset');
Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
Route::get('password/reset/{var}','Auth\PasswordController@showResetForm');


/*
Route::get('/','home\HomeController@homepage');
Route::get('login','home\HomeController@loginpage');*/
/*
Route::get('/',['before'=>'AuthController','uses'=>'home\HomeController@homepage']);
Route::get('login',['before'=>'AuthController','uses'=>'home\HomeController@loginpage']);
*/

Route::get('403', function(){
   return view('errors.403');
});

Route::get('register/company','register\RegisterController@company');
Route::post('register/company','register\RegisterController@registercompany');
Route::get('register/user','register\RegisterController@user');
Route::post('register/user','register\RegisterController@registeruser');
Route::get('register/userExternal','register\RegisterController@userExternalEvaluator');
Route::post('register/userExternal','register\RegisterController@registeruserExternalEvaluator');

Route::post('login','Auth\AuthController@postLogin');
Route::get('logout','Auth\AuthController@logout');

//Route::get('language/{locale}',function($locale){App::setLocale($locale); return $locale;});

//admin route
Route::group(['middleware'=>'admin',
                'namespace'=>'admin',
                'prefix'=>'admin'], function(){
    Route::get('/','DashboardController@index');
	Route::post('language','DashboardController@switchLanguage');
	
    Route::get('company','ProfileController@company');
    //This returns the edit blade
    Route::get('company/update','ProfileController@editCompany');
    //This posts back the edit blade to action updateCompanyProfile
    Route::post('company/update','ProfileController@updateCompany');

    Route::post('deleteCompanyProfile','ProfileController@deleteCompanyProfile');
    Route::get('members/deleteUserProfile/{id}','MembersController@deleteUserProfile');
    Route::get('members/disableUserProfile/{id}','MembersController@disableUserProfile');
    Route::get('members/enableUserProfile/{id}','MembersController@enableUserProfile');
    Route::resource('members','MembersController');
    Route::resource('roles','RolesController');
    Route::get('survey/getParticipant/{surveyId}/{participantId}','SurveyController@getParticipant');
    Route::get('survey/surveyResults','SurveyController@surveyResults');
    Route::get('survey/deleteSurvey/{id}','SurveyController@deleteSurvey');
    Route::get('survey/downloadPdf/{id}','SurveyController@downloadPdf');
    Route::get('survey/edit/{id}','SurveyController@editSurvey');
    Route::post('survey/update','SurveyController@updateSurvey');
	Route::resource('survey','SurveyController');
	
	Route::get('companySurvey/evaluateUser/{surveyId}/{userId}','CompanySurveyController@evaluateUser');
	Route::get('companySurvey/viewPeerResults/{surveyId}/{userId}','CompanySurveyController@viewPeerResults');
	Route::post('companySurvey/inviteEvaluators','CompanySurveyController@inviteEvaluators');
	Route::get('companySurvey/downloadAdminUserPdf/{id}','CompanySurveyController@downloadPdf');
    Route::get('companySurvey/downloadAdminUserCsv/{id}','CompanySurveyController@downloadCsv');
    Route::post('companySurvey/inviteExternalEvaluators','CompanySurveyController@inviteExternalEvaluators');
	Route::resource('companySurvey','CompanySurveyController');
	
    Route::get('survey/downloadExcel/{surveyId}',['as'=>'downloadExcelAdmin','uses'=>'SurveyController@downloadCsv']);
    Route::match(['get','post'],'survey/lookForParticipant',['as'=>'lookForParticipant','uses'=> 'SurveyController@lookForParticipant']);
    Route::get('usergroup/edit/{id}','UserGroupController@editUserGroup');
    Route::get('usergroup/deleteGroup/{id}','UserGroupController@deleteGroup');
    Route::post('usergroup/update','UserGroupController@updateUserGroup');
	Route::resource('usergroup','UserGroupController');

});

//Basic Route
Route::group(['middleware'=>'basic',
                'namespace'=>'basic',
                'prefix'=>'basic'],function(){
    Route::get('/','DashboardController@index');
    Route::post('language','DashboardController@switchLanguage');
	Route::resource('profile','ProfileController@index');
    Route::get('profile/deleteUserProfile/{id}','ProfileController@deleteUserProfile');
    Route::get('profile/resign/{id}','ProfileController@resign');
    Route::resource('profile','ProfileController');
    Route::get('survey/viewPeerResults/{surveyId}/{userId}','SurveyController@viewPeerResults');
	Route::get('survey/evaluateUser/{surveyId}/{userId}','SurveyController@evaluateUser');
	Route::post('survey/inviteEvaluators','SurveyController@inviteEvaluators');
	Route::post('survey/removeEvaluators','SurveyController@removeEvaluators');
	Route::post('survey/inviteExternalEvaluators','SurveyController@inviteExternalEvaluators');
	Route::get('survey/downloadPdf/{id}','SurveyController@downloadPdf');
    Route::get('survey/downloadCsv/{id}','SurveyController@downloadCsv');
    Route::resource('survey','SurveyController');
    Route::resource('usergroup','UserGroupController');

    });
	
	
//external Route
Route::group(['middleware'=>'external',
                'namespace'=>'external',
                'prefix'=>'external'],function(){
    Route::get('/','DashboardController@index');
    Route::post('language','DashboardController@switchLanguage');
	Route::get('profile/deleteUserProfile/{id}','ProfileController@deleteUserProfile');
    Route::resource('profile','ProfileController@index');
	Route::resource('profile','ProfileController');
    Route::get('survey/viewPeerResults/{surveyId}/{userId}','SurveyController@viewPeerResults');
	Route::get('survey/evaluateUser/{surveyId}/{userId}','SurveyController@evaluateUser');
	Route::post('survey/inviteEvaluators','SurveyController@inviteEvaluators');
	Route::post('survey/inviteExternalEvaluators','SurveyController@inviteExternalEvaluators');
	Route::post('survey/registerExternalEvaluators','SurveyController@registerExternalEvaluators');
	Route::post('survey/evaluateUserExternal','SurveyController@evaluateUserExternal');
	Route::resource('survey','SurveyController');
    Route::resource('usergroup','UserGroupController');

    });

//special route
Route::group(['middleware'=>'special',
               'namespace'=>'special',
               'prefix'=>'special'],function(){
    Route::get('/','DashboardController@index');
    Route::post('language','DashboardController@switchLanguage');
	Route::get('profile/deleteUserProfile/{id}','ProfileController@deleteUserProfile');
    Route::get('profile','ProfileController@index');
	Route::resource('profile','ProfileController');
    
    Route::get('survey/downloadPdf/{id}','CompanySurveyController@downloadPdf');
    Route::get('survey/downloadCsv/{id}','CompanySurveyController@downloadCsv');
    
	Route::get('survey/evaluateUser/{surveyId}/{userId}','CompanySurveyController@evaluateUser');
	Route::get('survey/viewPeerResults/{surveyId}/{userId}','CompanySurveyController@viewPeerResults');
	Route::post('survey/inviteEvaluators','CompanySurveyController@inviteEvaluators');
	Route::post('survey/inviteExternalEvaluators','CompanySurveyController@inviteExternalEvaluators');
	Route::resource('survey','CompanySurveyController');
	
	Route::get('groupSurvey/downloadPdf/{id}','SurveyController@downloadPdf');
    Route::get('groupSurvey/downloadCsv/{id}','SurveyController@downloadCsv');
    Route::get('groupSurvey/viewPeerResults/{surveyId}/{userId}','SurveyController@viewPeerResults');
	Route::get('groupSurvey/evaluateUser/{surveyId}/{userId}','SurveyController@evaluateUser');
	Route::post('groupSurvey/inviteEvaluators','SurveyController@inviteEvaluators');
	Route::post('groupSurvey/inviteExternalEvaluators','SurveyController@inviteExternalEvaluators');
	Route::post('groupSurvey/registerExternalEvaluators','SurveyController@registerExternalEvaluators');
	Route::post('groupSurvey/evaluateUserExternal','SurveyController@evaluateUserExternal');
	Route::resource('groupSurvey','SurveyController');

    Route::get('groupsurvey/getParticipant/{surveyId}/{groupId}/{participantId}','GroupSurveyController@getParticipant');
    Route::get('groupsurvey/deleteSurvey/{id}','GroupSurveyController@deleteSurvey');
    Route::get('groupsurvey/downloadPdf/{id}','GroupSurveyController@downloadPdf');
    Route::get('groupsurvey/edit/{id}','GroupSurveyController@editSurvey');
    Route::post('groupsurvey/update','GroupSurveyController@updateSurvey');
	Route::resource('groupsurvey','GroupSurveyController');
    Route::get('groupsurvey/downloadExcel/{surveyId}',['as'=>'downloadExcelSpecial','uses'=>'GroupSurveyController@downloadCsv']);

    Route::match(['get','post'],'groupsurvey/lookForParticipant',['as'=>'lookForParticipant','uses'=> 'GroupSurveyController@lookForParticipant']);


	Route::get('groupsurvey/getGroupMembers/{groupId}','GroupSurveyController@getGroupMembers');
    Route::match(['get','post'],'groupsurvey/lookForGroupMembers',['as'=>'lookForGroupMembers','uses'=> 'GroupSurveyController@lookForGroupMembers']);

    Route::get('usergroup/edit/{id}','UserGroupController@editUserGroup');
    Route::post('usergroup/update','UserGroupController@updateUserGroup');
	Route::resource('usergroup','UserGroupController');

    Route::get('groupsurveyresult','GroupSurveyResultController@index');

});
