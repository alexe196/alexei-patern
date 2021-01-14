<?php

use Alexei\core\components\router\Router;
use App\controllers\PageController;

$this->addRoute(Router::METHOD_GET, '/page/view', [new PageController(), 'viewAction']);

$this->get('/', function(){
    echo 'Main page';
});