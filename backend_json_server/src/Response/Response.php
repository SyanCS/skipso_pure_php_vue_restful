<?php

namespace App\Response;

class Response {

	public static function json($data, $status = 200) {
		http_response_code($status);
		header('Content-Type: application/json');
		echo $data;
		exit;
	}

	public static function success($data, $status = 200) {
			http_response_code($status);
			header('Content-Type: application/json');
			echo $data;
			exit;
	}
	
	public static function error($message, $status = 400) {
			http_response_code($status);
			header('Content-Type: application/json');
			echo $message;
			exit;
	}
}