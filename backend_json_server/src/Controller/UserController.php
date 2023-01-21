<?php

namespace App\Controller;
use App\Response\Response;

class UserController extends Controller {
	
	public function store($data) {
		// First and last name validation
		if(preg_match('/\d/', $data['first_name'])) {
			return Response::error('First name should not contain numbers', 400);
		}
		if(preg_match('/\d/', $data['last_name'])) {
			return Response::error('Last name should not contain numbers', 400);
		}

		// Username validation
		if(strlen($data['username']) < 8 || strlen($data['username']) > 20) {
			return Response::error('Username should be between 8 and 20 characters', 400);
		}
		if(!preg_match('/^[A-Za-z0-9]+$/', $data['username'])) {
			return Response::error('Username should only contain letters and numbers', 400);
		}

		// Email validation
		if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			return Response::error('Invalid email address', 400);
		}

		// Country validation
		$countries = json_decode(file_get_contents('https://restcountries.com/v2/all'), true);
		$validCountry = false;
		foreach($countries as $country) {
			if(strtolower($data['country']) === strtolower($country['name'])) {
				$validCountry = true;
				break;
			}
		}
		if(!$validCountry) {
			return Response::error('Invalid country', 400);
		}

		parent::store($data);
	}

}
