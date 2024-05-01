<!DOCTYPE html>
<html lang="en">

<head>
    <title>Validate Account</title>
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

    <!-- Logo with Background -->
    <div class="logo-container">
        <img src="./images/Logo.png" class="login-signup-logo">
    </div>

    <div class="login-signup-panel content-block">
        <h2>Validate Account</h2>
        <form action="./php/process-validate-account.php" method="POST">
            <!-- <input type="text" name="input_token"></input> -->

            <div class="label-and-text-input password-field-container">
                <input type="text" class="non-empty" id="input_token" name="input_token" placeholder="Token">
            </div>

            <input type="submit" value="Validate" class="btn" id="login"></type>
        </form>
    </div>
</body>

</html>