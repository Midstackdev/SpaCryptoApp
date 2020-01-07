<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use App\Http\Resources\PrivateUserResource;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class SignInController extends Controller
{
	use AuthenticatesUsers;

    protected $auth;

    public function __construct(JWTAuth $auth)
    {
    	$this->auth = $auth;
    }

    public function login(LoginFormRequest $request)
    {
    	try {
    		if (!$token = $this->auth->attempt($request->only('email', 'password'))) {
    			return response()->json([
    				'errors' => [
    					'root' => 'Could not sign you in with those credentials.'
    				]
    			], 401);
    		}
    		
    	} catch (JWTException $e) {
    		return response()->json([
    			'errors' => [
    				'root' => 'Failed.'
    			]
    		], $e->getStatusCode());
    	}

    	// check if is active
        return $this->authenticated($request, $this->guard()->user())
                ?: 
    	(new PrivateUserResource($request->user()))->additional([
    		'meta' => [
    			'token' => $token
    		]
    	]);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasNotActivated()) {
            $this->guard()->logout();

            return response()->json([
                'data' => [
                    'error' => 'Your account is not active.'
                ],
            ],403);
        }

        if ($user->twoFactorEnabled()) {
            // return $this->startTwoFactorAuthentication($request, $user);
        }
    }

    protected function startTwoFactorAuthentication(Request $request, $user)
    {
        session()->put('twofactor', (object) [
            'user_id' => $user->id,
            'remember' => $request->has('remember')
        ]);

        $this->guard()->logout();

        return response()->json([
            'data' => [
                'error' => 'Enter your sms token to login.'
            ],
        ],307);
    }
}
