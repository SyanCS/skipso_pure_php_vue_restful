<?php

namespace App\Factory;

class ControllerFactory
{
    private $modelFactory;
    private $controllers = [];

    public function __construct(ModelFactory $modelFactory)
		{
			$this->modelFactory = $modelFactory;
		}

		public function create(string $controllerName)
		{
				if (!array_key_exists($controllerName, $this->controllers)) {
						$controller = "App\Controller\\" . $controllerName;
						$modelName = str_replace("Controller", "", $controllerName);
						$model = $this->modelFactory->create($modelName);
						$this->controllers[$controllerName] = new $controller($model);
				}

				return $this->controllers[$controllerName];
		}
}