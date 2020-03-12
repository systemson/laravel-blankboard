<?php

namespace Systemson\Blankboard\App\Models;

use Illuminate\Database\Eloquent\Model as LaravelModel;
use Illuminate\Support\Facades\Route;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Http\Request;
use Form;
use Illuminate\Support\Facades\Validator;

abstract class Model extends LaravelModel
{
	use FormAccessible;

    /**
     * The attributes that should be shown in lists.
     *
     * @var array
     */
    protected $listable = [];

    /**
     * The attributes validations rules.
     *
     * @var array
     */
    protected $validations = [];

    public static function boot()
    {
        parent::boot();

        self::creating(function(LaravelModel $model){
            $model->validate();
        });

        self::updating(function(LaravelModel $model){
            $model->validate();
        });
    }

    private function isCreatable()
    {
        return Route::has(static::CREATE_ROUTE_NAME) && Route::has(static::STORE_ROUTE_NAME);
    }

    private function isShowable()
    {
        return Route::has(static::SHOW_ROUTE_NAME);
    }

    public function isEditable()
    {
        return Route::has(static::EDIT_ROUTE_NAME) && Route::has(static::UPDATE_ROUTE_NAME);
    }

    public function isDeletable()
    {
        return Route::has(static::DELETE_ROUTE_NAME);
    }

    public function getActionsAttribute()
    {
        if ($this->isShowable()) {
            $actions[] = '<a href="' .  route(static::SHOW_ROUTE_NAME, $this->{$this->getKeyName()}) . '" class="btn btn-xs btn-info"> <i class="far fa-eye"></i></a>';
        }

        if ($this->isEditable()) {
            $actions[] = '<a href="' .  route(static::EDIT_ROUTE_NAME, $this->{$this->getKeyName()}) . '" class="btn btn-xs btn-primary"> <i class="far fa-edit"></i></a>';
        }

        if ($this->isDeletable()) {
            $actions[] = '<a class="btn btn-xs btn-danger"  href="#" onclick="event.preventDefault();document.getElementById(\'delete-form-' . $this->getKey() .'\').submit();"><i class="fas fa-trash"></i>' . Form::open(['route' => [static::DELETE_ROUTE_NAME, $this->getKey()], 'method' => 'DELETE', 'id' => 'delete-form-' . $this->getKey()]) . '</form></a>';
        }

        return implode(' ', $actions ?? []);
    }

    public function validate()
    {
    	if (empty($this->getValidations())) {
    		return true;
    	}

        Validator::make(
            $this->getAttributes(),
            $this->getValidations()
        )->validate();

        return true;
    }

    public function getValidations()
    {
        if (empty($this->validations) || !$this->exists) {
            return $this->validations;
        }

        return array_map(function ($rule) {
            if (\Str::contains($rule, ['unique'])) {
                preg_match("/(?<=unique:)(.*?)(?=\|)/", $rule, $match);
                $search = end($match);

                $id = $this->{$this->primaryKey};

                $replace = "{$search},{$id},{$this->primaryKey}";

                $rule = str_replace($search, $replace, $rule);
            }

            return $rule;
        }, $this->validations);
    }

    public function getListable(): array
    {
        return array_merge([$this->getKeyName()], $this->listable);
    }

    public function getSelectable(): array
    {
        return $this->listable ?? '*';
    }

    public function getStatusAttribute($value)
    {
        if (!in_array('status', $this->listable)) {
            return;
        }

        if ($value === 1) {
            return __('messages.active');
        }

        if ($value === 0) {
            return __('messages.inactive');
        }


        return $value;
    }

    public function formStatusAttribute($value)
    {
        return $value;
    }
}