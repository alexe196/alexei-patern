<?php


namespace Alexei\core\contracts;


abstract class ComponentFactoryAbstract
{
    public function createInstance(){
        $this->createConcreteInstance();
    }

    protected abstract function createConcreteInstance();
}