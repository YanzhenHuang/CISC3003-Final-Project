<!DOCTYPE html>

<html>

<head>
    <title>Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <form action="./php/process-signup.php" method="post">
        <lable for="u_name">User Name:</lable>
        <input type="text" id="u_name" name="u_name">

        <label for="u_pwd">Password: </label>
        <input type="text" id="u_pwd" name="u_pwd">

        <input type="submit" value="Sign Up"></input>
    </form>
</body>

</html>