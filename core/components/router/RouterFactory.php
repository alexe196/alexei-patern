<?php

namespace Alexei\core\components\router;

use Alexei\core\contracts\ComponentFactoryAbstract;
use Alexei\core\components\router\Router;

class RouterFactory extends ComponentFactoryAbstract{

    protected function createConcreteInstance()
    {
        return new Router();
    }
}
