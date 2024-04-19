<!DOCTYPE html>

<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <h1>Login</h1>

    <!-- User Submit Form -->
    <form action="./php/process-login.php" method="post">

        <!-- User ID -->
        <div class="label-and-text-input">
            <lable for="uid">User ID:</lable>
            <input type="text" id="uid" name="uid">
        </div>

        <!-- Password -->
        <div class="label-and-text-input">
            <label for="u_pwd">User Password: </label>
            <input type="text" id="u_pwd" name="u_pwd">
        </div>

        <!-- Submit Button -->
        <input type="submit" value="Login" class="submit-btn"></input>
    </form>
</body>

</html>