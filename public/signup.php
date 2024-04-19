<!DOCTYPE html>

<html>

<head>
    <title>Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="login-signin-panel">
        <h1>Sign Up</h1>

        <!-- User Submit Form-->
        <form action="./php/process-signup.php" method="post">
            <!-- User Name -->
            <div class="label-and-text-input">
                <lable for="u_name">User Name:</lable>
                <input type="text" id="u_name" name="u_name">
            </div>

            <!-- Password -->
            <div class="label-and-text-input">
                <label for="u_pwd">Password: </label>
                <input type="text" id="u_pwd" name="u_pwd">
            </div>

            <!-- Confirm Password -->
            <div class="label-and-text-input">
                <label for="u_pwd">Password: </label>
                <input type="text" id="u_pwd" name="u_pwd">
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Sign Up"></input>
        </form>
    </div>

</body>

</html>