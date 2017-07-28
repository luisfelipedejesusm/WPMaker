<?php

Route::get('/','HomeController@index');
Route::get('/preview','HomeController@preview');
Route::post('/save','HomeController@save');

Route::group(['prefix'=>'FirebaseTest'],function(){
	Route::post('loginAttempt','FirebaseTestController@loginAttempt');
	Route::post('register','FirebaseTestController@register');
});
