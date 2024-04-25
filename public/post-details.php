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

    <!-- PHP -->
    <?php
    include ('./php/config-db.php');
    include ('./php/utils/formatter.inc.php');
    session_start();
    ?>
</head>

<body>
    <header>
        <a href="all-posts.php">
            <img src="./images/Logo.png" class="login-signup-logo">
        </a>
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

            // Display user data.
            echo $login_uname . '<span>&nbsp;&nbsp;&nbsp;</span>';
            echo 'UID: ' . $login_uid . '       ';
            ?>

            <a href="login.php">&nbsp; &nbsp;Log Out</a>
            <a href="./php/process-delAccount.php">&nbsp; &nbsp;Delete Account</a>
        </div>
    </header>

    <!-- Reply Content List -->
    <div class="reply-content-list">

        <!-- Question Details -->
        <?php
        // Initialize db connection
        $conn = initConnection($host, $username, $password, $dbname);
        // Get the id from the URL parameter
        $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : 1;

        // Prepare statement
        $sql_posts_detail = '
        SELECT p_id, qa_user.u_id, u_name, p_content, p_is_close, p_create_time 
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
        mysqli_stmt_bind_result(
            $stmt_posts_detail,
            $this_post_pid,
            $this_post_uid,
            $this_post_uname,
            $p_content,
            $p_is_closed,
            $p_create_time
        );


        // Output the result
        if (mysqli_stmt_fetch($stmt_posts_detail)) {
            echo '<div class="stmt-posts-detail">';
            echo '<p class="highlight">' . $this_post_uname . ' - ' . $p_create_time . '</p>';
            echo '<p class="content">' . $p_content . '</p>';
            echo '</div>';
        }
        ?>

        <!-- Replies -->
        <div class="reply-content-list">
            <?php
            // Initialize db connection
            $conn = initConnection($host, $username, $password, $dbname);

            $sql_get_reply_by_p_id = '
                SELECT r_id, qa_user.u_id, u_name, r_content, r_create_time
                FROM reply, qa_user
                WHERE qa_user.u_id = reply.u_id AND reply.p_id = ?;
            ';

            $stmt_get_reply_by_p_id = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt_get_reply_by_p_id, $sql_get_reply_by_p_id)) {
                die('Prepared statement error.');
            }

            mysqli_stmt_bind_param($stmt_get_reply_by_p_id, 'i', $post_id);
            mysqli_stmt_execute($stmt_get_reply_by_p_id);
            mysqli_stmt_bind_result($stmt_get_reply_by_p_id, $r_id, $this_reply_uid, $r_u_name, $r_content, $r_create_time);

            // Replies
            echo '<div class="reply-list">';
            $i = 1; // Local variable to track sequential ID
            while (mysqli_stmt_fetch($stmt_get_reply_by_p_id)) {
                // Format display time
                $r_create_time = getDisplayTimeString($r_create_time);

                // Output the reply container
            
                echo '<div class="reply-container">';

                // First row: r_u_name and r_create_time
                echo '<div class="reply-info">';
                echo '<h3 class="reply-highlight">No.' . $i . ' - ' . $r_u_name . ' - ' . $r_create_time . '</h3>';
                if ($this_reply_uid == $this_post_uid)
                    echo '<p class="question-owner-tag" title="The question asker replied him/herself.">Question Owner</p>';
                echo '</div>';

                // Second row: r_content
                echo '<div class="reply-content">';
                echo '<p>' . $r_content . '</p>';
                echo '</div>';

                echo '</div>'; // Close the reply container
            

                $i++; // Increment the sequential ID
            }

            echo '</div>'; // Reply list
            
            mysqli_stmt_close($stmt_get_reply_by_p_id);
            mysqli_close($conn);



            ?>
        </div>
    </div>

    <!-- Reply Module -->
    <div class="reply-question-form content-block">
        <h3>Reply to <?php echo $login_uname ?> </h3>
        <form action="./php/process-reply.php" method="post">

            <!-- Hidden User ID Field -->
            <?php
            echo '<input type="hidden" id="uid" name="uid" value="' . $login_uid . '"></input>';
            echo '<input type="hidden" id="pid" name="pid" value="' . $post_id . '"></input>'
                ?>

            <!-- Question Content -->
            <div class="label-and-text-input">
                <label for="r_content">Type in what you want to Answer:</label>
                <textarea type="text" id="r_content" name="r_content" class="non-empty"></textarea>
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Answer!" class="btn" id="reply-question"></input>
        </form>
    </div>

    <!-- Delete Post -->
    <?php
    function renderDeletePostBtn($this_post_uid)
    {
        if ($_SESSION['u_id'] != $this_post_uid) {
            return;
        }
        echo '<div class="btn danger" id="delete-post">Delete Post</div>';
    }

    renderDeletePostBtn($this_post_uid);
    ?>

</body>

<script>
    (function () {
        // Delete Post
        let delPostBtn = document.querySelector('#delete-post');
        if (!delPostBtn) {
            return;
        }

        delPostBtn.addEventListener('click', (e) => {
            let url = './php/process-delete-post.php';
            let xhr = new XMLHttpRequest();

            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Confirm is user want to delete.
            if (!window.confirm('Delete this post?')) {
                return;
            }

            // Delete result
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    window.alert('Post had been deleted Successfully.');
                    window.location.href = "all-posts.php";
                } else {
                    // window.alert('Network error, delete failed. Status: ' + xhr.status);
                    console.alert('Network error');
                }
            }

            let urlParams = new URLSearchParams(window.location.search);
            let thisPostId = urlParams.get('post_id');

            xhr.send("p_id=" + thisPostId);
            console.log(thisPostId);

        })
    })();
</script>

</html>