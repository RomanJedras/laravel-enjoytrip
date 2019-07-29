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

Route::get('/', 'FrontendController@index')->name('home'); 

Route::get(trans('routes.object').'/{id}','FrontendController@object')->name('object'); 
Route::post(trans('routes.roomsearch'),'FrontendController@roomsearch')->name('roomSearch');
Route::get(trans('routes.room').'/{id}','FrontendController@room')->name('room'); 
Route::get(trans('routes.article').'/{id}','FrontendController@article')->name('article'); 
Route::get(trans('routes.person').'/{id}','FrontendController@person')->name('person'); 
 
Route::get('/searchCities', 'FrontendController@searchCities');
Route::get('/ajaxGetRoomReservations/{id}', 'FrontendController@ajaxGetRoomReservations');
Route::get('/like/{likeable_id}/{type}', 'FrontendController@like')->name('like');
Route::get('/unlike/{likeable_id}/{type}', 'FrontendController@unlike')->name('unlike');

Route::post('/addComment/{commentable_id}/{type}', 'FrontendController@addComment')->name('addComment');

Route::post('/makeReservation/{room_id}/{city_id}', 'FrontendController@makeReservation')->name('makeReservation');

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){ 
    
  Route::get('/','BackendController@index')->name('adminHome'); 
  Route::get(trans('routes.myobjects'),'BackendController@myobjects')->name('myObjects');
  Route::get(trans('routes.saveobject'),'BackendController@saveObject')->name('saveObject'); 
  Route::get(trans('routes.profile'),'BackendController@profile')->name('profile'); 
  Route::get(trans('routes.saveroom'),'BackendController@saveRoom')->name('saveRoom');  
  Route::get('/cities','BackendController@cities')->name('cities.index');   

  Route::get('/ajaxGetReservationData', 'BackendController@ajaxGetReservationData');
   Route::get('/confirmReservation/{id}', 'BackendController@confirmReservation')->name('confirmReservation');
  Route::get('/deleteReservation/{id}', 'BackendController@deleteReservation')->name('deleteReservation'); 
 }); 



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
