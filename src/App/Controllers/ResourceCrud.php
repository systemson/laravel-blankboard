<?php

namespace Systemson\Blankboard\App\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class ResourceCrud
{
    public function new(string $class, Request $request)
    {
    	$resource =  new $class;

    	$input = $request->only($resource->getFillable());

    	$resource->fill($this->alterInput($input));

    	if ($resource->validate($request)) {
    		$resource->save();
    	} else {
    		return abort(422);
    	}

    	return $resource;
    }

    public function alterInput(array $input): array
    {
    	return $input;
    }

    public function edit(Model $resource, Request $request)
    {
    	$input = $request->only($resource->getFillable());

    	$resource->fill($this->alterInput($input));

    	if ($resource->validate($request)) {
    		$resource->save();
    	} else {
    		return abort(422);
    	}

    	return $resource;
    }
}