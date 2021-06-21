<?php

return [
    'displayErrorDetails' => true, // Should be set to false in production
    'logError'            => true,
    'logErrorDetails'     => true,
    'logger' => [
        'name' => 'slim-app',
        'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
        'level' => \Monolog\Logger::INFO,
    ],
    'database' => [
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => 'root',
        'dbname'   => 'stock-tool',
    ]
];
