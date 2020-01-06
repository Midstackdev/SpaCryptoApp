<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactor\{TwoFactorStoreRequest, TwoFactorVerifyRequest};
use App\Http\Resources\CountryResource;
use App\Http\Resources\PrivateUserResource;
use App\Models\Country;
use App\Models\User;
use App\TwoFactor\TwoFactor;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function index()
    {
    	$countries = Country::get();

    	return CountryResource::collection($countries);
    }

    public function store(TwoFactorStoreRequest $request, TwoFactor $twofactor)
    {
    	$user = $request->user();

    	$user->twoFactor()->create([
    		'phone' => $request->phone_number,
    		'dial_code' => $request->dial_code
    	]);


    	if ($response = $twofactor->registerUser($user)) {
    		$user->twoFactor()->update([
    			'identifier' => $response
    		]);
    	}

    	$twofactor->requestSms($user, $response);

    	return (new PrivateUserResource($user))->additional([
    		'meta' => [
    			'staus' => 200,
    			'success' => 'Please check your sms to verify.',
    		]
    	]);
    }

    public function verify(TwoFactorVerifyRequest $request)
    {
    	$user = $request->user();

    	$user->twoFactor()->update([
    		'verified' => 1
    	]);

    	return (new PrivateUserResource($user))->additional([
    		'meta' => [
    			'staus' => 200,
    			'success' => 'Your have enabled two factor login.',
    		]
    	]);
    }

    public function destroy(Request $request, TwoFactor $twofactor)
    {
    	$user = $request->user();

    	if ($twofactor->deleteUser($user)) {
    		$user->twoFactor()->delete();
    	}

    	return (new PrivateUserResource($user))->additional([
    		'meta' => [
    			'staus' => 200,
    			'success' => 'Your have disabled two factor login.',
    		]
    	]);
    }

    public function getResend(Request $request, TwoFactor $twofactor)
    {
    	$user = $request->user();

    	// if (!$user->twoFactorEnabled()) {
    	// 	return response()->json([
    	// 		'sms' => 'User not enabled'
    	// 	], 403);
    	// }

    	$twofactor->requestSms($user);

    	return (new PrivateUserResource($user))->additional([
    		'meta' => [
    			'staus' => 200,
    			'success' => 'Your have disabled two factor login.',
    		]
    	]);

    }
}
