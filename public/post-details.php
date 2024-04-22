<!DOCTYPE html>
<html>

<head>
    <title>Post details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Styles -->
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/postDetails.css">

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
    <div class="question-grid">

        <!-- Question Details -->
        <?php
        include ('./php/config-db.php');
        // Initialize db connection
        $conn = initConnection($host, $username, $password, $dbname);
        // Get the id from the URL parameter
        $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : 1;

        // Prepare statement
        $sql_posts_detail = '
        SELECT p_id, u_name, p_content, p_is_close, p_create_time 
        FROM post, qa_user
        WHERE qa_user.u_id = post.u_id AND p_id = ?
        ORDER BY p_create_time DESC;';



        $stmt_posts_detail = mysqli_stmt_init($conn);


        if (!mysqli_stmt_prepare($stmt_posts_detail, $sql_posts_detail)) {
            die('Prepared statement error.');
        }

        // Bind the post_id parameter to the prepared statement
        mysqli_stmt_bind_param($stmt_posts_detail, 'i', $post_id);


        // Execute
        mysqli_stmt_execute($stmt_posts_detail);


        // Bind result to variables
        mysqli_stmt_bind_result($stmt_posts_detail, $p_id, $u_name, $p_content, $p_is_closed, $p_create_time);


        // Output the result
        if (mysqli_stmt_fetch($stmt_posts_detail)) {
            echo '<div class="question-title" id="p_id-' . $p_id . $u_name . '">';
            echo '<p class="create-time">' . $p_create_time . '</p>';
            echo '<p>' . $p_content . '</p>';
            echo '</div>';
            // echo $p_id . '  ' . $u_name . '  ' . $p_content . '  ' . $p_create_time . '<br>';
        }
        ?>

        <!-- Replies -->
        <?php
        // Initialize db connection
        $conn = initConnection($host, $username, $password, $dbname);

        $sql_get_reply_by_p_id = '
        SELECT r_id, u_name, r_content, r_create_time
        FROM reply, qa_user
        WHERE qa_user.u_id = reply.u_id AND reply.p_id = ?;
        ';

        $stmt_get_reply_by_p_id = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt_get_reply_by_p_id, $sql_get_reply_by_p_id)) {
            die('Prepared statement error.');
        }

        mysqli_stmt_bind_param($stmt_get_reply_by_p_id, 'i', $post_id);
        mysqli_stmt_execute($stmt_get_reply_by_p_id);
        mysqli_stmt_bind_result($stmt_get_reply_by_p_id, $r_id, $r_u_name, $r_content, $r_create_time);

        // Replies
        while (mysqli_stmt_fetch($stmt_get_reply_by_p_id)) {
            echo 'rid' . $r_id . ' ' . $r_u_name . ' ' . $r_content . ' ' . $r_create_time . '<br>';
        }

        mysqli_stmt_close($stmt_get_reply_by_p_id);
        mysqli_close($conn);

        ?>
    </div>


</body>

</html>