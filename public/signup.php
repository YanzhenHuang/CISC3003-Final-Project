<!DOCTYPE html>

<html>

<head>
    <title>Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div class="login-signin-panel">
        <h1>Sign Up</h1>
        <p>Ask whatever you want!</p>

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