<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimelineController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth:api']);
	}
	
    public function index()
    {
    	return response()->json([
    		'data' => 'Timeline index'
    	], 200);
    }
}
