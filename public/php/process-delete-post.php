<?php
include ('config-db.php');

$del_pid = $_POST['p_id'];

$conn = initConnection($host, $username, $password, $dbname);

$sql_delete_post_by_pid = '
    DELETE FROM post WHERE p_id = ?;
';

$stmt_delete_post_by_pid = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt_delete_post_by_pid, $sql_delete_post_by_pid)) {
    die('Prepared statement error.');
}

mysqli_stmt_bind_param($stmt_delete_post_by_pid, 'i', $del_pid);
mysqli_stmt_execute($stmt_delete_post_by_pid);

// header('Location: ../all-posts.php');

mysqli_stmt_close($stmt_get_reply_by_p_id);
mysqli_close($conn);