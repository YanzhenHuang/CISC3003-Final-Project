<?php
include ('config-db.php');

$del_rid = $_POST['r_id'];

$conn = initConnection($host, $username, $password, $dbname);

$sql_del_reply_by_rid = '
    DELETE FROM reply WHERE r_id = ?;
';

$stmt_del_reply_by_rid = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_del_reply_by_rid, $sql_del_reply_by_rid)) {
    die('Prepared statement error.');
}

mysqli_stmt_bind_param($stmt_del_reply_by_rid, 'i', $del_rid);
mysqli_stmt_execute($stmt_del_reply_by_rid);

mysqli_stmt_close($stmt_del_reply_by_rid);
mysqli_close($conn);