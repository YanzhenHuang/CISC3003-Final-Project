<!DOCTYPE html>

<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <form action="./php/process-login.php" method="post">
        <lable for="uid">User ID:</lable>
        <input type="text" id="uid" name="uid">
        <input type="text" id="u_pwd" name="u_pwd">
        <input type="submit" value="Login"></input>
    </form>
</body>

</html>