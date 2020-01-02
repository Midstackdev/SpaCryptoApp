<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\DeactivateAccountRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeactivateController extends Controller
{
    public function store(DeactivateAccountRequest $request)
    {
    	$request->user()->delete();

    	// Auth::logout();

    	//send mail

    	return response()->json([
            'meta'=> [
                'success' => 'Your account has been deactivated.',
            ]
        ], 202);
    }
}
