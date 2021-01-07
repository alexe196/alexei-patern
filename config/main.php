<?php

use Alexei\core\Hello;
use Alexei\core\Router;

return [
    'components' => [
        'router' => [
            'class' => Router::class
        ],
        'hello' => [
            'class' => Hello::class,
        ]
    ]
];