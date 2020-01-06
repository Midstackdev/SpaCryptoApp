<?php

namespace App\TwoFactor;

use App\Models\User;


interface TwoFactor 
{
	public function registerUser(User $user);

	public function verifyToken($token, User $user = null);

	public function requestSms(User $user);

	public function deleteUser(User $user);
}