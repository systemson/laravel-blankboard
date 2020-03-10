<?php

namespace Systemson\Blankboard\App\Models;

use App\User as ParentUser;
use Illuminate\Support\Facades\Route;

class User extends ParentUser
{
    const BASE_ROUTE_NAME = 'admin.users';

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
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'actions',
    ];

    public function isEditable()
    {
        return Route::has(static::EDIT_ROUTE_NAME) && Route::has(static::UPDATE_ROUTE_NAME);
    }

    private function isCreatable()
    {
        return Route::has(static::CREATE_ROUTE_NAME) && Route::has(static::STORE_ROUTE_NAME);
    }

    public function getActionsAttribute()
    {
        if ($this->isEditable()) {
            $actions[] = '<a href="' .  route(static::EDIT_ROUTE_NAME, $this->{$this->getKeyName()}) . '" class="btn btn-xs btn-primary"> <i class="far fa-edit"></i></a>';
        }

        if ($this->isCreatable()) {
            $actions[] = '<a href="' . route(static::DELETE_ROUTE_NAME, $this->{$this->getKeyName()})  . '" class="btn btn-xs btn-danger"> <i class="fas fa-trash"></i></a>';
        }

        return implode(' ', $actions ?? []);
    }
}
