<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | This is the default disk used when storing files. We'll use 'public'
    | so that all files uploaded (like movie posters) are publicly accessible.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | You may configure as many disks as needed. 'local' is private by default.
    | 'public' is where user-uploaded files like images should go.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'), // private local disk
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'), // public disk for file uploads
            'url' => env('APP_URL').'/storage',   // URL to access uploaded files
            'visibility' => 'public',             // Make files publicly accessible
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | These symbolic links will be created when running `php artisan storage:link`.
    | This makes files in "storage/app/public" accessible from "public/storage".
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
