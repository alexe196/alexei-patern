<?php


namespace Alexei\core\components\Database;


use Alexei\core\contracts\BootstrapInterface;
use Alexei\core\contracts\ComponentInterface;

class Db implements ComponentInterface, BootstrapInterface
{
    protected $dsn;

    protected $user;

    protected $password;

    protected $connection;

    protected $table;

    public function __construct($dsn, $user, $password)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
        $this->connect();
    }

    public function bootstrap()
    {
        // TODO: Implement bootstrap() method.
    }

    public function connect()
    {
        try {
            $this->connection = new \PDO($this->dsn, $this->user, $this->password);
        }
        catch (\PDOException $e){
            $exception = new \Alexei\core\loger\ ExeptionFormater($e);
        }
        return $this;
    }

    public function table($table){
        $this->table = $table;
    }

    public function select($select = []){

        if ( !empty($select) ) {
            return implode(",", $select);
        }
        return false;
    }


    public function query()
    {

    }
}