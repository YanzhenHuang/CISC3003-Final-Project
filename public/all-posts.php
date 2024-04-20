<?php
include ('./php/config-db.php');

// Initialize db connection
$conn = initConnection($host, $username, $password, $dbname);

// Prepare statement
$sql_all_posts = '
    SELECT p_id, u_name, p_content, p_is_close, p_create_time FROM post, qa_user WHERE qa_user.u_id = post.u_id;
';

$stmt_all_posts = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_all_posts, $sql_all_posts)) {
    die('Prepared statement error.');
}

// Execute
mysqli_stmt_execute($stmt_all_posts);

// Bind result to variables
mysqli_stmt_bind_result($stmt_all_posts, $p_id, $u_name, $p_content, $p_is_closed, $p_create_time);

while (mysqli_stmt_fetch($stmt_all_posts)) {
    echo $p_id . ' ' . $u_name . ' ' . $p_content . '<br>';
}