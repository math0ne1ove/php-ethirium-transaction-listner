<?php

return [
    'default_driver' => env('ETHERIUM_PROVIDER', 'infura'),

    'infura' => [
        'network' => env('INFURA_NETWORK', 'kovan'),
        'base_uri' => env('INFURA_API_ADDRESS', 'infura.io/v3'),
        'ws_uri' => env('INFURA_API_ADDRESS', 'infura.io/ws/v3'),
        'project_id' => env('INFURA_PROJECT_ID', ''),
    ]

    //...
];
