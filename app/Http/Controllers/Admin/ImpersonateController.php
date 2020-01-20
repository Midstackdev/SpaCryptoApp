<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\{User, Wallet};
use Illuminate\Http\Request;

class ImpersonateController extends Controller
{
    public function index()
    {
    	$users = User::get();
    	$usersCount = $users->count();
    	$walletCount = Wallet::get()->count();

    	return (UserResource::collection($users))->additional([
    		'meta' => [
    			'status' => 200,
    			'stats' => [
    				'users_count' => $usersCount,
    				'wallet_count' => $walletCount,
    			]	
    		]
    	]);
    }

    public function getUser(User $user)
    {
    	// dd($user);
    	return (new UserResource($user))->additional([
    		'meta' => [
    			'status' => 200
    		],
    	]);
    }

    public function ipmersonate()
    {
    	return response()->json([
    		'data' => 'Admin index'
    	], 200);
    }
}
