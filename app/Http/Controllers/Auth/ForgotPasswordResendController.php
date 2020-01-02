<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserRequestedPasswordResetEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ActivateResendRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordResendController extends Controller
{
    public function store(ActivateResendRequest $request)
    {
    	$user = User::where('email', $request->email)->first();

    	if (optional($user)->hasNotActivated()) {
    		event(new UserRequestedPasswordResetEmail($user));
    	}

    	return response()->json([
            'data'=> [
                'success' => 'Please check your email for a password reset link',
            ]
        ], 200);
    }
}
