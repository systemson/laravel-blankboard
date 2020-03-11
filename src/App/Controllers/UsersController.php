<?php

namespace Systemson\Blankboard\App\Controllers;

use App\Http\Controllers\Controller;
use Systemson\Blankboard\App\Models\User as Model;
USE Systemson\Blankboard\App\Crud\Listing;
use Illuminate\Http\Request;

/**
 * 
 */
class UsersController extends Controller
{
    protected $baseRoute = 'admin.users';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $table = Listing::get(
            new Model(),
            $request,
            [
                'base_route' => $this->baseRoute,
            ]
        );

        return view('blankboard::admin.list')
            ->with('table', $table)
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
    public function show(Model $user)
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