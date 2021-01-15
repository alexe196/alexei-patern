<?php


namespace Alexei\core\loger;


use Exception;

class ExeptionFormater
{
    private $getExeption = [];

    public function __construct(Exception $exception )
    {
        $this->getExeption['getMessage'] = $exception->getMessage();
        $this->getExeption['getLine'] = $exception->getLine();
        $this->getExeption['getCode'] = $exception->getCode();
        $this->getExeption['getFile'] = $exception->getFile();
    }

    public function get_error() : array
    {
        return $this->getExeption;
    }
}