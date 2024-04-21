<!DOCTYPE html>
<html>

<head>
    <title>All Posts</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Styles -->
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/allPostsStyles.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <img src="./images/Logo.png" class="login-signup-logo">
    </header>

    <!-- Current User -->
    <?php
    session_start();

    if (!isset($_SESSION['u_id']) || !isset($_SESSION['u_name'])) {
        // Redirect user if session variables are not set
        header("Location: login.php");
        exit();
    }

    $login_uid = $_SESSION['u_id'];
    $login_uname = $_SESSION['u_name'];

    echo 'User Name: ' . $login_uname . '  ';
    echo 'User ID: ' . $login_uid;
    ?>

    <!-- Question GridView -->
    <div class="question-grid">
        <?php
        include ('./php/config-db.php');

        function getDisplayTimeString($dateTimeStr)
        {
            // dateTimeStr format: 2024-04-20 00:49:09
            $postDateTime = new DateTime($dateTimeStr);
            $curDateTime = new DateTime();

            $interval = $curDateTime->diff($postDateTime);

            $displayTimeString = "";
            if ($interval->y > 0) {
                $displayTimeString = $interval->y . ' y ago';
            } else if ($interval->m > 0) {
                $displayTimeString = $interval->m . ' mo ago';
            } else if ($interval->d > 0) {
                $displayTimeString = $interval->d . ' d ago';
            } else {
                $displayTimeString = $postDateTime->format('H:i');
            }

            return $displayTimeString;
        }

        // Initialize db connection
        $conn = initConnection($host, $username, $password, $dbname);

        // Prepare statement
        $sql_all_posts = '
    SELECT p_id, u_name, p_content, p_is_close, p_create_time FROM post, qa_user WHERE qa_user.u_id = post.u_id ORDER BY p_create_time DESC;';

        $stmt_all_posts = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt_all_posts, $sql_all_posts)) {
            die('Prepared statement error.');
        }

        // Execute
        mysqli_stmt_execute($stmt_all_posts);

        // Bind result to variables
        mysqli_stmt_bind_result($stmt_all_posts, $p_id, $u_name, $p_content, $p_is_closed, $p_create_time);

        while (mysqli_stmt_fetch($stmt_all_posts)) {
            // Format display time
            $p_create_time = getDisplayTimeString($p_create_time);

            echo '<a href="./post-details.php?post_id=' . $p_id . '">';

            echo '<div class="question-card content-block" id="p_id-' . $p_id . '">';
            echo '<div class="card-title"><p class="user-name">' . $u_name . '</p> <p class="create-time">' . $p_create_time . '</p></div>';
            echo '<p class="content">' . $p_content . '</p>';
            echo '</div>';

            echo '</a>';
            // echo $p_id . '  ' . $u_name . '  ' . $p_content . '  ' . $p_create_time . '<br>';
        } ?>

    </div>
</body>

</html>