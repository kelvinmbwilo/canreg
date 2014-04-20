<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', function () {
    return View::make('login');
}));

Route::get('home', function()
{
    return View::make('home');
});


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Managing user actions
 * Directing routes to correct controllers
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//validating user during login
Route::post('login',array('as'=>'login', 'uses'=>'UserController@validate'));

//logging a user out
Route::get('logout',array('as'=>'logout', 'uses'=>'UserController@logout'));

//display a form to add new user
Route::get('user/add',array('as'=>'adduser', 'uses'=>'UserController@create'));

//display a list of users
Route::get('user/list',array('uses'=>'UserController@userlist'));

//adding new user
Route::post('user/add',array('as'=>'adduser1', 'uses'=>'UserController@store'));

//viewing list of users
Route::get('users',array('as'=>'listuser', 'uses'=>'UserController@index'));

//display a form to edit users information
Route::get('user/edit/{id}',array('as'=>'edituser', 'uses'=>'UserController@edit'));

//editng users information
Route::post('user/edit/{id}',array('as'=>'edituser', 'uses'=>'UserController@update'));

//deleting user
Route::post('user/delete/{id}',array('as'=>'deleteuser', 'uses'=>'UserController@destroy'));

//display a system usage log for a user
Route::get('user/log/{id}',array('as'=>'userlog', 'uses'=>'UserController@show'));

/**
 * Patient Registration
 * using PatientController
 */
//display a form to add basic details for patient
Route::get('patients',array('uses'=>'PatientController@index'));

//display a patient details
Route::get('patients/{id}',array('uses'=>'PatientController@show'));

//display a form to edit a patient
Route::get('patient/edit/{id}',array('uses'=>'PatientController@edit'));

// edit a patient
Route::post('patient/edit/{id}',array('uses'=>'PatientController@update'));

//display a form to add basic details for patient
Route::get('patient/register',array('uses'=>'PatientController@create'));

//display a form to add basic details for patient
Route::post('patient/register/basic',array('uses'=>'PatientController@store'));

//check for a regions district...
Route::post('patient/region_check/{id}',array('uses'=>'PatientController@check_region'));

//delete a patient
Route::post('patient/delete/{id}',array('uses'=>'PatientController@destroy'));

/////////////////////////////////////////////////////////////
//////////Tumor Information//////////////////////////////////
////////////////////////////////////////////////////////////
//display a form to add new tumor
Route::get('patient/register/tumor/{id}',array('uses'=>'TumorController@create'));

//display a form to add new tumor
Route::get('patient/add/tumor/{id}',array('uses'=>'TumorController@create1'));

//display a form to add new tumor
Route::post('patient/register/tumor/{id}',array('uses'=>'TumorController@store'));

//display a form to add new tumor
Route::post('patient/register/tumor1/{id}',array('uses'=>'TumorController@store1'));

//deleting a tumor
Route::post('tumor/delete/{id}',array('uses'=>'TumorController@destroy'));


/////////////////////////////////////////////////////////////
//////////Examination Information//////////////////////////////////
////////////////////////////////////////////////////////////
//display a form to add new examination
Route::get('patient/register/exam/{id}',array('uses'=>'ExaminationController@create'));

//display a form to add new examination
Route::get('patient/add/exam/{id}',array('uses'=>'ExaminationController@create1'));


//display a form to add new Examination
Route::post('patient/register/exam/{id}',array('uses'=>'ExaminationController@store'));

//display a form to add Examination details
Route::post('patient/register/exam1/{id}',array('uses'=>'ExaminationController@store1'));

//deleting a Examination Details
Route::post('exam/delete/{id}',array('uses'=>'ExaminationController@destroy'));

//display a form to add new examination
Route::get('patient/add/followup/{id}',array('uses'=>'PatientController@createFollowup'));

//display a form to add new examination
Route::post('patient/add/folowup/{id}',array('uses'=>'PatientController@storeFollowup'));

/**
 * Reports Generation
 * using ReportController
 */
//viewing report generation page
Route::get('reports',array('uses'=>'ReportController@create'));

//viewing report generation page
Route::get('reports/saved',array('uses'=>'ReportController@index'));

//Saving A Save
Route::post('report/save',array('uses'=>'ReportController@store'));

//displaying table chart
Route::post('report/table',array('uses'=>'ReportController@makeTable'));

//displaying bar chart
Route::post('report/bar',array('uses'=>'ReportController@makeBar'));

//displaying line chart
Route::post('report/line',array('uses'=>'ReportController@makeLine'));

//displaying pie chart
Route::post('report/pie',array('uses'=>'ReportController@makePie'));

//get a jason value of data
Route::post('getjason/{id}',array('uses'=>'ReportController@show'));


/**
 * Dashboard Settings
 * Using DashboardController
 */
//viewing The index Page
Route::get('settings/dashboard',array('uses'=>'DashboardController@index'));

//Changing The Title
Route::post('dashboard/title',array('uses'=>'DashboardController@setTitle'));

//Changing The Title
Route::post('dashboard/welcome_note',array('uses'=>'DashboardController@setWelcome'));

//Changing The Title
Route::post('dashboard/chat',array('uses'=>'DashboardController@setChat'));
