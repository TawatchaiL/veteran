<?php

return [
    'manager' => [
        'host' => env('ASTERISK_MANAGER_HOST', '10.148.0.4'),
        'user' => env('ASTERISK_MANAGER_USER', 'crm'),
        'password' => env('ASTERISK_MANAGER_PASSWORD', 'rsiippbx'),
        'port' => env('ASTERISK_MANAGER_PORT', '5038'),
        'remote_context' => env('ASTERISK_REMOTE_CONTEXT', 'ext-local'),
    ],
    'event_serv' => [
        'address' => env('EVENT_SERV_ADDRESS', 'http://192.168.10.17:3000'),
    ],
    'gateway' => [
        'name' => env('GATEWAY_NAME', 'rsiippbx'),
    ],
];
