<?php

Route::group(['namespace' => 'Auth'], function() {

	Route::post('/register', 'SignUpController@register');
	Route::post('/login', 'SignInController@login');
	Route::get('/me', 'MeController@me');
	Route::post('/logout', 'SignOutController@logout');

});

Route::get('/timeline', 'TimelineController@index');

/**
 * Account
 */
Route::group(['prefix' => 'account', 'middleware' => ['auth']], function() {
	Route::get('/', 'Account\AccountController@index');

	/**
	 * Profile
	 */
	Route::get('profile', 'Account\ProfileController@index');
	Route::post('profile', 'Account\ProfileController@store');
});