<?php

namespace App\Model;

use App\Model\Company;

class User extends Model {

  protected static $endpoint = "users";

  public static function getEndpoint() {
      return static::$endpoint;
  }
}