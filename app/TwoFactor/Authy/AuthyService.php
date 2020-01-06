<?php

namespace App\TwoFactor\Authy;

use App\Models\User;
use App\TwoFactor\Authy\Exceptions\{RegistrationFailedException, InvalidTokenException, SmsRequestFailedException, DeleteRequestFailedException};
use App\TwoFactor\TwoFactor;
use Authy\AuthyApi;
use Authy\AuthyFormatException;

class AuthyService implements TwoFactor
{
	private $client;

	public function __construct(AuthyApi $client)
	{
		$this->client = $client;
	}

	public function registerUser(User $user)
	{
		$user = $this->client->registerUser(
			$user->email,
			$user->twoFactor->phone,
			$user->twoFactor->dial_code
		);

		if (!$user->ok()) {
			throw new RegistrationFailedException;
		}

		return $user->id();
	}

	public function verifyToken($token, User $user = null)
	{
		try {
			
			$verification = $this->client->verifyToken(
				$user ? $user->twoFactor->identifier : request()->session()->get('authy.authy_id'),
				$token
			);
		} catch (AuthyFormatException $e) {
			throw new InvalidTokenException;
		}

		if (!$verification->ok()) {
			throw new InvalidTokenException;
		}

		return true;
	}

	public function requestSms(User $user, $identifier = null)
	{
		$sms = $this->client->requestSms(($user->twoFactor->identifier ?? $identifier), [
			'force' => true,
		]);

		if (!$sms->ok()) {
			throw new SmsRequestFailedException;
		}
	}

	public function deleteUser(User $user)
	{
		$deleted = $this->client->deleteUser($user->twoFactor->identifier);

		if (!$deleted->ok()) {
			throw new DeleteRequestFailedException;
		}

		return true;
	}
}