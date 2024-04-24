<?php
include('config-db.php');

// Retrieve form data
$uid = $_POST['uid'];
$pid = $_POST['pid'];
$r_content = $_POST['r_content'];

// Initialize db connection
$conn = initConnection($host, $username, $password, $dbname);

// Prepare statement
$sql = 'INSERT INTO reply (p_id, u_id, r_content) VALUES (?, ?, ?)';

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('Prepared statement error.');
}

// Bind params
mysqli_stmt_bind_param($stmt, 'iis', $pid, $uid, $r_content);

// Execute
mysqli_stmt_execute($stmt);

// Demonstrate
echo '<br>';
echo 'Reply posted.';

header("Location: ../post-details.php?post_id=" . $pid);

mysqli_stmt_close($stmt);
mysqli_close($conn);


