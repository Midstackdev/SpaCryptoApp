<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserSignedUp;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class SignUpController extends Controller
{
	use RegistersUsers;

	protected $auth;

	public function __construct(JWTAuth $auth)
	{
		$this->auth = $auth;
	}

    Public function register(RegisterFormRequest $request)
    {
    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password),
    		'activated' => 0
    	]);

    	// verify email

    	// $token = $this->auth->attempt($request->only('email', 'password'));
        return $this->registered($request, $user)
                        ?: 
    	response()->json([
    		'data' => $user,
    		'meta'=> [
    			'token' => $token
    		]
    	], 200);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();

        event(new UserSignedUp($user));

        return response()->json([
            'meta'=> [
                'success' => 'Please check your email for an activation link',
            ]
        ], 200);
    }
}
