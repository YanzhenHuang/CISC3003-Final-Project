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
    SELECT u_id, u_pwd FROM qa_user WHERE u_name = ?;
';

$stmt_login = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_login, $sql_login)) {
    die('wrong');
}

// bind variables
mysqli_stmt_bind_param($stmt_login, 's', $u_name);

// execute the query.
mysqli_stmt_execute($stmt_login);

// bind result to variable $db_u_pwd
mysqli_stmt_bind_result($stmt_login, $db_u_id, $db_u_pwd_hash);

// fetch result
if (mysqli_stmt_fetch($stmt_login) && $db_u_pwd_hash == $u_pwd_hash) {
    echo "Password: " . $u_pwd . "<br>";
    echo "Login Success!!!";

    // Set a cookie that expires in 30 days
    setcookie("u_id", $db_u_id, time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("u_name", $u_name, time() + (86400 * 30), "/");

    header("Location: ../all-posts.php");
} else {
    echo "Login Failed <br>";
    echo "Password Inputted: " . $u_pwd . "<br>";
    echo "Password Hash: " . $u_pwd_hash . "<br>";
    echo "Password Hash from DB: " . $db_u_pwd_hash . "<br>";

    // Login Failed, password doesn't match.
    header("Location: ../login.php");
}

mysqli_stmt_close($stmt_login);
mysqli_close($conn);