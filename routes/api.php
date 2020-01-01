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
Route::group(['prefix' => 'account', 'middleware' => ['auth:api']], function() {
	Route::get('/', 'Account\AccountController@index');

	/**
	 * Profile
	 */
	Route::get('profile', 'Account\ProfileController@index');
	Route::post('profile', 'Account\ProfileController@store');
	/**
	 * Password
	 */
	Route::post('password', 'Account\PasswordController@store');
});

/**
 * Activation
 */
Route::group(['prefix' => 'activation', 'middleware' => ['guest', 'confirmation_token.expire']], function() {
    Route::get('/{confirmation_token}', 'Auth\ActivationController@activate')->name('activation.activate');
});