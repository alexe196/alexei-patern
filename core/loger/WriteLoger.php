<?php

namespace Alexei\core\loger;
use Alexei\core\loger\logerInterface\Writeinterface;

class WriteLoger implements  Writeinterface
{
    private $path = 'loger.txt';
    public $context;

    public function __construct($path)
    {
       $this->path = $path;
    }

    function write($context)
    {
        $this->context = $context;
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
            file_put_contents($this->path, $this->context. "\n", FILE_APPEND);
        }
    }
}