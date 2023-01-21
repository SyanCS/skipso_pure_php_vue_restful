<?php

namespace App\Route;

use App\Request\Request;
use App\Factory\ControllerFactory;

class Router
{
    private $request;
    private $controllerFactory;
    private $routes = [];

    public function __construct(Request $request, ControllerFactory $controllerFactory)
    {
        $this->request = $request;
        $this->controllerFactory = $controllerFactory;
    }

    public function get(string $uri, string $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post(string $uri, string $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function put(string $uri, string $controller)
    {
        $this->routes['PUT'][$uri] = $controller;
    }

    public function delete(string $uri, string $controller)
    {
        $this->routes['DELETE'][$uri] = $controller;
    }

    public function run()
    {
        $uri = $this->request->getUri();
        $method = $this->request->getMethod();
        $postData = $this->request->isPost() ? $this->request->getPostData() : [];

        if (array_key_exists($method, $this->routes)) {
            //loop through the routes array for the current request method
            foreach ($this->routes[$method] as $route => $controller) {
                //create a regular expression for the current route to match against the current URI
                $routeRegex = preg_replace('/{[^}]+}/', '([^/]+)', $route);
                //check if the current URI matches the current route
                if (preg_match("@^$routeRegex$@", $uri, $matches)) {
                    //remove the first match (the full URI)
                    array_shift($matches);

                    $controller = explode('@', $controller);
                    $controllerName = $controller[0];
                    $actionName = $controller[1];

                    $controller = $this->controllerFactory->create($controllerName);
                    switch($method){
                        case 'PUT':
                            call_user_func_array([$controller, $actionName], [$postData, $matches]);
                            break;
                        case 'POST':
                            call_user_func_array([$controller, $actionName], [$postData]);
                            break;
                        default:
                            call_user_func_array([$controller, $actionName], $matches); 
                    }
                    return;
                }
            }
        }
        echo 'Route not found.';
    }
}