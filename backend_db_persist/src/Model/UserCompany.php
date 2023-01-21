<?php

namespace App\Model;

class Company extends Model {

	protected static $table = "user_company";

	public static function getTable() {
		return static::$table;
	}

	public function add($data) {
		$stmt = $this->db->prepare("INSERT INTO ".static::$table." (user_id, company_id) VALUES (?, ?)");
		$stmt->execute([strtolower($data['user_id']), $data['company_id']]);
		return $this->db->lastInsertId();
	}
}