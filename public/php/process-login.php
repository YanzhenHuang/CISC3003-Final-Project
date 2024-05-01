<?php
include ('config-db.php');
include ('./utils/send-email.php');

// Get user ID and password
$u_name = $_POST['u_name'];
$u_pwd = $_POST['u_pwd'];

// Initialize Connection.
$conn = initConnection($host, $username, $password, $dbname);

// Hashing user input password for validation.
$u_pwd_hash = hash("sha256", $u_pwd);


// Prepare SQL statement
$sql_login = '
    SELECT u_id, u_pwd, u_email, u_valid FROM qa_user WHERE u_name = ?;
';

$stmt_login = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_login, $sql_login)) {
    die('wrong');
}

// bind variables, execute query, bind result to db_u_pwd_hash
mysqli_stmt_bind_param($stmt_login, 's', $u_name);
mysqli_stmt_execute($stmt_login);
mysqli_stmt_bind_result($stmt_login, $db_u_id, $db_u_pwd_hash, $db_u_email, $db_u_valid);

// fetch result
if (mysqli_stmt_fetch($stmt_login) && $db_u_pwd_hash == $u_pwd_hash) {
    // Password Matches, but user not validated.
    if ($db_u_valid == 0) {
        // Re-direct to user
        header("Location: ../validate-account.php");
        die();
    }

    // Login Success
    session_start();
    $_SESSION["u_id"] = $db_u_id;
    $_SESSION["u_name"] = $u_name;

    sendEmail($db_u_email, "Login Notice", "You have a login record.");

    header("Location: ../all-posts.php");
} else {
    // Login Failed, password doesn't match.
    header("Location: ../login.php");
}


mysqli_stmt_close($stmt_login);
mysqli_close($conn);