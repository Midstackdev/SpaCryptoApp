<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Http\Resources\PrivateUserResource;
use App\Mail\Account\PasswordUpdated;
use App\Models\ConfirmationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordResetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['confirmation_token.expire']);
    }

    public function reset(ConfirmationToken $token, PasswordResetRequest $request)
    {
    	$token->user->update([
    		'password' => bcrypt($request->password)
    	]);

    	$token->delete();

    	$user = Auth::loginUsingId($token->user->id);

    	if ($user->hasNotActivated()) {
            Auth::logout();

            return response()->json([
                'data'=> [
                    'error' => 'Please activate your account.',
                ]
            ], 403);
        }

    	$token = auth('api')->login($user);

    	Mail::to($user)->send(new PasswordUpdated());

    	return (new PrivateUserResource(auth()->user()))->additional([
            'meta'=> [
            	'token' => $token,
                'success' => 'Password reset successful.',
            ]
        ], 200);
    }
}
