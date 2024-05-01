<?php
include ('config-db.php');
include ('./queries/validations.php');

session_start();

$validate_uid = $_SESSION['u_id'];
$inputToken = $_POST['input_token'];

// Get hashed token from db
$conn = initConnection($host, $username, $password, $dbname);
$sql_db_u_token_hash = '
    SELECT u_token FROM qa_user WHERE u_id = ?;
';

$stmt_db_u_token_hash = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_db_u_token_hash, $sql_db_u_token_hash)) {
    die('wrong');
}

mysqli_stmt_bind_param($stmt_db_u_token_hash, 'i', $validate_uid);
mysqli_stmt_execute($stmt_db_u_token_hash);
mysqli_stmt_bind_result($stmt_db_u_token_hash, $db_u_token_hash);

$inputToken_hash = hash('sha256', $inputToken);

// Validation

// No user token or doesn't match
if (!mysqli_stmt_fetch($stmt_db_u_token_hash) || $inputToken_hash != $db_u_token_hash) {
    header("Location: ../validate-account.php");
    die();
}

// Matches
mysqli_stmt_close($stmt_db_u_token_hash);
mysqli_close($conn);

// Set user valid
$conn = initConnection($host, $username, $password, $dbname);
db_validateUser($conn, $validate_uid);

// Redirect
header("Location: ../all-Posts.php");