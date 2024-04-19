<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "qadb";

function initConnection($host, $username, $password, $dbname)
{
    $conn = mysqli_connect(hostname: $host, username: $username, password: $password, database: $dbname);
    if (mysqli_connect_errno()) {
        die("Connection error: " . mysqli_connect_errno());
    }

    return $conn;
}