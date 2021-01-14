<?php

use Alexei\core\components\Database\DbFactory;
use Alexei\core\components\router\RouterFactory;
use Alexei\core\loger\LoggerFactory;

return [
    'components' =>
    [
        'router' => [
            'factory' => RouterFactory::class,
        ],
        'logger' => [
            'factory' => LoggerFactory::class,
            'params' => [
                'logFile' => $_SERVER['DOCUMENT_ROOT'] . '/../storage/logs/log.txt',
            ],
        ],
        'db' => [
            'factory' => DbFactory::class,
            'params' => [
                'dsn' => 'test',
                'user' => 'root',
                'password' => 'hello'
            ]
        ]
    ]
];