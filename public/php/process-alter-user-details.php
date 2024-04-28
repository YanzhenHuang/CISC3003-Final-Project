<?php
include ('config-db.php');
include ('./utils/check-duplicates.php');

session_start();
$login_uid = $_SESSION['u_id'];

$origin_u_name = $_POST['origin_u_name'];
$origin_u_email = $_POST['origin_u_email'];
$new_u_name = $_POST['new_u_name'];
$new_u_email = $_POST['new_u_email'];

$conn = initConnection($host, $username, $password, $dbname);

// Check for duplicates
$haveDupUserName = checkDuplicates($conn, 'u_name', 'qa_user', $new_u_name);
$haveDupUserEmail = checkDuplicates($conn, 'u_email', 'qa_user', $new_u_email);

// If user name exists, then abort
$no_dup_u_name = $origin_u_name;
$no_dup_u_email = $origin_u_email;

// If both user name and email are duplicated, then abort.
if ($haveDupUserEmail && $haveDupUserName) {
    $_SESSION['CHANGE_ERR'] = 'Both user name and email are occpuied.';
    header('Location: ../about-me.php');
    die();
}

if (!$haveDupUserName) {
    $_SESSION['u_name'] = $new_u_name;
    $no_dup_u_name = $new_u_name;
} else {
    $_SESSION['CHANGE_ERR'] = 'User name is occpuied.';
}

if (!$haveDupUserEmail) {
    $_SESSION['u_email'] = $new_u_email;
    $no_dup_u_email = $new_u_email;
} else {
    $_SESSION['CHANGE_ERR'] = 'Email is occpuied.';
}

// Send 
$sql_alter_user_details = '
    UPDATE qa_user 
    SET u_name = ? , u_email = ?
    WHERE u_id = ?;
';

$stmt_alter_user_details = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_alter_user_details, $sql_alter_user_details)) {
    header('Location: ../about-me.php');
}

mysqli_stmt_bind_param($stmt_alter_user_details, 'ssi', $no_dup_u_name, $no_dup_u_email, $login_uid);
mysqli_stmt_execute($stmt_alter_user_details);
mysqli_stmt_close($stmt_alter_user_details);

header('Location: ../about-me.php');