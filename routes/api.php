<?php

Route::group(['namespace' => 'Auth'], function() {

	Route::post('/register', 'SignUpController@register');
	Route::post('/login', 'SignInController@login');
	Route::get('/me', 'MeController@me');
	Route::post('/logout', 'SignOutController@logout');

});

Route::get('/timeline', 'TimelineController@index');