<?php
session_start();
require_once "config.php";

// подключение к бд
try {
    $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
    $connect = new DB($connect_str, DB_USER, DB_PASS);
} catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
}


mysqli_query($connect, "SET NAMES 'utf8'");
mysqli_query($connect, "SET CHARACTER SET 'utf8'");

if(!mysqli_set_charset($connect, "utf8")){
    printf("Error: ".mysqli_error($connect));
}
