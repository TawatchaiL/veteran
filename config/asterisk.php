<?php

return [
    'manager' => [
        'host' => env('ASTERISK_MANAGER_HOST', '10.148.0.4'),
        'user' => env('ASTERISK_MANAGER_USER', 'crm'),
        'password' => env('ASTERISK_MANAGER_PASSWORD', 'rsiippbx'),
        'port' => env('ASTERISK_MANAGER_PORT', '5038'),
        'remote_context' => env('ASTERISK_REMOTE_CONTEXT', 'ext-local'),
        'warp_id' => env('WARP_ID', '5'),
        'sup_break_id' => env('SUP_BREAK_ID', '6'),
        'out_break_id' => env('OUT_BREAK_ID', '7'),
        'call_survey_number' => env('ASTERISK_CALLSURVEY_NUMBER','7891')
    ],
    'eccp' => [
        'eccp_host' => env('ECCP_HOST', '10.148.0.4'),
        'eccp_user' => env('ECCP_USER', 'agentconsole'),
        'eccp_password' => env('ECCP_PASSWORD', 'agentconsole'),
    ],
    'toolbar_serv' => [
        'address' => env('TOOLBAR_SERV_ADDRESS', 'http://10.148.0.4:3001'),
    ],
    'api_serv' => [
        'address' => env('API_SERV_ADDRESS', 'http://10.148.0.4:3000'),
    ],
    'dashboard_serv' => [
        'address' => env('DASHBOARD_SERV_ADDRESS', 'http://10.148.0.4:3002'),
    ],
    'gateway' => [
        'name' => env('GATEWAY_NAME', 'rsiippbx'),
    ],
];
