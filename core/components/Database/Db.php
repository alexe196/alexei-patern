<?php


namespace Alexei\core\components\Database;



use Alexei\core\Application;
use Alexei\core\contracts\BootstrapInterface;
use Alexei\core\contracts\ComponentInterface;
use PDO;

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
            $message = 'DB_CONNECT';
            $level = 1;
            Application::getInstance()->get('logger')->log($level, $message,$exception);

        }
        return $this;
    }


    public function query($sql)
    {
        if (!empty($sql)) {
            $this->connection->prepare($sql);
            $this->connection->execute();
            return $this->connection->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}