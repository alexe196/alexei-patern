<?php


namespace Alexei\core\components\router;


class Router
{

    public function route()
    {

        $path = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $controllerName = 'App\\controllers\\IndexController';
        $actionName = 'indexAction';

        if (!empty($path[1])) {
            $controllerName = 'App\\controllers\\' . ucfirst($path[1]) . 'Controller';

            if (isset($path[2])) {
                $actionName = $path[2] . 'Action';
            }
        }
        if (!class_exists($controllerName)) {
            throw new \Exception("Class: ".$controllerName." - not found");
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $actionName)) {
            throw new \Exception('Action not found');
        }

        return function() use ($controller, $actionName){
            $controller->$actionName($this->getParams());
        };
    }

    public function getParams()
    {
        return $_GET;
    }
}