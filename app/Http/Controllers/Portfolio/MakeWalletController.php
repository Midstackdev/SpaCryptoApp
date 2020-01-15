<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\SendCoinRequest;
use App\Http\Requests\Portfolio\WalletStoreRequest;
use App\Http\Resources\PrivateUserResource;
use App\Models\Wallet;
use App\Service\Bitgo\BitgoService;
use Illuminate\Http\Request;

class MakeWalletController extends Controller
{
	protected $label = 'wallet';
	protected $passphrase = 'longpassphrase';

    public function store(WalletStoreRequest $request, BitgoService $bitgo)
    {
    	$user = $request->user();
    	$wallet = $user->wallets()->create([
    		'label' => $request->label,
    		'passphrase' => $request->passphrase,
    		'coin' => $request->coin,
    	]);

    	$walletId = $wallet->id;
    	if ($response = $bitgo->createWallet($request, $wallet)) {
    		$wallet->update([
    			'wallet_id' => $response->id
    		]);
    	}

    	return (new PrivateUserResource($user))->additional([
    		'meta' => [
    			'status' => 200,
    			'success' => 'wallet added successfully.'
    		]
    	]);
    }

    public function getWallets(Request $request, BitgoService $bitgo)
    {
    	$response = $bitgo->listWallets($request->user());
    	dd($response->wallets);
    }

    public function getAWallet(Request $request, BitgoService $bitgo, Wallet $wallet)
    {
    	$user = $request->user();
    	if ($response = $bitgo->getWallet($request, $wallet)){
    		$balance = $response->confirmedBalance;
    		$address = $response->receiveAddress->address;
    		$coin = $response->receiveAddress->coin;
    	}

    	return (new PrivateUserResource($user))->additional([
    		'meta' => [
    			'status' => 200,
    			'wallet' => [
    				'balance' => $balance,
	    			'address' => $address,
	    			'coin' => $coin,
    			],
    		]
    	]);
    }

    public function makeAddress(Request $request, BitgoService $bitgo)
    {
    	$response = $bitgo->createWalletAddress($request->user());
    	dd($response);
    }

    public function transactions(Request $request, BitgoService $bitgo, Wallet $wallet)
    {
    	$user = $request->user();
    	if ($response = $bitgo->allTransactions($request, $wallet)) {
    		$transfers = $response->transfers;
    	}

    	return (new PrivateUserResource($user))->additional([
    		'meta' => [
    			'status' => 200,
    			'transfers' => $transfers,
    		]
    	]);
    }

    public function unlock(Request $request, BitgoService $bitgo, Wallet $wallet)
    {
    	$user = $request->user();
    	$response = $bitgo->unlock();
    	// dd($response->session->client);
    }

    public function send(SendCoinRequest $request, BitgoService $bitgo, Wallet $wallet)
    {
    	$user = $request->user();
    	if ($response = $bitgo->sendMoney($request, $wallet)) {
    		$transfer = $response->transfer;
    	}

    	return (new PrivateUserResource($user))->additional([
    		'meta' => [
    			'status' => 200,
    			'transfer' => $transfer,
    			'success' => 'tranfer was successfully.'
    		]
    	]);
    }
}
