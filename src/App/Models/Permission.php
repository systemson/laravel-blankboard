<?php

namespace Systemson\Blankboard\App\Models;

class Permission extends Model
{
    const BASE_ROUTE_NAME = 'admin.permissions';

    const CREATE_ROUTE_NAME   = self::BASE_ROUTE_NAME . '.create';
    const STORE_ROUTE_NAME    = self::BASE_ROUTE_NAME . '.store';
    const SHOW_ROUTE_NAME     = self::BASE_ROUTE_NAME . '.show';
    const EDIT_ROUTE_NAME     = self::BASE_ROUTE_NAME . '.edit';
    const UPDATE_ROUTE_NAME   = self::BASE_ROUTE_NAME . '.update';
    const DELETE_ROUTE_NAME   = self::BASE_ROUTE_NAME . '.destroy';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'status',
    ];

    /**
     * The attributes that should be shown in lists.
     *
     * @var array
     */
    protected $listable = [
        'name',
        'description',
        'status',
    ];

    /**
     * The attributes validations rules.
     *
     * @var array
     */
    protected $validations = [
        'name' => 'required',
        'description' => 'nullable',
        'status' => 'required',
    ];
}
