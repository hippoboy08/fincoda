<?php



Route::get('/', function () {
    return view('home');
});
Route::get('login', function () {
    return view('login');
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
    Route::get('company/update','ProfileController@editcompany');
    Route::post('company/update','ProfileController@updatecompany');

    Route::resource('members','MembersController');
    Route::resource('roles','RolesController');
    Route::post('getParticipantDetails','SurveyController@getParticipantDetails');
    Route::resource('survey','SurveyController');
    Route::resource('usergroup','UserGroupController');

});

//Basic Route
Route::group(['middleware'=>'basic',
                'namespace'=>'basic',
                'prefix'=>'basic'],function(){
    Route::get('/','DashboardController@index');
    Route::resource('profile','ProfileController');
    Route::resource('survey','SurveyController');
    Route::resource('usergroup','UserGroupController');

    });

//special route
Route::group(['middleware'=>'special',
               'namespace'=>'special',
               'prefix'=>'special'],function(){
    Route::get('/','DashboardController@index');
    Route::resource('profile','ProfileController');
    Route::resource('survey','CompanySurveyController');
    Route::resource('usergroup','UserGroupController');
    Route::resource('groupsurvey','GroupSurveyController');
    Route::get('groupsurveyresult','GroupSurveyResultController@index');

});
