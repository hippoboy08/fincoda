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
Route::post('password/reset','Auth\passwordController@postReset');
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

Route::post('login','Auth\AuthController@postLogin');
Route::get('logout','Auth\AuthController@logout');

//admin route
Route::group(['middleware'=>'admin',
                'namespace'=>'admin',
                'prefix'=>'admin'], function(){


    Route::get('/','DashboardController@index');
    Route::get('company','ProfileController@company');
    //This returns the edit blade
    Route::get('company/update','ProfileController@editCompany');
    //This posts back the edit blade to action updateCompanyProfile
    Route::post('company/update','ProfileController@updateCompany');
	
    Route::post('deleteCompanyProfile','ProfileController@deleteCompanyProfile');
    Route::resource('members','MembersController');
    Route::resource('roles','RolesController');
    Route::get('survey/getParticipant/{surveyId}/{participantId}','SurveyController@getParticipant');
    Route::resource('survey','SurveyController');
    Route::get('survey/downloadExcel/{surveyId}',['as'=>'downloadExcelAdmin','uses'=>'SurveyController@downloadCsv']);
    Route::match(['get','post'],'survey/lookForParticipant',['as'=>'lookForParticipant','uses'=> 'SurveyController@lookForParticipant']);
    Route::get('usergroup/edit/{id}','UserGroupController@editUserGroup');
    Route::post('usergroup/update','UserGroupController@updateUserGroup');
	Route::resource('usergroup','UserGroupController');

});

//Basic Route
Route::group(['middleware'=>'basic',
                'namespace'=>'basic',
                'prefix'=>'basic'],function(){
    Route::get('/','DashboardController@index');
    Route::resource('profile','ProfileController@index');
    Route::resource('survey','SurveyController');
    Route::resource('usergroup','UserGroupController');

    });

//special route
Route::group(['middleware'=>'special',
               'namespace'=>'special',
               'prefix'=>'special'],function(){
    Route::get('/','DashboardController@index');
    Route::get('profile','ProfileController@index');
    Route::resource('survey','CompanySurveyController');

    Route::get('groupsurvey/getParticipant/{surveyId}/{groupId}/{participantId}','GroupSurveyController@getParticipant');
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
