<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserRequestedActivationEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ActivateResendRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ActivationResendController extends Controller
{
    public function store(ActivateResendRequest $request)
    {
    	$user = User::where('email', $request->email)->first();

    	if (optional($user)->hasNotActivated()) {
    		event(new UserRequestedActivationEmail($user));
    	}

    	return response()->json([
            'data'=> [
                'success' => 'Please check your email for an activation link',
            ]
        ], 200);
    }
}
