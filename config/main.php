<?php

use Alexei\core\components\router\RouterFactory;
use Alexei\core\components\hellow\HelloFactory;

return [
    'components' => [
        'router' => [
            'factory' => RouterFactory::class
        ],
        'hello' => [
            'factory' => HelloFactory::class,
        ]
    ]
];