<!DOCTYPE html>

<html>

<head>
    <title>Sign Up</title>
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
</head>

<body>
    <!-- Logo with Background -->
    <div class="logo-container">
        <img src="./images/Logo.png" class="login-signup-logo">
    </div>

    <div class="login-signup-panel content-block">
        <h1>Sign Up</h1>
        <p>Ask whatever to whoever!</p>

        <!-- Error Hint Text -->
        <?php
        session_start();

        function renderErrText($msg)
        {
            echo '<p class="error-text-msg">' . $msg . ' </p>';
        }

        (function () {
            if (!isset ($_SESSION['error'])) {
                return;
            }

            if ($_SESSION['error'] == "CONFIRM_ERR") {
                renderErrText("Password and Confirm Password doesn't match.");
            } else if ($_SESSION['error'] == "DUP_ERR") {
                renderErrText("User name or email already exists.");
            }

            unset ($_SESSION['error']);
            session_destroy();

        })();
        ?>

        <!-- User Submit Form-->
        <form action="./php/process-signup.php" method="post">
            <!-- User Name -->
            <div class="label-and-text-input">
                <input type="text" class="non-empty user-name" id="u_name" name="u_name" placeholder="User Name">
            </div>

            <!-- New: User Email -->
            <div class="label-and-text-input">
                <input type="text" class="non-empty email" id="u_email" name="u_email" placeholder="Email">
            </div>

            <!-- Password -->
            <div class="label-and-text-input password-field-container">
                <input type="password" class="non-empty" id="u_pwd" name="u_pwd" placeholder="Password">
                <a class="password-visibility-toggle weak-link">Show</a>
            </div>

            <!-- Confirm Password -->
            <div class="label-and-text-input password-field-container">
                <input type="password" class="non-empty" id="u_confirm_pwd" name="u_confirm_pwd"
                    placeholder="Confirm Password">
                <a class="password-visibility-toggle weak-link">Show</a>
            </div>

            <!-- Accept protocol -->
            <div class="form-tac">
                <input type="checkbox" class="non-empty" id="u_agree_tc" name="u_agree_tc" value="1" />
                I Accept the user <a href="https://www.google.com" class="weak-link">Terms & Conditions </a>
                </input>
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Sign Up" class="btn" id="signup"></input>

        </form>
        <!-- To Login Page Button -->
        <button values="Sign Up" class="btn secondary" id="have-acc">Have an account? Login!</button>
    </div>

</body>
<script>
    document.querySelector('#have-acc').addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = "login.php";
    });
</script>

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