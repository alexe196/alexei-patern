<?php

namespace Alexei\core\loger;

use Alexei\core\loger\logerInterface\FormatInterface;
use Alexei\core\loger\logerInterface\Writeinterface;
use Psr\Log\AbstractLogger;
use Alexei\core\contracts\ComponentInterface;

class Loger extends AbstractLogger implements ComponentInterface
{

    protected $writer;
    protected $formatter;

    public function __construct(Writeinterface $writer, FormatInterface $formatter)
    {
        $this->writer = $writer;
        $this->formatter = $formatter;
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = array())
    {
        // Сначала форматируем
        $message = $this->formatter->format($level, $message, $context);
        // Потом записываем
        $this->writer->write($message);
    }

}