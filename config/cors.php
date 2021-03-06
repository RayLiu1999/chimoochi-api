<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*'],

    'allowed_methods' => ['PUT, GET, POST, DELETE, PATCH, OPTIONS'],

    'allowed_origins' => ['http://127.0.0.1:8000', 'http://localhost', 'https://6yuwei.com', 'https://chimoochi-api.herokuapp.com', 'http://127.0.0.1:8080', 'http://127.0.0.1:5500', 'https://liu-yucheng.com'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Origin, Content-Type, Authorization, X-MY-CUSTOM-HEADER'],

    'exposed_headers' => [],

    'max_age' => 86400,

    'supports_credentials' => true,

];
