<?php


namespace Alexei\core\loger;


use Alexei\core\contracts\ComponentFactoryAbstract;
use Alexei\core\contracts\ComponentInterface;
use Alexei\core\loger\Loger;

class LoggerFactory extends ComponentFactoryAbstract
{
    /**
     * Создает экземпляр логера
     *
     * @param array $params
     * @return ComponentInterface
     */
    protected function createConcreteInstance($params = []): ComponentInterface
    {
        $writer = new WriteLoger($_SERVER['DOCUMENT_ROOT'] . '/../storage/logs/log.txt');
        $formatter = new FormatLoger();

        return new Loger($writer, $formatter);
    }
}