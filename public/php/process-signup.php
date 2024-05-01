<?php
include ('config-db.php');
include ('./utils/check-duplicates.php');
include ('./utils/send-email.php');
include ('./utils/generate-token.php');

// Get User Name and User Password
$u_name = $_POST['u_name'];
$u_email = $_POST['u_email'];
$u_pwd = $_POST['u_pwd'];
$u_confirm_pwd = $_POST['u_confirm_pwd'];


// Check if password confirmation is correct
if ($u_pwd != $u_confirm_pwd) {
    session_start();
    $_SESSION['error'] = "CONFIRM_ERR";
    header('Location: ../signup.php');
    die();
}

/*
    --------- 1. Initialize db connection ---------
*/
$conn = initConnection($host, $username, $password, $dbname);

// 1.1 Check for user name duplicates
$haveDupUserName = checkDuplicates($conn, 'u_name', 'qa_user', $u_name);
$haveDupUserEmail = checkDuplicates($conn, 'u_email', 'qa_user', $u_email);
echo ($haveDupUserName || $haveDupUserEmail) == true ? "User name or email already exists." : "User name is available.";

// If user name exists, then abort
if ($haveDupUserName || $haveDupUserEmail == true) {
    die();
}

// 1.3 Hashing password
$u_pwd_hash = hash('sha256', $u_pwd);

// User token for email validation
$tokenSet = generateToken($u_email, $u_name);

// 2.1 Prepare Statement
$sql_signup = '
    INSERT INTO qa_user (u_name, u_email, u_pwd, u_valid, u_token) VALUES (?, ?, ?, 0, ?);
';

$stmt_signup = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_signup, $sql_signup)) {
    die('Prepared statement error.');
}

// 2.2 Bind parameters
mysqli_stmt_bind_param($stmt_signup, 'ssss', $u_name, $u_email, $u_pwd_hash, $tokenSet->hashed);

// 2.3 execute the query
mysqli_stmt_execute($stmt_signup);

sendEmail($u_email, "Sign Up Notice", "Your validation token is:" . $tokenSet->plain);

echo '<br>';
echo 'Sign Up Successful.';

header('Location: ../login.php');

mysqli_stmt_close($stmt_signup);
mysqli_close($conn);