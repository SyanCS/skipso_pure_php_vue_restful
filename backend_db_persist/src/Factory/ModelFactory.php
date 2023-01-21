<?php

namespace App\Factory;

class ModelFactory
{
    private $db;
    private $models = [];

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function create(string $modelName)
    {
        if (!array_key_exists($modelName, $this->models)) {
            $model = "App\Model\\" . $modelName;
            $this->models[$modelName] = new $model($this->db);
        }

        return $this->models[$modelName];
    }
}