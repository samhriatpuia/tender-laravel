<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/','IndexController');

Auth::routes();

Route::get('/home', 'IndexController@index')->name('home');
 Route::resource('tests', 'TestController');

Route::resource('/addtender', 'AddTenderController');

//Route::get('/addtender', 'AddTenderController@index');


Route::get('index/filterByAllCombination', 'IndexController@filterByAllCombination')->name('index.filterByAllCombination');
Route::get('index/download','IndexController@download')->name('index.download');
Route::resource('index/','IndexController');



//Route::resource('/indextest','IndexTestController');


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('indexedit/filterByAllCombination', 'TenderEdit@filterByAllCombination')->name('indexedit.filterByAllCombination');
Route::resource('indexedit','TenderEdit');

//User define controller

//Route::post('/temp/departmentFilter', 'tpController@departmentFilter')->name('temp.departmentFilter');
Route::resource('/temp', 'tpController');

Route::get('/register', 'Auth\RegisterController@index')->name('register');
Route::post('/register', 'Auth\RegisterController@create')->name('registerC');

Route::get('/indextest/filterByDate', 'IndexTestController@filterByDate')->name('indextest.filterByDate');
Route::get('/indextest/filters', 'IndexTestController@filters')->name('indextest.filters');
Route::resource('/indextest','IndexTestController');

Route::resource('/subscribe','SubscribeController');
Route::post('/subscribe/otp', 'SubscribeController@otp')->name('subscribe.otp');
Route::post('/subscribe/otpVerify', 'SubscribeController@otpVerify')->name('subscribe.otpVerify');

Route::get('/changePass', 'Auth\ResetPasswordController@index')->name('reset');
Route::post('/changePass', 'Auth\ResetPasswordController@reset')->name('reset1');

Route::resource('/userList', 'UserController');
Route::put('/userList{userList}', 'UserController@update')->name('userList.update');
Route::delete('/userList{userList}', 'UserController@destroy')->name('userList.destroy');
Route::get('/userList', 'UserController@index')->name('userList');

Route::put('/userList{userList}', 'UserController@changePassword')->name('userList.changePassword');


Route::get('/departmentList', 'TenderDepartmentController@index')->name('listDepartment');
Route::get('/addnewDept', 'TenderDepartmentController@register')->name('addnewDept');
Route::post('/create', 'TenderDepartmentController@create')->name('create');
Route::delete('/deptList{deptList}', 'TenderDepartmentController@destroy')->name('deptList.destroy');
Route::put('/deptList{deptList}', 'TenderDepartmentController@update')->name('deptList.update');


Route::get('/downloadcount{id}', 'IndexController@downloadcount')->name('downloadcount');

//Route::get('test', 'IndexTestController@test');
//Route::resource('test', 'IndexTestController')->name('test');
