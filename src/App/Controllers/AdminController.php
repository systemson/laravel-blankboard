<?php

namespace Systemson\Blankboard\App\Controllers;

use App\Http\Controllers\Controller;

/**
 *
 */
class AdminController extends Controller
{
    public function index()
    {
        return view('blankboard::admin.home');
    }
}
