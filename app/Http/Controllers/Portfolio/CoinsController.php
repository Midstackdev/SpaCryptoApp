<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoinResource;
use App\Models\Coin;
use Illuminate\Http\Request;

class CoinsController extends Controller
{
    public function index()
    {
    	return CoinResource::collection(Coin::get());
    }
}
