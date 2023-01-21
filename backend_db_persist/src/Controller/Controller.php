<?php

namespace App\Controller;

use App\Response\Response;

class Controller implements ControllerInterface {

	protected $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function index() {
			$items = $this->model->getAll();
			return Response::success($items);
	}

	public function show($id) {
		
			$item = $this->model->getById($id);
			if ($item) {
				return Response::success($item);
			} else {
					return Response::error('Not found', 404);
			}
	}
	public function delete($id) {
			$this->model->delete($id);
			return Response::success(["message" => "Item deleted"]);
	}
	public function store($data) {
		$elementId = $this->model->add($data);
		$element = $this->model->getById($elementId);
		return Response::success($element);
	}
	public function update($id, $data) {
		$this->model->update($id, $data);
		$element = $this->model->getById($id);
		return Response::success($element);
	}
}