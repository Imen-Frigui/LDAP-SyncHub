<?php

return [

    'default' => env('LDAP_CONNECTION', 'default'),

    'connections' => [

        'default' => [
            'hosts' => ['127.0.0.1'], 
            'username' => 'cn=admin,dc=example,dc=com', 
            'password' => 'admin',
            'port' => 389,
            'base_dn' => 'dc=example,dc=com',
            'timeout' => 5,
        ],

    ],

];


// return [
//    'default' => 'default',

// 'connections' => [
//     'default' => [
//         'hosts' => ['127.0.0.1'],
//         'username' => env('LDAP_USERNAME', 'cn=admin,dc=example,dc=com'),
//         'password' => env('LDAP_PASSWORD', '0000'),
//         'base_dn' => env('LDAP_BASE_DN', 'dc=example,dc=com'),
//         'port' => env('LDAP_PORT', 389),
//         'use_ssl' => env('LDAP_USE_SSL', false),
//         'use_tls' => env('LDAP_USE_TLS', false),
//     ],
// ],
//];


