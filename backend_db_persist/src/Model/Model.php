<?php

namespace App\Model;

use App\Model\ModelInterface;

abstract class Model implements ModelInterface {

	protected $db;
	protected static $table;

  public static function getTable() {
      // Method must be implemented in child classes
  }

	public function __construct($db) {
			$this->db = $db;
	}

	public function getAll() {
			$stmt = $this->db->prepare("SELECT * FROM ".static::$table);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getById($id) {
			$stmt = $this->db->prepare("SELECT * FROM ".static::$table." WHERE id = ?");
			$stmt->execute([$id]);
			return $stmt->fetch();
	}

	public function add($data) {
			// Method must be implemented in child classes
	}

	public function update($id, $data) {
			// Method must be implemented in child classes
	}

	public function delete($id) {
			$stmt = $this->db->prepare("DELETE FROM ".static::$table." WHERE id = ?");
			$stmt->execute([$id]);
	}
}