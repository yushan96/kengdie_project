<?php
function get_db_config()
{
    return $db_config = [
        'connection' => env('DB_CONNECTION', 'mysql'),
        'host' => env('DB_HOST', '159.65.239.77'),
        'database'  => env('DB_DATABASE', 'oingo'),
        'username'  => env('DB_USERNAME', 'root'),
        'password'  => env('DB_PASSWORD', '123456'),
    ];
}