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
    include ('./php/components/button.php');
    session_start();

    // Examine if there are any existing login data.
    if (!isset($_SESSION['u_id']) || !isset($_SESSION['u_name'])) {
        // Redirect to login page if there's no login data.
        header("Location: login.php");
        exit();
    }

    // Retrieve user data from session.
    $login_uid = $_SESSION["u_id"];
    $login_uname = $_SESSION["u_name"];

    /**
     * Get number of rows.
     * @param $conn Connection to the database.
     * @param $tableName Table name.
     * @param $login_uid User ID in the session.
     */
    function getNumOfRows($conn, $tableName, $login_uid)
    {
        $sql = '
            SELECT count(*)
            FROM qa_user, ' . $tableName . '
            WHERE qa_user.u_id = ' . $tableName . '.u_id
            AND qa_user.u_id = ?;
        ';

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die('Prepare statement error.');
        }

        mysqli_stmt_bind_param($stmt, 'i', $login_uid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);

        $output = 0;
        if (!mysqli_stmt_fetch($stmt)) {
            $output = NAN;
        } else {
            $output = $count;
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        return $output;
    }

    ?>

    <!-- User Email-->
    <?php


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

    <!-- Question Num -->
    <?php
    $conn = initConnection($host, $username, $password, $dbname);
    $db_user_post_num = getNumOfRows($conn, 'post', $login_uid);
    ?>

    <!-- Reply Num -->
    <?php
    $conn = initConnection($host, $username, $password, $dbname);
    $db_user_reply_num = getNumOfRows($conn, 'reply', $login_uid);
    ?>
</head>

<body>
    <header>
        <a href="all-posts.php">
            <img src="./images/Logo.png" class="login-signup-logo">
        </a>
    </header>

    <!-- User Info -->
    <div class="user-info content-block">
        <!-- User Info Title -->
        <div class="user-info-title card-title">
            <span class="user-name primary">
                <?php echo $login_uname; ?>
            </span>
            <span class="user-id secondary">
                UID: <?php echo $login_uid; ?>
            </span>
        </div>

        <!-- List of User Information -->
        <div class="user-info-list">
            <table class="user-info-table">
                <tr>
                    <th>Email</th>
                    <td><?php echo $db_u_email; ?></td>
                </tr>
                <tr>
                    <th>#. of Questions</th>
                    <td><?php echo $db_user_post_num; ?></td>
                </tr>
                <tr>
                    <th>#. of Answers</th>
                    <td><?php echo $db_user_reply_num; ?></td>
                </tr>
            </table>
        </div>

        <!-- Button: Alter User Information -->
        <div class="h-btn-set">
            <?php
            renderButton('secondary', '', 'Edit Info');
            ?>
        </div>

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
                    SELECT p_id, u_name, p_content, p_is_close, p_create_time 
                    FROM post, qa_user 
                    WHERE qa_user.u_id = post.u_id AND qa_user.u_id = ? 
                    ORDER BY p_create_time DESC;
                    ';

        $stmt_user_posts = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt_user_posts, $sql_user_posts)) {
            echo '';
        }

        mysqli_stmt_bind_param($stmt_user_posts, 'i', $login_uid);
        mysqli_stmt_execute($stmt_user_posts);
        mysqli_stmt_bind_result($stmt_user_posts, $db_pid, $db_p_uname, $db_p_content, $db_p_is_close, $db_p_create_time);

        // Render all the questions pasked by the user.
        while (mysqli_stmt_fetch($stmt_user_posts)) {
            renderQuestionCard($db_pid, $db_p_uname, $db_p_is_close, $db_p_create_time, $db_p_content);
        }

        ?>
    </div>
</body>

</html>