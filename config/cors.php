<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Default CORS Settings
     |--------------------------------------------------------------------------
     |
     | The options below will be used to configure your CORS setup. You may
     | configure them based on your application's requirements.
     |
     */

    'paths' => ['api/*'], // Apply CORS to API routes
    'allowed_methods' => ['*'], // Allow all HTTP methods (GET, POST, PUT, DELETE, etc.)
    'allowed_origins' => ['*'], // Allow all origins (change to specific domains for security)
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false, // Set to true if your app uses cookies for authentication
];
