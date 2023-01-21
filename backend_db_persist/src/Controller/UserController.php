<?php

namespace App\Controller;
use App\Response\Response;

class UserController extends Controller {
	

	public function getAllWithCompany()
	{
		$items = $this->model->getAllWithCompany();
		return Response::success($items);
	}

}
