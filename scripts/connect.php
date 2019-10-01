<?php

function to_connect() {
    $host_name = "127.0.0.1";
    $db_user = "root";
    $db_passwd = "root";
    $db_name = "video_db";
    $connection = mysqli_connect($host_name, $db_user, $db_passwd, $db_name); //host_name, user, passwd, db
    //check connection
    if (!$connection) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    } 
    // Open Database.	
    mysqli_select_db($connection, $db_name);
    return $connection;
}

function consult($connection, $query) {
    return mysqli_query($connection, $query);
}

function disconnect($connection) {
    mysqli_close($connection);
}
?>


