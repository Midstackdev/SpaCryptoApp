<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\PasswordStoreRequest;
use App\Http\Resources\PrivateUserResource;
use App\Mail\Account\PasswordUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function store(PasswordStoreRequest $request)
    {
    	$request->user()->update([
    		'password' => bcrypt($request->password)
    	]);

        Mail::to($request->user())->send(new PasswordUpdated());

    	return (new PrivateUserResource(auth()->user()))->additional([
    		'meta' => [
    			'staus' => 200,
    			'success' => 'Password updated successfully'
    		]
    	]);
    }
}
