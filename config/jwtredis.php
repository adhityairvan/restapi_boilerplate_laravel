<?php

return [
    /*
    |--------------------------------------------------------------------------
    | JWTRedis User Model Observer
    |--------------------------------------------------------------------------
    |
    | This observer class, listening all events on your user model. Is triggered
    | when you assign roles & permissions to user, or update and delete to
    | your user model.
    |
    */
    'observer' => \Sametsahindogan\JWTRedis\Observers\UserRedisObserver::class,

    /*
    |--------------------------------------------------------------------------
    | Observer Events Are Queued
    |--------------------------------------------------------------------------
    |
    | If this option is true, model's events are processed as a job on queue.
    |
    | * ~ Don't forget to run Queue Worker if this option is true. ~ *
    |
    */
    'observer_events_queue' => env('JWTREDIS_OBSERVER_EVENTS_QUEUE', false),

    /*
    |--------------------------------------------------------------------------
    | Your User Model
    |--------------------------------------------------------------------------
    |
    | You can set specific user model.
    |
    */
    'user_model' => \App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | Store on Redis up to jwt_ttl value.
    |--------------------------------------------------------------------------
    |
    | If it's option is true, user stored in Redis up to jwt_ttl value time.
    |
    */
    'redis_ttl_jwt' => true,

    /*
    |--------------------------------------------------------------------------
    | Store on Redis up to specific time
    |--------------------------------------------------------------------------
    |
    |  User stored in Redis redis_ttl value time.
    |
    */
    'redis_ttl' => env('JWTREDIS_REDIS_TTL', 60),

    /*
    |--------------------------------------------------------------------------
    | Cache Prefix
    |--------------------------------------------------------------------------
    |
    | If it's user id is 1, this user stored in Redis as auth_1.
    |
    */
    'redis_auth_prefix' => env('JWTREDIS_REDIS_AUTH_PREFIX', 'auth_'),

    /*
    |--------------------------------------------------------------------------
    | Igbinary Serialization
    |--------------------------------------------------------------------------
    |
    | Igbinary Serialization provides a better performance and lower memory
    | usage than PHP Serialization.
    |
    | * ~ Don't forget to enable igbinary extension if this option is true. ~ *
    |
    */
    'igbinary_serialization' => env('JWTREDIS_IGBINARY_SERIALIZATION', false),

    /*
    |--------------------------------------------------------------------------
    | Banned User Checking
    |--------------------------------------------------------------------------
    |
    | If the check_banned_user option is true, that users cannot access
    | the your application.
    |
    */
    'check_banned_user' => env('JWTREDIS_CHECK_BANNED_USER', false),

    /*
    |--------------------------------------------------------------------------
    | Status Column For Banned User Checking
    |--------------------------------------------------------------------------
    |
    | You can set your specific column name of your user model.
    |
    */
    'status_column_title' => 'status',

    /*
    |--------------------------------------------------------------------------
    | Restricted statuses For Banned User Checking
    |--------------------------------------------------------------------------
    |
    | If the user has one of these statuses and trying to reach your application,
    | JWTRedis throws AccountBlockedException.
    | You can set the message (check it errors array) that will return in this
    | exception.
    |
    */
    'banned_statuses' => [
        'banned',
        'deactivate',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache This Relations When User Has Authenticated
    |--------------------------------------------------------------------------
    |
    | You can add this array to your own relations, anything you want to store
    | in Redis. We recommend caching only roles and permissions here as much as
    | possible.
    |
    */
    'cache_relations' => [
        'roles.permissions',
        'permissions',
    ],

    /*
    |--------------------------------------------------------------------------
    | Customize All Exception Messages and Codes
    |--------------------------------------------------------------------------
    |
    | You can customize error code,message,title for your application.
    |
    */
    'errors' => [

        'default' => [
            'message' => 'An error occurred.',
        ],

        'AccountBlockedException' => [
            'message' => 'Your account has been blocked by the administrator.',
        ],

        'TokenNotProvidedException' => [
            'message' => 'Token not provided.',
        ],

        'JWTException' => [
            'message' => 'A token is required',
        ],

        'TokenBlacklistedException' => [
            'message' => 'The token has been blacklisted.',
        ],

        'TokenExpiredException' => [
            'message' => 'Token has expired.',
        ],

        'TokenInvalidException' => [
            'message' => 'Could not decode or verify token.',
        ],

        'PermissionException' => [
            'message' => 'User does not have the right permissions.',
        ],

        'RoleException' => [
            'message' => 'User does not have the right roles.',
        ],

        'RoleOrPermissionException' => [
            'message' => 'User does not have the right roles or permissions.',
        ],
    ],
];
