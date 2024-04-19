<?php
include ('config-db.php');

// Get user ID and password
$uid = $_POST['uid'];
$u_pwd = $_POST['u_pwd'];

// 1. Initialize db connection
$conn = mysqli_connect(hostname: $host, username: $username, password: $password, database: $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_errno());
}

// 2. Initialize sql statement
$sql = '
    SELECT u_pwd FROM qa_user WHERE u_id = ' . $uid . ';
';

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('wrong');
}

// 3. Retrieve result from mysql

// execute the query.
mysqli_stmt_execute($stmt);

// bind result to variable $db_u_pwd
mysqli_stmt_bind_result($stmt, $db_u_pwd);

// fetch result

if (mysqli_stmt_fetch($stmt) && $db_u_pwd == $u_pwd) {
    echo "Password: " . $u_pwd . "<br>";
    echo "Login Success!!!";
} else {
    echo "Login Failed";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);