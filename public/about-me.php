<!DOCTYPE html>
<html>

<head>
    <title>About Me</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/allPostsStyles.css">
    <link rel="stylesheet" href="./css/aboutMeStyles.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- JavaScript -->
    <script src="./js/handleEmptyForm.js"></script>

    <!-- PHP -->
    <?php
    include ('./php/config-db.php');
    include ('./php/utils/formatter.inc.php');
    include ('./php/components/question-card.php');
    session_start();
    ?>
</head>

<body>
    <header>
        <a href="all-posts.php">
            <img src="./images/Logo.png" class="login-signup-logo">
        </a>

        <!-- User Login Details -->
        <div class="user-login-details">
            <?php
            // Examine if there are any existing login data.
            if (!isset($_SESSION['u_id']) || !isset($_SESSION['u_name'])) {
                // Redirect to login page if there's no login data.
                header("Location: login.php");
                exit();
            }

            // Retrieve user data from session.
            $login_uid = $_SESSION["u_id"];
            $login_uname = $_SESSION["u_name"];

            $conn = initConnection($host, $username, $password, $dbname);

            $sql_get_user_details = '
                SELECT u_email
                FROM qa_user
                WHERE u_id = ?;
            ';

            $stmt_get_user_details = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt_get_user_details, $sql_get_user_details)) {
                echo '';
            }

            // bind variables, execute query, bind result to db_u_pwd_hash
            mysqli_stmt_bind_param($stmt_get_user_details, 's', $login_uid);
            mysqli_stmt_execute($stmt_get_user_details);
            mysqli_stmt_bind_result($stmt_get_user_details, $db_u_email);
            mysqli_stmt_fetch($stmt_get_user_details);

            ?>
        </div>
    </header>

    <!-- User Info -->
    <div class="user-info content-block">
        <?php
        echo '<h3>' . $login_uname . '</h3>';
        echo '<h4>' . $db_u_email . '</h4>';
        ?>

    </div>

    <!-- Subject Title -->
    <div class="subject-title-container">
        <h2>My Questions</h2>
    </div>

    <!-- User Questions -->
    <div class="question-grid">

        <?php
        $conn = initConnection($host, $username, $password, $dbname);
        $sql_user_posts = '
                    SELECT p_id, u_name, p_content, p_is_close, p_create_time FROM post, qa_user WHERE qa_user.u_id = post.u_id AND qa_user.u_id = ? ORDER BY p_create_time DESC;
                    ';

        $stmt_user_posts = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt_user_posts, $sql_user_posts)) {
            echo '';
        }

        mysqli_stmt_bind_param($stmt_user_posts, 'i', $login_uid);
        mysqli_stmt_execute($stmt_user_posts);
        mysqli_stmt_bind_result($stmt_user_posts, $db_pid, $db_p_uname, $db_p_content, $db_p_is_close, $db_p_create_time);
        while (mysqli_stmt_fetch($stmt_user_posts)) {
            renderQuestionCard($db_pid, $db_p_uname, $db_p_is_close, $db_p_create_time, $db_p_content);
        }

        ?>
    </div>
</body>

</html>