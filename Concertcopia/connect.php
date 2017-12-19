<?php
function connect() {
    $dbuser = 'root';
    $dbpass = 'root';
    $dbname = 'concert_database';
    $dbhost = 'localhost';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, "3306");

    if (!$connection) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
    return $connection;
}