<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Resources\PrivateUserResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
    	return response()->json('sweet alert', 200);
    }

    public function store(ProfileStoreRequest $request)
    {
    	$request->user()->update($request->only('name', 'email'));

    	return (new PrivateUserResource(auth()->user()))->additional([
    		'meta' => [
    			'staus' => 200,
    			'success' => 'Profile updated successfully'
    		]
    	]);
    }
}
