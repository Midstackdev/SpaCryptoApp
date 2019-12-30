<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
    	return response()->json('sweet alert', 200);
    }

    public function store()
    {
    	dd('sweet alert',);
    }
}
