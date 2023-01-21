<?php

namespace App\Model;

class Company extends Model {

	protected static $table = "company";

	public static function getTable() {
		return static::$table;
	}

	public function add($data) {
			$stmt = $this->db->prepare("INSERT INTO ".static::$table." (name, description) VALUES (?, ?)
			ON DUPLICATE KEY UPDATE description = values(description)");
			$stmt->execute([strtolower($data['name']), $data['description']]);
			return $this->db->lastInsertId();
	}

	public function update($id, $data) {
			$stmt = $this->db->prepare("UPDATE ".static::$table." SET name = ?, description = ? WHERE id = ?");
			$stmt->execute([$data['name'], $data['description'], $id]);
	}
}