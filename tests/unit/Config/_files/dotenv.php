<?php

return [
    'mysql' => [
        'user' => getenv('MYSQL_USER'),
        'host' => getenv('MYSQL_HOST'),
    ],
    'custom' => [
        'bar' => getenv('CUSTOM_BAR')
    ]
];
