<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class SignOutController extends Controller
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
    	$this->auth = $auth;
    }

    public function logout()
    {
    	$this->auth->invalidate($this->auth->getToken());

    	return response(null, 200);
    }
}
