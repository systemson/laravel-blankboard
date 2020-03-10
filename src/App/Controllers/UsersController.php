<?php

namespace Systemson\Blankboard\App\Controllers;

use App\Http\Controllers\Controller;
use Systemson\Blankboard\App\Models\User as Model;
use Illuminate\Support\Facades\Route;



/**
 * 
 */
class UsersController extends Controller
{
    public function index()
    {
        ForwardsCalls::class;
        $resources = Model::paginate();

        $resources->headers = [
            'id',
            'name',
            'email',
            'actions',
        ];

        if (Route::has(Model::CREATE_ROUTE_NAME)) {
            $resources->create = '<a class="btn btn-success" href="' . route(Model::CREATE_ROUTE_NAME) . '">New</a>';
        }

        return view('blankboard::admin.list')
            ->with('resources', $resources)
        ;
    }

    public function create()
    {
        return view('blankboard::admin.form')
        ;
    }
}