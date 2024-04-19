<?php
include ('config-db.php');

// Get User Name and User Password
$u_name = $_POST['u_name'];
$u_pwd = $_POST['u_pwd'];

function checkDupUserName($conn, $u_name)
{
    // MySQL query for checking user name.
    $checkDupUserName = '
        SELECT u_id FROM qa_user WHERE u_name = ?;
    ';

    // Prepare statement
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $checkDupUserName)) {
        die('Prepared statement error.');
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 's', $u_name);

    // execute the query.
    mysqli_stmt_execute($stmt);

    // bind result to variable $db_u_pwd
    mysqli_stmt_bind_result($stmt, $dup_u_name);

    // Close the statement and connection
    $haveDupUserName = false;

    if (mysqli_stmt_fetch($stmt)) {
        $haveDupUserName = true;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $haveDupUserName;

}


/*
    --------- 1. Initialize db connection ---------
*/
$conn = mysqli_connect(hostname: $host, username: $username, password: $password, database: $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_errno());
}

// Check for user name duplicates
$haveDupUserName = checkDupUserName($conn, $u_name);
echo $haveDupUserName == true ? "User name already exists." : "User name is available.";