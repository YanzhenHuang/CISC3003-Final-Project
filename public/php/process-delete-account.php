<?php
include ('config-db.php');
include ('./utils/cookie-session-settings.php');

session_start();

if (!isset($_SESSION['u_id'])) {
    die();
}

$del_uid = $_SESSION['u_id'];

// Init db connction
$conn = initConnection($host, $username, $password, $dbname);
$stmt = mysqli_stmt_init($conn);

// Specify statements
$del_query = 'DELETE FROM qa_user WHERE u_id= ?;';

if (!mysqli_stmt_prepare($stmt, $del_query)) {
    die('Prepared statement error.');
}

// Bind parameters and execute.
mysqli_stmt_bind_param($stmt, 'i', $del_uid);
mysqli_stmt_execute($stmt);

if (mysqli_affected_rows($conn) > 0) {
    // Delete user successfully
    session_destroy();
    header("Location: ../login.php");
    exit();
} else {
    // Delete user failed
    header("Location: ../all-posts.php");
}