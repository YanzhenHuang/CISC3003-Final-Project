<!DOCTYPE html>

<html>

<head>
    <title>Login</title>
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

    <!-- Remove Sessions -->
    <?php
    $sessionItems = ["u_id", "u_name"];
    removeSessions($sessionItems);
    ?>

    <!-- Intro Animation Overlay -->
    <div class="overlay" id="overlay">
        <h1 class="intro-text" onclick="enterSite()">Campus Q&A</h1>
    </div>

    <!-- Hidden before animation -->
    <div class="hidden-at-start">

        <!-- Logo with Background -->
        <div class="logo-container">
            <img src="./images/Logo.png" class="login-signup-logo">
        </div>


        <div class="login-signup-panel content-block">
            <h1>Login</h1>
            <p>Ask whatever to whoever!</p>

            <!-- User Submit Form -->
            <form action="./php/process-login.php" method="post">

                <!-- User ID -->
                <div class="label-and-text-input">
                    <input type="text" class="non-empty" id="uname" name="u_name" placeholder="User Name">
                </div>

                <!-- Password -->
                <div class="label-and-text-input password-field-container">
                    <input type="password" class="non-empty" id="u_pwd" name="u_pwd" placeholder="Password">
                    <a class="password-visibility-toggle weak-link">Show</a>
                </div>

                <!-- Forgot Password -->
                <div class="form-link">
                    <a href="./change-password.php" class="weak-link">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <input type="submit" value="Login" class="btn" id="login"></input>
            </form>
            <!-- To Login Page Button -->
            <button values="Sign Up" class="btn secondary" id="no-acc">No Account? Sign Up!</button>
        </div>
    </div>
</body>

<script>
    function enterSite() {
        var overlay = document.getElementById('overlay');
        overlay.style.display = 'none';


        var hiddenElements = document.querySelectorAll('.hidden-at-start');
        hiddenElements.forEach(function (element) {
            element.classList.add('visible');
        });
    }
</script>

<script>
    handleEmptyForm('#login');
    bindPasswordVisibilityToggles();

    // Switch to Sign up page.
    document.querySelector('#no-acc').addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = "signup.php";
    });
</script>

</html>