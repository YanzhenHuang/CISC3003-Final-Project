<!DOCTYPE html>

<html>

<head>
    <title>Post Question</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <h1>Post Question</h1>

    <!-- User Submit Form -->
    <form action="./php/process-post.php" method="post">

        <!-- User ID -->
        <div class="label-and-text-input">
            <lable for="uid">User ID:</lable>
            <input type="text" id="uid" name="uid">
        </div>

        <!-- Question Content -->
        <div class="label-and-text-input">
            <label for="p_content">Content:</label>
            <textarea type="text" id="p_content" name="p_content"></textarea>
        </div>

        <!-- Submit Button -->
        <input type="submit" value="Login" class="submit-btn"></input>
    </form>
</body>

</html>