<?php

namespace Systemson\Blankboard\App\Crud;

use Illuminate\Database\Eloquent\Model;

class Form
{
	public $baseRoute;
	public $model;

	public function __construct(Model $model, string $baseRoute)
	{
		$this->model = $model;
		$this->baseRoute = $baseRoute;
	}

	public function getInputs()
	{
		$fillable = $this->model->getFillable();

		foreach ($fillable as $attr) {
			$inputs = (object) [
				'label' => $attr,
				'name' => $attr,
				'type' => 'text',
				'value' => $model->{$attr},
			];
		}
	}

	public function isCreate()
	{
		return empty($this->model->getAttributes());
	}

	public function isEdit()
	{
		return !empty($this->model->getAttributes());
	}

    public function __call($method, $args = [])
    {
    	return call_user_func_array([$this->model, $method], $args);
    }

    public function getUrl()
    {
    	if ($this->isCreate()) {
    		return route($this->baseRoute . '.store');
    	}

    	return route($this->baseRoute . '.update', $this->getKey());
    }

    public function getMethod()
    {
    	if ($this->isCreate()) {
    		return 'POST';
    	}

    	return 'PATCH';
    }
}