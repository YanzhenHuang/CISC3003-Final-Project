<?php
include ('config-db.php');
include ('./utils/send-email.php');
include ('./utils/generate-token.php');
include ('./queries/validations.php');
include ("./utils/cookie-session-settings.php");

session_start();

// If there is a token, then simply verifies it.
if (isset($_POST['input_token']) && isset($_SESSION['change_pwd_uid']) && isset($_SESSION['u_new_pwd'])) {
    $conn = initConnection($host, $username, $password, $dbname);
    $inputToken = $_POST['input_token'];
    $u_id = $_SESSION['change_pwd_uid'];
    $new_pwd = $_SESSION['u_new_pwd'];

    // Get user token hash
    $sql_get_user_token = 'SELECT u_token FROM qa_user WHERE u_id = ?;';
    $stmt_get_user_token = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt_get_user_token, $sql_get_user_token)) {
        die('wrong');
    }
    mysqli_stmt_bind_param($stmt_get_user_token, 'i', $u_id);
    mysqli_stmt_execute($stmt_get_user_token);
    mysqli_stmt_bind_result($stmt_get_user_token, $db_u_token_hash);
    if (!mysqli_stmt_fetch($stmt_get_user_token)) {
        $_SESSION['error'] = 'USR_NONEX';
        header('Location: ../login.php');
        die('User not exist.');
    }

    // Check if match
    if (hash('sha256', $inputToken) != $db_u_token_hash) {
        $_SESSION['error'] = 'CONFIRM_ERR';
        header('Location: ../login.php');
        die('User name and password don\'t match.');
    }

    $sql_update_pwd = 'UPDATE qa_user SET u_pwd = ? WHERE u_id = ?;';

    mysqli_stmt_close($stmt_get_user_token);
    mysqli_close($conn);

    $conn = initConnection($host, $username, $password, $dbname);

    $stmt_update_pwd = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt_update_pwd, $sql_update_pwd)) {
        die('Preparation error');
    }

    $new_pwd_hash = hash('sha256', $new_pwd);
    mysqli_stmt_bind_param($stmt_update_pwd, 'si', $new_pwd_hash, $u_id);
    mysqli_stmt_execute($stmt_update_pwd);

    removeSessions(['change_pwd_uid', 'u_new_pwd']);

    mysqli_stmt_close($stmt_update_pwd);
    mysqli_close($conn);
    header('Location: ../login.php');
    die();
}


// There is no token, so it must be a request to change password.
// Receive user email and new password
$conn = initConnection($host, $username, $password, $dbname);
$u_email = $_POST['u_email'];
$new_pwd = $_POST['u_new_pwd'];

// Get original user info
$sql_get_user_info = 'SELECT u_id, u_name, u_pwd, u_valid, u_change_valid, u_token FROM qa_user WHERE u_email = ?;';
$stmt_get_user_info = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_get_user_info, $sql_get_user_info)) {
    die('Prepared statement error.');
}
mysqli_stmt_bind_param($stmt_get_user_info, 's', $u_email);
mysqli_stmt_execute($stmt_get_user_info);
mysqli_stmt_bind_result($stmt_get_user_info, $u_id, $u_name, $u_pwd, $u_valid, $u_change_valid, $u_token);

// User doesn't exist
if (!mysqli_stmt_fetch($stmt_get_user_info)) {
    $_SESSION['error'] = 'USR_NONEX';
    header('Location: ../login.php');
    die('User not exist.');
}
mysqli_stmt_close($stmt_get_user_info);
mysqli_close($conn);


// User Exists, generate a new token for the user.
$conn = initConnection($host, $username, $password, $dbname);

$newTokenSet = updateToken($conn, $u_id, $u_email, $u_name);
sendEmail($u_email, "Change Password", "Your new validation token is:" . $newTokenSet->plain);

// wait for user to enter the token.
$_SESSION['change_pwd_uid'] = $u_id;
$_SESSION['u_new_pwd'] = $new_pwd;
// mysqli_stmt_close($stmt_updateToken);
// mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Validate Change Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/loginSignupStyles.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- JavaScript -->
    <script src="../js/handleEmptyForm.js"></script>
    <script src="../js/pwdVisibilityToggle.js"></script>

</head>

<body>

    <!-- Logo with Background -->
    <div class="logo-container">
        <img src="../images/Logo.png" class="login-signup-logo">
    </div>

    <div class="login-signup-panel content-block">
        <h2>Validate Change Password</h2>
        <form action="./process-change-password.php" method="POST">
            <!-- <input type="text" name="input_token"></input> -->

            <div class="label-and-text-input password-field-container">
                <input type="text" class="non-empty" id="input_token" name="input_token" placeholder="Token">
            </div>

            <input type="submit" value="Validate" class="btn" id="login"></input>
        </form>
    </div>
</body>

</html>