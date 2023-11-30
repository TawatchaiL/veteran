<?php
return [
    'ldap' => [
        'host' => env('LDAP_HOST', '192.168.1.103'),
        'port' => env('LDAP_PORT', '389'),
        'cn' => env('LDAP_CN', 'users'),
        'dc' => env('LDAP_DC', 'synology'),
        'auth_col' => env('LDAP_AUTH_COL', 'mail'),
    ]
];