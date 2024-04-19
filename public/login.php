<!DOCTYPE html>

<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div class="login-signin-panel">
        <h1>Login</h1>
        <p>Ask whatever you want!</p>

        <!-- User Submit Form -->
        <form action="./php/process-login.php" method="post">

            <!-- User ID -->
            <div class="label-and-text-input">
                <input type="text" id="uid" name="uid" placeholder="User ID">
            </div>

            <!-- Password -->
            <div class="label-and-text-input">
                <input type="password" id="u_pwd" name="u_pwd" placeholder="Password">
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Login" class="btn"></input>
        </form>
        <!-- To Login Page Button -->
        <button values="Sign Up" class="btn secondary" id="no-acc">No Account? Sign Up!</button>
    </div>
</body>

<script>
    document.querySelector('#no-acc').addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = "signup.php";
    });
</script>

</html>