<?php


namespace Alexei\core\contracts;


interface ContainerInterface
{
    public function get($name);

    public function has($name);
}