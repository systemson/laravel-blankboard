<?php

namespace Systemson\Blankboard\App\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Listing
{
	protected $model;

	const PER_PAGE = 15;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

    public function getTable(Request $request, array $options = [])
    {
    	$listable = $this->model->getListable();

    	$select = empty($listable) ? '*' : $listable;

        $query = $this->model->newQuery()
        	->select($select)
        	->where($request->only($listable))
        ;

        if (!$request->has('order_by')) {
            $query->orderBy($this->model->getKeyName(), 'ASC');
        } elseif (
            ($order_by = $this->getOrderBy($request, $listable)) !== false &&
            $this->validateOrderBy($order_by, $listable)
        ) {
        	$query->orderBy($order_by->column, $order_by->sort);
        }

        $query_string = array_merge($listable, ['order_by', 'per_page']);

        $paginator = $query->paginate(
        	$request->get('per_page') ?? static::PER_PAGE
        )->appends($request->only($query_string));

        return new Table(
            $listable,
            $paginator,
            $options,
        );
    }

    private function getOrderBy(Request $request)
    {
    	$raw = $request->get('order_by');

		$array = explode(':', $raw);

		if (isset($array[1]) && in_array(strtoupper($array[1]), ['ASC', 'DESC'])) {
			$order = $array[1];
		} else {
			$order = 'ASC';
		}

		return (object) [
			'column' => $array[0],
			'sort' => $order,
		];
    }

    private function validateOrderBy($order_by, array $columns = [])
    {
    	if (!empty($columns)) {
    		return in_array($order_by->column, $columns);
    	}

    	false;
    }
}