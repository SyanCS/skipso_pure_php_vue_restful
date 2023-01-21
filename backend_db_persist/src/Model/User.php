<?php

namespace App\Model;

use App\Model\Company;

class User extends Model {

  protected static $table = "user";

  public static function getTable() {
      return static::$table;
  }

  public function add($data) {
      
      $stmt = $this->db->prepare("INSERT INTO ".static::$table." (first_name, last_name, username, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([$data['first_name'], $data['last_name'], $data['username'], $data['email']]);
      $id = $this->db->lastInsertId();

      $data['user_id'] = $id;

      $addressModel = new Address($this->db);
      $addressModel->add($data);

      if($data['company_name']){
        $companyModel = new Company($this->db);
        $companyId = $companyModel->add(['name' => $data['company_name'], 'description' => $data['company_description']]);

        $userCompanyModel = new UserCompany($this->db);
        $userCompanyModel->add(['user_id' => $id, 'company_id' => $companyId]);

      }

      return $id;
  }

  public function update($id, $data) {
      $stmt = $this->db->prepare("UPDATE ".static::$table." SET first_name = ?, last_name = ?, username = ?, email = ? WHERE id = ?");
      $stmt->execute([$data['first_name'], $data['last_name'], $data['username'], $data['email'], $data['country'], $id]);
  }

  public function getAllWithCompany()
	{
		$stmt = $this->db->prepare("
      SELECT 
        u.*, 
        c.name as company_name,
        c.description as company_description
      FROM ".static::$table." u
      LEFT JOIN ".UserCompany::getTable()." uc 
        ON u.id = uc.user_id 
      LEFT JOIN ". Company::getTable()." c
      ON uc.company_id = c.id     
    ");
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}