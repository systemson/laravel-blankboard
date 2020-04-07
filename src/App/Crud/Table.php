<?php

namespace Systemson\Blankboard\App\Crud;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Lang;

/**
 *
 */
class Table
{
	protected $rows;

    protected $columns;

	public function __construct(array $columns, LengthAwarePaginator $rows = null, array $options = [])
	{
        $this->options = $options;

		$this->columns = $columns;
		$this->rows = $rows;
	}

    public function getTableHeaders()
    {
        foreach ($this->columns as $value) {

            $slug = 'table.' . $value;

            if (Lang::has($slug)) {
                $th[] = Lang::get($slug);
            } else {
                $th[] = $value;
            }
        }

        return $th;
    }

    public function getTableColumns()
    {
        return $this->columns;
    }

    public function getRows()
    {
        return $this->rows;
    }

	public function isCreateble(): bool
	{
		return isset($this->options['base_route']) && Route::has($this->options['base_route'] . '.create');
	}

    public function getOption($name)
    {
        return $this->options[$name] ?? null;
    }
    public function isCreatable()
    {
        return $this->hasAction('create');
    }

    public function getCreateUrl()
    {
        if (isset($this->options['base_route'])) {
            return route($this->options['base_route'] . '.create');
        }

        return;
    }

    public function isShowable()
    {
        return $this->hasAction('read');
    }

    public function getShowUrl()
    {
        if (isset($this->options['base_route'])) {
            return route($this->options['base_route'] . '.show');
        }

        return;
    }

    public function isEditable()
    {
        return $this->hasAction('update');
    }

    public function getEditUrl($item)
    {
        if (isset($this->options['base_route'])) {
            return route($this->options['base_route'] . '.edit', $item->getKey());
        }

        return;
    }

    public function isDeletable()
    {
        return $this->hasAction('delete');
    }

    public function getDeleteUrl($item)
    {
        if (isset($this->options['base_route'])) {
            return route($this->options['base_route'] . '.destroy', $item->getKey());
        }

        return;
    }

    public function hasAction($action): bool
    {
        if (is_null($actions = $this->getOption('actions'))) {
            return false;
        }

        return in_array($action, $this->getOption('actions'));
    }
}