<?php


namespace Alexei\core\components\hellow;

use Alexei\core\contracts\ComponentFactoryAbstract;
use Alexei\core\components\hellow\Hello;

class HelloFactory extends ComponentFactoryAbstract
{

    protected function createConcreteInstance()
    {
        return new Hello();
    }
}