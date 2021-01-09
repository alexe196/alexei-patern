<?php


namespace Alexei\core\loger;
use Alexei\core\loger\logerInterface\FormatInterface;

class FormatLoger implements FormatInterface
{
    public $exception = array();
    public $convertStr = '';

    public function __construct(array $exception)
    {
        $this->exception = $exception;
    }

    public function Conwert()
    {
        return $this->set_context();
    }

    protected function hasexception()
    {
        if (!empty($this->exception)) {
            return true;
        } else {
            return false;
        }
    }

    protected function set_context()
    {

        if ($this->hasexception()) {

            $this->convertStr ="Erorr: " . $this->exception['getMessage']." ";
            $this->convertStr.= date('Y-m-d H:i:s')." ";
            $this->convertStr.= $this->exception['getLine']." ";
            $this->convertStr.= $this->exception['getFile'];

            return $this->convertStr;
        }
    }
}