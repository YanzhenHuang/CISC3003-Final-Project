<?php
include ('config-db.php');

// Get user ID and password
$u_name = $_POST['u_name'];
$u_pwd = $_POST['u_pwd'];

// Initialize Connection.
$conn = initConnection($host, $username, $password, $dbname);

// Hashing user input password for validation.
$u_pwd_hash = hash("sha256", $u_pwd);


// Prepare SQL statement
$sql_login = '
    SELECT u_id, u_pwd, u_email FROM qa_user WHERE u_name = ?;
';

$stmt_login = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_login, $sql_login)) {
    die('wrong');
}

// bind variables, execute query, bind result to db_u_pwd_hash
mysqli_stmt_bind_param($stmt_login, 's', $u_name);
mysqli_stmt_execute($stmt_login);
mysqli_stmt_bind_result($stmt_login, $db_u_id, $db_u_pwd_hash, $db_u_email);

// fetch result
if (mysqli_stmt_fetch($stmt_login) && $db_u_pwd_hash == $u_pwd_hash) {
    // Login Success
    session_start();
    $_SESSION["u_id"] = $db_u_id;
    $_SESSION["u_name"] = $u_name;

    // // Send an email to notify the user
    // // Set SMTP server and port using ini_set()
    // ini_set("SMTP", "smtp.163.com");
    // ini_set("smtp_port", "25");
    // ini_set("sendmail_from", "huangyanzhen0108@163.com");
    // ini_set("auth_password", "HCHYGPIQCUGEXCIY");

    // $email_receiver = $db_u_email;
    // $email_subject = "Recent Login";
    // $email_message = "You have a recent login!";
    // $email_headers = 'From: huangyanzhen0108@163.com' . "\r\n";

    // try {
    //     mail($email_receiver, $email_subject, $email_message, $email_headers);
    // } catch (Exception $e) {
    //     echo "<script>console.log('Mail Error " . $e . ".');</script>";
    // }

    header("Location: ../all-posts.php");
} else {
    // Login Failed, password doesn't match.
    header("Location: ../login.php");
}


mysqli_stmt_close($stmt_login);
mysqli_close($conn);