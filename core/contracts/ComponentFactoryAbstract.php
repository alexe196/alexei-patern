<?php


namespace Alexei\core\contracts;


abstract class ComponentFactoryAbstract
{
    public function createInstance(){
        return $this->createConcreteInstance();
    }

    protected abstract function createConcreteInstance();
}