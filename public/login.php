<!DOCTYPE html>

<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

</head>

<body>
    <img src="./images/Logo.png" class="login-signup-logo">
    <div class="login-signup-panel">
        <h1>Login</h1>
        <p>Ask whatever to whoever!</p>

        <!-- User Submit Form -->
        <form action="./php/process-login.php" method="post">

            <!-- User ID -->
            <div class="label-and-text-input">
                <input type="text" id="uname" name="u_name" placeholder="User Name">
            </div>

            <!-- Password -->
            <div class="label-and-text-input">
                <input type="password" id="u_pwd" name="u_pwd" placeholder="Password">
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Login" class="btn" id="login"></input>
        </form>
        <!-- To Login Page Button -->
        <button values="Sign Up" class="btn secondary" id="no-acc">No Account? Sign Up!</button>
    </div>
</body>

<script>
    let userNameField = document.querySelector('#uname');
    let passwordField = document.querySelector('#u_pwd');

    // Clear error styles of all inputs.
    function clearAllFieldError() {
        userNameField.classList.remove('error');
        passwordField.classList.remove('error');
    }

    document.querySelector('#login').addEventListener('click', (e) => {
        var u_name = userNameField.value;
        var u_pwd = passwordField.value;
        if (u_name == '') {
            e.preventDefault();
            userNameField.classList.add('error');
        }
        if (u_pwd == '') {
            e.preventDefault();
            passwordField.classList.add('error');
        }
    })

    userNameField.addEventListener('focus', (e) => {
        clearAllFieldError();
    })

    passwordField.addEventListener('focus', (e) => {
        clearAllFieldError();
    })

    document.querySelector('#no-acc').addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = "signup.php";
    });
</script>

</html>