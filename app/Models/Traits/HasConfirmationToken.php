<?php

namespace App\Models\Traits;

use App\Models\ConfirmationToken;
use Illuminate\Support\Str;


trait HasConfirmationToken
{
	public function generateConfirmationToken()
	{
		$this->confirmationToken()->create([
			'token' => $token = Str::random(200),
			'expires_at' => $this->getConfrimationTokenExpiry()
		]);

		return $token;
	}

	protected function getConfrimationTokenExpiry()
	{
		return $this->freshTimestamp()->addMinutes(10);
	}

	public function confirmationToken()
	{
		return $this->hasOne(ConfirmationToken::class);
	}

}