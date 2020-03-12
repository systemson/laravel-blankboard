<?php

namespace Systemson\Blankboard\App\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;


/**
 * @todo Should move LengthAwarePaginator functionality to a new class.
 * 		 And this class should just handle the queries.
 */
class Listing extends LengthAwarePaginator
{
	protected $model;

	const PER_PAGE = 15;

	public function __construct($items = [], int $total = 0, int $perPage = self::PER_PAGE, int $currentPage = null, array $options = [], Model $model = null)
	{
		parent::__construct($items, $total, $perPage, $currentPage, $options);

		$this->model = $model;
	}

	public function getTableHeaders()
	{
		return array_merge($this->model->getListable(), ['actions']);
	}

	public function getCreateButton()
	{
        if (isset($this->options['base_route'])) {
            return '<a class="btn btn-success" href="' . route($this->options['base_route'] . '.create') . '">New</a>';
        }

        return;
	}

    public static function get(Model $model, Request $request, array $options = [])
    {
    	$listable = $model->getListable();

    	$select = empty($listable) ? '*' : $listable;

        $query = $model->newQuery()
        	->select($select)
        	->where($request->only($listable))
        ;

        if ($request->has('order_by') && ($order_by = self::getOrderBy($request, $listable)) !== false && self::validateOrderBy($order_by, $listable)) {
        	$query->orderBy($order_by->column, $order_by->sort);
        }

        $query_string = array_merge($listable, ['order_by', 'per_page']);

        $paginator = $query->paginate(
        	$request->get('per_page') ?? static::PER_PAGE
        )->appends($request->only($query_string));

        return new Static(
        	$paginator->getCollection(),
        	$paginator->total,
        	$paginator->perPage,
        	$paginator->currentPage,
        	array_merge($paginator->options, $options),
        	$model
        );
    }

    private static function getOrderBy(Request $request)
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

    private static function validateOrderBy($order_by, array $columns = [])
    {
    	if (!empty($columns)) {
    		return in_array($order_by->column, $columns);
    	}

    	false;
    }
}