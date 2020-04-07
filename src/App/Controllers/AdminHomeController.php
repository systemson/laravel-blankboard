<?php

namespace Systemson\Blankboard\App\Controllers;

use App\Http\Controllers\Controller;

/**
 * 
 */
class AdminHomeController extends Controller
{
	public function index()
	{
		return view('blankboard::admin.home');
	}
}