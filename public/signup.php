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
</head>

<body>
    <!-- Logo with Background -->
    <div class="logo-container">
        <img src="./images/Logo.png" class="login-signup-logo">
    </div>

    <div class="login-signup-panel">
        <h1>Sign Up</h1>
        <p>Ask whatever to whoever!</p>

        <!-- User Submit Form-->
        <form action="./php/process-signup.php" method="post">
            <!-- User Name -->
            <div class="label-and-text-input">
                <input type="text" id="u_name" name="u_name" placeholder="User Name">
            </div>

            <!-- Password -->
            <div class="label-and-text-input">
                <input type="text" id="u_pwd" name="u_pwd" placeholder="Password">
            </div>

            <!-- Confirm Password -->
            <div class="label-and-text-input">
                <input type="text" id="u_confirm_pwd" placeholder="Confirm Password">
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Sign Up" class="btn"></input>

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

</html>