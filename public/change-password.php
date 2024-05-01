<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/loginSignupStyles.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- JavaScript -->
    <script src="./js/handleEmptyForm.js"></script>
    <script src="./js/pwdVisibilityToggle.js"></script>

    <!-- PHP -->
    <?php
    include ("./php/utils/cookie-session-settings.php");
    ?>

</head>

<body>
    <div class="login-signup-panel content-block">
        <h2>Change Password</h2>

        <!-- Password and Confirm doesn't match -->
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo '<p class="error-text-msg"> Password and confirm password doesn\'t match. </p>';
            unset($_SESSION['error']);
            session_destroy();
        }


        ?>

        <!-- User Submit Form-->
        <form action="./php/process-change-password.php" method="post">

            <!-- New: User Email -->
            <div class="label-and-text-input">
                <input type="text" class="non-empty email" id="u_email" name="u_email" placeholder="Email">
            </div>

            <!-- Password -->
            <div class="label-and-text-input password-field-container">
                <input type="password" class="non-empty" id="u_new_pwd" name="u_pwd" placeholder="New Password">
                <a class="password-visibility-toggle weak-link">Show</a>
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Change Password" class="btn" id="signup"></input>

        </form>
        <!-- To Login Page Button -->
        <button values="Sign Up" class="btn secondary" id="have-acc">Login</button>
    </div>
</body>

<script>
    // Empty Form
    handleEmptyForm('#signup');
    bindPasswordVisibilityToggles();

    // Switch to Sign up page.
    document.querySelector('#have-acc').addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = "login.php";
    });
</script>

</html>