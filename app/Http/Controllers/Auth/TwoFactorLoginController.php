<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactor\TwoFactorVerifyRequest;
use Illuminate\Http\Request;

class TwoFactorLoginController extends Controller
{
    public function verify(TwoFactorVerifyRequest $request)
    {
    	dd('all');
    }
}
