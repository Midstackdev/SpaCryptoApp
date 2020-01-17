<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Bitgo\BitgoService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request, BitgoService $bitgo)
    {
    	$user = $request->user();
    	// $response = $bitgo->user();
    	$response = $bitgo->tranfers($request);
    	dd($response);
    }
}
