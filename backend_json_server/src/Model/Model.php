<?php

namespace App\Model;

use App\Model\ModelInterface;
use App\Request\Request;

abstract class Model implements ModelInterface {

	protected static $endpoint;

	public function __construct() {
		
	}

	public function add($data) {
		$response = Request::makeRequest('POST', static::$endpoint, $data);
		return $response;
	}

	public function getAll() {
		$response = Request::makeRequest('GET', static::$endpoint);
		return $response;
	}

	public function getById($id) {
		$url = static::$endpoint . '/' . $id;
		$response = Request::makeRequest('GET', $url);
		return $response;
	}
}