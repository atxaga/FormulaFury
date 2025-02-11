<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', '/'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://10.14.0.235:5173'], 
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];