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

/**
 * @param $conn     MySQL Connection
 * @param $input    Input query to test if there exists a same query in the db.
 * @param $db_attribute_name   Database attribute name to check.
 * @return bool     Whether there is a duplicate user name.
 */
function checkDupUserAttribute($conn, $input, $db_attribute_name)
{
    // MySQL query for checking user name.
    $checkDupUserName = '
        SELECT u_id FROM qa_user WHERE ' . $db_attribute_name . ' = ?;
    ';

    // Prepare statement
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $checkDupUserName)) {
        die('Prepared statement error.');
    }

    // 1. bind parameters
    mysqli_stmt_bind_param($stmt, 's', $input);

    // 2. execute the query.
    mysqli_stmt_execute($stmt);

    // 3. bind result to variable $db_u_pwd
    mysqli_stmt_bind_result($stmt, $dup_u_name);

    // 4. execute query
    $haveDup = false;

    if (mysqli_stmt_fetch($stmt)) {
        $haveDup = true;
    }

    mysqli_stmt_close($stmt);

    return $haveDup;
}