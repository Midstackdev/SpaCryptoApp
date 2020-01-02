<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function index()
    {
    	$countries = Country::get();

    	return CountryResource::collection($countries);
    }

    public function store()
    {
    	dd('all');
    }
}
