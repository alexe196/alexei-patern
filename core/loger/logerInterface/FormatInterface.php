<?php


namespace Alexei\core\loger\logerInterface;


interface FormatInterface
{
    function format($level, $message, $context);
}