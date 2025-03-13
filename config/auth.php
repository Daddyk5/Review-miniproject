<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may adjust these defaults
    | as needed, but they are a great starting point for most apps.
    |
    */

    'defaults' => [
        'guard' => 'web', // Default to web guard
        'passwords' => 'users', // Default password reset broker
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Here you may define every authentication guard for your application.
    | A great default configuration has been defined here for you which
    | uses session storage and the Eloquent user provider.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        // You can add API guard if needed later
        // 'api' => [
        //     'driver' => 'token',
        //     'provider' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication guards have a user provider, which defines how
    | the users are retrieved from your database. You may configure
    | multiple sources if you have multiple user tables/models.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Directly use User model
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have
    | more than one user table or model. These settings control how
    | password reset tokens are stored and how long they are valid.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens', // Default reset tokens table
            'expire' => 60, // Valid for 60 minutes
            'throttle' => 60, // Prevent abuse by limiting requests
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Define how long (in seconds) before the password confirmation expires.
    | Default is 3 hours (10800 seconds). Adjust if you want shorter/longer.
    |
    */

    'password_timeout' => 10800,

];
