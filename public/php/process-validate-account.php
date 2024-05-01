<?php
include ('config-db.php');
include ('./queries/validations.php');

session_start();

$validate_uid = $_SESSION['u_id'];
$inputToken = $_POST['input_token'];

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

// Validations
if (!mysqli_stmt_fetch($stmt_db_u_token_hash) || $inputToken_hash != $db_u_token_hash) {
    header("Location: ../validate-account.php");
    die();
}

mysqli_stmt_close($stmt_db_u_token_hash);
mysqli_close($conn);

$conn = initConnection($host, $username, $password, $dbname);

db_validateUser($conn);

header("Location: ../all-Posts.php");