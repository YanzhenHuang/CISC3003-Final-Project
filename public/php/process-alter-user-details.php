<?php
include ('config-db.php');
include ('./utils/generate-token.php');
include ('./utils/send-email.php');
include ('./utils/check-duplicates.php');
include ('./utils/cookie-session-settings.php');
include ('./queries/validations.php');

session_start();
if (!isset($_SESSION['u_id'])) {
    header('Location: ../login.php');
}

$login_uid = $_SESSION['u_id'];

// Token is inputted for validation
if (isset($_POST['input_token'])) {
    // Get user token hash
    $conn = initConnection($host, $username, $password, $dbname);
    $inputToken = $_POST['input_token'];
    $sql_get_user_token = 'SELECT u_token FROM qa_user WHERE u_id = ?';
    $stmt_get_user_token = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt_get_user_token, $sql_get_user_token)) {
        die('Prepared statement error.');
    }
    mysqli_stmt_bind_param($stmt_get_user_token, 'i', $login_uid);
    mysqli_stmt_execute($stmt_get_user_token);
    mysqli_stmt_bind_result($stmt_get_user_token, $db_u_token_hash);
    if (!mysqli_stmt_fetch($stmt_get_user_token)) {
        header('Location: ../all-posts.php');
        die('No tokens found.');
    }
    mysqli_stmt_close($stmt_get_user_token);
    mysqli_close($conn);

    // Check if match
    $conn = initConnection($host, $username, $password, $dbname);
    if (hash('sha256', $inputToken) != $db_u_token_hash) {
        header('Location: ../all-posts.php');
        die();
    }

    // Pre-process
    $noDupUserName = $_SESSION['new_u_name'] != null ? $_SESSION['new_u_name'] : $_SESSION['origin_u_name'];
    $noDupEmail = $_SESSION['new_u_email'] != null ? $_SESSION['new_u_email'] : $_SESSION['origin_u_email'];
    removeSessions(["new_u_name", "new_u_email", "origin_u_email", "origin_u_email"]);

    // Send 
    $sql_alter_user_details = 'UPDATE qa_user SET u_name = ? , u_email = ? WHERE u_id = ?;';
    $stmt_alter_user_details = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt_alter_user_details, $sql_alter_user_details)) {
        // header('Location: ../about-me.php');
    }

    mysqli_stmt_bind_param($stmt_alter_user_details, 'ssi', $noDupUserName, $noDupEmail, $login_uid);
    mysqli_stmt_execute($stmt_alter_user_details);
    mysqli_stmt_close($stmt_alter_user_details);
    mysqli_close($conn);

    // Update original session
    $_SESSION['u_name'] = $noDupUserName;

    $conn = initConnection($host, $username, $password, $dbname);
    db_validateUser($conn, $login_uid, false);

    header('Location: ../login.php');
    die();
}

$origin_u_name = $_POST['origin_u_name'];
$origin_u_email = $_POST['origin_u_email'];
$new_u_name = $_POST['new_u_name'];
$new_u_email = $_POST['new_u_email'];

// Check for duplicates
$conn = initConnection($host, $username, $password, $dbname);
$haveDupUserName = checkDuplicates($conn, 'u_name', 'qa_user', $new_u_name);
$haveDupUserEmail = checkDuplicates($conn, 'u_email', 'qa_user', $new_u_email);
mysqli_close($conn);

// If both user name and email are duplicated, then abort.
if ($haveDupUserEmail && $haveDupUserName) {
    $_SESSION['CHANGE_ERR'] = 'Both user name and email are occpuied.';
    header('Location: ../about-me.php');
    die();
}

// Either user name or email is duplicated, or none of them are duplicated.
$conn = initConnection($host, $username, $password, $dbname);

// Generate a new token.
$newTokenSet = updateToken($conn, $login_uid, $new_u_email, $new_u_name);
sendEmail($origin_u_email, "Change user name or email", "Validate your email: " . $newTokenSet->plain);

// Wait for user to enter the token
$_SESSION['origin_u_name'] = $origin_u_name;
$_SESSION['origin_u_email'] = $origin_u_email;

$_SESSION['new_u_name'] = !$haveDupUserName ? $new_u_name : null;
$_SESSION['new_u_email'] = !$haveDupUserEmail ? $new_u_email : null;

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
        <h2>Validate Change User Info</h2>
        <form action="./process-alter-user-details.php" method="POST">
            <!-- <input type="text" name="input_token"></input> -->

            <div class="label-and-text-input password-field-container">
                <input type="text" class="non-empty" id="input_token" name="input_token" placeholder="Token">
            </div>

            <input type="submit" value="Validate" class="btn" id="login"></input>
        </form>
    </div>
</body>

</html>