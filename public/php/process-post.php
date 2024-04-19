<?php
include ('config-db.php');

$uid = $_POST['uid'];
$p_content = $_POST['p_content'];


// Initialize db connection
$conn = initConnection($host, $username, $password, $dbname);

// Prepare statement
$sql = '
    INSERT INTO post (u_id, p_content) VALUES (?, ?);
';

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('Prepared statement error.');
}

// Bind params
mysqli_stmt_bind_param($stmt, 'is', $uid, $p_content);

// Execute
mysqli_stmt_execute($stmt);

// Demonstrate
echo '<br>';
echo 'Question posted.';

mysqli_stmt_close($stmt);
mysqli_close($conn);