<?php

namespace Systemson\Blankboard\App\Models;

use Illuminate\Database\Eloquent\Model as LaravelModel;
use Illuminate\Support\Facades\Route;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Http\Request;
use Form;
use Systemson\ModelValidations\ValidationsTrait;

abstract class Model extends LaravelModel
{
	use FormAccessible, ValidationsTrait;

    /**
     * The attributes that should be shown in lists.
     *
     * @var array
     */
    protected $listable = [];
/*
    private function isCreatable()
    {
        return $this->hasAction('create');
    }

    private function isShowable()
    {
        dd($this->hasAction('create'));
        return $this->hasAction('read');
    }

    public function isEditable()
    {
        return $this->hasAction('update');
    }

    public function isDeletable()
    {
        return $this->hasAction('delete');
    }

    public function getActionsAttribute()
    {
        if ($this->isShowable()) {
            $actions[] = '<a href="' .
                route(static::SHOW_ROUTE_NAME, $this->{$this->getKeyName()}) .
                '" class="btn btn-xs btn-info"> <i class="far fa-eye"></i></a>'
            ;
        }

        if ($this->isEditable()) {
            $actions[] = '<a href="' .
            route(static::EDIT_ROUTE_NAME, $this->{$this->getKeyName()}) .
            '" class="btn btn-xs btn-primary"> <i class="far fa-edit"></i></a>'
            ;
        }

        if ($this->isDeletable()) {
            $actions[] = '<a class="btn btn-xs btn-danger"  href="#" onclick="event.preventDefault();document.getElementById(\'delete-form-' .
                $this->getKey() .
                '\').submit();"><i class="fas fa-trash"></i>' .
                Form::open([
                    'route' => [
                        static::DELETE_ROUTE_NAME,
                        $this->getKey()
                    ],
                    'method' => 'DELETE',
                    'id' => 'delete-form-' . $this->getKey()
                ]) . '</form></a>';
        }

        return implode(' ', $actions ?? []);
    }

    public function hasAction($action): bool
    {
        dd($this->actions, $action);
        return in_array($action, $this->actions);
    }
*/

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