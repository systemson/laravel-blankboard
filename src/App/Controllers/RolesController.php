<?php

namespace Systemson\Blankboard\App\Controllers;

use App\Http\Controllers\Controller;
use Systemson\Blankboard\App\Models\Role as Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * 
 */
class RolesController extends Controller
{
    protected $handler;

    public function __construct(ResourceListing $handler)
    {
        $this->handler = $handler;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = $this->handler->list(Model::class, $request);

        $resources->headers = array_merge((new Model())->getListable(), ['actions']);

        if (Route::has(Model::CREATE_ROUTE_NAME)) {
            $resources->create = '<a class="btn btn-success" href="' . route(Model::CREATE_ROUTE_NAME) . '">New</a>';
        }

        return view('blankboard::admin.list')
            ->with('resources', $resources)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blankboard::admin.form')
            ->with('resource', new Model())
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->handler->new(Model::class, $request);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Model $role)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('blankboard::admin.form')
            ->with('resource', Model::findOrFail($id))
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->handler->edit(Model::findOrFail($id), $request);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Model::findOrFail($id)->delete();

        return redirect()->back();
    }
}