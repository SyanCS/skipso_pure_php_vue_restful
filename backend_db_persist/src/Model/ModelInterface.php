<?php

namespace App\Model;

interface ModelInterface {
	public function getAll();
	public function getById($id);
	public function add($data);
	public function update($id, $data);
	public function delete($id);
}