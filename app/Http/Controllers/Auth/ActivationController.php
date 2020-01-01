<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrivateUserResource;
use App\Models\ConfirmationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{

    public function activate(ConfirmationToken $token, Request $request)
    {
    	$token->user->update([
    		'activated' => 1
    	]);

    	$token->delete();

    	$user = Auth::loginUsingId($token->user->id);

    	$token = auth('api')->login($user);

    	return (new PrivateUserResource(auth()->user()))->additional([
            'meta'=> [
            	'token' => $token,
                'success' => 'Your account is activated.',
            ]
        ], 200);
    }
}
