<?php

return [
	'links' => [
		'url' => env('FRONTEND_URL', 'http://localhost:8000'),
		'email_verify_url' => env('FRONTEND_EMAIL_VERIFY_URL', '/email-verified?queryURL='),
		'password_reset_url' => env('FRONTEND_EMAIL_VERIFY_URL', '/password-reset?queryURL='),
	],

];