<?php

namespace App\Model;


class Address extends Model {

  protected static $table = "address";

  public static function getTable() {
      return static::$table;
  }

  public function add($data) {
      $stmt = $this->db->prepare("INSERT INTO ".static::$table." (street, city, zip_code, country, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([$data['street'], $data['city'], $data['zip_code'], $data['country'], $user_id]);
      return $this->db->lastInsertId();
  }

  public function update($id, $data) {
      $stmt = $this->db->prepare("UPDATE ".static::$table." SET first_name = ?, last_name = ?, username = ?, email = ?, street = ?, city = ?, zip_code = ?, country = ?, user_id = ? WHERE id = ?");
      $stmt->execute([$data['street'], $data['city'], $data['zip_code'], $data['country'], $data['user_id'], $id]);
  }
}