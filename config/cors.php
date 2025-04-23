<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'],

    'allowed_origins' => ['http://localhost:8001/'],

    'allowed_origins_patterns' => ['Content-Type', 'X-Requested-With', 'Authorization'],

    'allowed_headers' => ['Access-Control-Allow-Origin', 'Content-Type', 'X-Requested-With', 'Authorization'],

    'exposed_headers' => [],

    'max_age' => 3600,

    'supports_credentials' => false,

];
