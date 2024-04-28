<?php
include ('config-db.php');

$toggle_p_id = $_POST['p_id'];
$target_p_is_close = $_POST['p_is_close'];

$conn = initConnection($host, $username, $password, $dbname);

$sql_toggle_post_status = '
    UPDATE post
    SET p_is_close = ?
    WHERE p_id = ?;
';

$stmt_toggle_post_status = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_toggle_post_status, $sql_toggle_post_status)) {
    die('Unable to init statement.');
}

mysqli_stmt_bind_param($stmt_toggle_post_status, 'ii', $target_p_is_close, $toggle_p_id);
mysqli_stmt_execute($stmt_toggle_post_status);

header("Location: ../post.php?p_id=$toggle_p_id");