<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => env('DB_PREFIX', ''),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => env('DB_PREFIX', ''),
            'strict' => env('DB_STRICT_MODE', false),
            'engine' => env('DB_ENGINE', null),
            'timezone' => env('DB_TIMEZONE', '+00:00'),
            'options'   => [
                PDO::ATTR_PERSISTENT => true,
            ],
        ],

        'auth_mysql' => [
            'driver' => 'mysql',
            'host' => env('AUTH_DB_HOST', '127.0.0.1'),
            'port' => env('AUTH_DB_PORT', 3306),
            'database' => env('AUTH_DB_DATABASE', 'forge'),
            'username' => env('AUTH_DB_USERNAME', 'forge'),
            'password' => env('AUTH_DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => env('DB_PREFIX', ''),
            'strict' => env('DB_STRICT_MODE', false),
            'engine' => env('DB_ENGINE', null),
            'timezone' => env('DB_TIMEZONE', '+00:00'),
            'options'   => [
                PDO::ATTR_PERSISTENT => true,
            ],
        ],

        'failed_job_mysql' => [
            'driver' => 'mysql',
            'host' => env('FAILED_DB_HOST', '127.0.0.1'),
            'port' => env('FAILED_DB_PORT', 3306),
            'database' => env('FAILED_DB_DATABASE', 'forge'),
            'username' => env('FAILED_DB_USERNAME', 'forge'),
            'password' => env('FAILED_DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => env('DB_PREFIX', ''),
            'strict' => env('DB_STRICT_MODE', false),
            'engine' => env('DB_ENGINE', null),
            'timezone' => env('DB_TIMEZONE', '+00:00'),
            'options'   => [
                PDO::ATTR_PERSISTENT => true,
            ],
        ],

        'contacts_mysql' => [
            'driver' => 'mysql',
            'host' => env('CONTACTS_DB_HOST', '127.0.0.1'),
            'port' => env('CONTACTS_DB_PORT', 3306),
            'database' => env('CONTACTS_DB_DATABASE', 'contacts'),
            'username' => env('CONTACTS_DB_USERNAME', 'contacts'),
            'password' => env('CONTACTS_DB_PASSWORD', 'contacts'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => env('DB_PREFIX', ''),
            'strict' => env('DB_STRICT_MODE', false),
            'engine' => env('DB_ENGINE', null),
            'timezone' => env('DB_TIMEZONE', '+00:00'),
            'options'   => [
                PDO::ATTR_PERSISTENT => true,
            ],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', 5432),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => env('DB_PREFIX', ''),
            'schema' => env('DB_SCHEMA', 'public'),
            'sslmode' => env('DB_SSL_MODE', 'prefer'),
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', 1433),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => env('DB_PREFIX', ''),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'phpredis',

        'cluster' => env('REDIS_CLUSTER', false),

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
            'persistent' => false,
        ],

        'cache' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
            'persistent' => false,
        ],

        'queues' => [
            'host' => env('REDIS_QUEUE_HOST', '127.0.0.1'),
            'password' => env('REDIS_QUEUE_PASSWORD', null),
            'port' => env('REDIS_QUEUE_PORT', 6379),
            'database' => env('REDIS_QUEUE_DB', 0),
            'persistent' => false,
        ],

        'throttle' => [
            'host' => env('REDIS_THROTTLE_HOST', '127.0.0.1'),
            'password' => env('REDIS_THROTTLE_PASSWORD', null),
            'port' => env('REDIS_THROTTLE_PORT', 6379),
            'database' => env('REDIS_THROTTLE_DB', 0),
            'persistent' => false,
        ],

        'callbacks' => [
            'host'     => env('REDIS_CALLBACK_HOST', env('REDIS_HOST', '127.0.0.1')),
            'password' => env('REDIS_CALLBACK_PASSWORD', env('REDIS_PASSWORD', null)),
            'port'     => env('REDIS_CALLBACK_PORT', env('REDIS_PORT', 6379)),
            'database' => env('REDIS_CALLBACK_DB', 0),
            'persistent' => false,
        ],

        'app' => [
            'host'     => env('REDIS_APP_HOST', env('REDIS_HOST', '127.0.0.1')),
            'password' => env('REDIS_APP_PASSWORD', env('REDIS_PASSWORD', null)),
            'port'     => env('REDIS_APP_PORT', env('REDIS_PORT', 6379)),
            'database' => env('REDIS_APP_DB', 0),
            'persistent' => false,
        ],

        'balance' => [
            'host'     => env('REDIS_BALANCE_HOST', env('REDIS_HOST', '127.0.0.1')),
            'password' => env('REDIS_BALANCE_PASSWORD', env('REDIS_PASSWORD', null)),
            'port'     => env('REDIS_BALANCE_PORT', env('REDIS_PORT', 6379)),
            'database' => 0,
            'persistent' => false,
        ],

        'keys' => [
            'host'     => env('REDIS_KEYS_HOST', env('REDIS_HOST', '127.0.0.1')),
            'password' => env('REDIS_KEYS_PASSWORD', env('REDIS_PASSWORD', null)),
            'port'     => env('REDIS_KEYS_PORT', env('REDIS_PORT', 6379)),
            'database' => 0,
            'persistent' => false,
        ],
    ],

];
