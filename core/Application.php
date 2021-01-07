<?php


namespace Alexei\core;



use Alexei\core\contracts\BootstrapInterface;
use Alexei\core\contracts\ContainerInterface;
use Alexei\core\contracts\RunnableInterface;

class Application implements BootstrapInterface, ContainerInterface, RunnableInterface
{
    protected static $instance;

    protected $config;

    protected $components = [];

    public static function getInstance($config)
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    protected function __construct($config = [])
    {
        $this->config = $config;
    }

    public function bootstrap()
    {
        if (!empty($this->config['components'])) {
            foreach ($this->config['components'] as $key => $item) {
                if (isset($item['class']) && class_exists($item['class'])) {
                    $instance = new $item['class'];
                    $this->components[$key] = $instance;
                }
            }
        }
    }

    public function get($name)
    {
        if (array_key_exists($name, $this->components)) {

            return $this->components[$name];
        }

        return null;
    }

    public function has($name)
    {
        // TODO: Implement has() method.
    }

    public function run()
    {
        $this->bootstrap();

        $router = $this->get('router');
        if ($action = $router->route()) {
            $action();
        }
    }
}