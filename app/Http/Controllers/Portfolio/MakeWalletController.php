<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Service\Bitgo\BitgoService;
use Illuminate\Http\Request;

class MakeWalletController extends Controller
{
    public function store(Request $request, BitgoService $bitgo)
    {
    	$user = $request->user();
    	$response = $bitgo->createWallet($request->user());
    	dd($response);
    }

    public function getWallets(Request $request, BitgoService $bitgo)
    {
    	$response = $bitgo->listWallets($request->user());
    	dd($response->wallets);
    }

    public function makeAddress(Request $request, BitgoService $bitgo)
    {
    	$response = $bitgo->createWalletAddress($request->user());
    	dd($response);
    }

    public function transactions(Request $request, BitgoService $bitgo)
    {
    	$response = $bitgo->allTransactions($request->user());
    	dd($response);
    }

    public function send(Request $request, BitgoService $bitgo)
    {
    	$response = $bitgo->sendMoney($request->user());
    	dd($response);
    }
}
