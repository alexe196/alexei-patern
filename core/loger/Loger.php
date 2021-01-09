<?php

namespace Alexei\core\loger;

use Psr\Log\AbstractLogger;

class Loger extends AbstractLogger
{
    public function log($level, $message, array $context = array())
    {
        $context = new FormatLoger($context);
        $write = new WriteLoger($context->Conwert());
        $write->write();
    }

}