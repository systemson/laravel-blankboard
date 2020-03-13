<?php

namespace Systemson\Blankboard\App\Controllers;

use Illuminate\Http\Request;
use Systemson\Blankboard\App\Crud\Listing;
use Systemson\Blankboard\App\Crud\Form;

/**
 *
 */
trait ResourceCrud
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $table = Listing::get(
            new $this->modelClass,
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
            ->with('form', new Form(new $this->modelClass, $this->baseRoute))
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
        $model =  new  $this->modelClass;

        $input = $request->only($model->getFillable());

        $model->fill($input);

        $model->save();

        return redirect()->route($this->baseRoute . '.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
            ->with('form', new Form($this->modelClass::findOrFail($id), $this->baseRoute))
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
        $model =  $this->modelClass::findOrFail($id);

        $input = $request->only($model->getFillable());

        $model->fill($input);

        $model->save();

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
        $this->modelClass::findOrFail($id)->delete();

        return redirect()->back();
    }
}
