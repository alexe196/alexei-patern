<?php

namespace Alexei\core\loger;
use Alexei\core\loger\logerInterface\Writeinterface;

class WriteLoger implements  Writeinterface
{
    private $path = 'loger.txt';
    public $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    function write()
    {
        $this->set_file();
    }

    function hasFile()
    {
        if (file_exists($this->path) && !empty($this->context)) {
            return true;
        }

        return false;
    }

    function set_file()
    {
        if ($this->hasFile()) {
            $fd = fopen($this->path, 'w') or die("не удалось создать файл");
            fwrite($fd, $this->context );
            fclose($fd);
        }
    }
}