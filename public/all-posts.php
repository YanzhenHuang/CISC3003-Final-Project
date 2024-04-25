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

    <!-- JavaScript -->
    <script src="./js/handleEmptyForm.js"></script>
</head>

<body>
    <header>
        <img src="./images/Logo.png" class="login-signup-logo">

        <div class="user-login-details">
            <div class="header-user-info">
                <div class="header-user-name">
                    <?php
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

                    // Display user data.
                    echo $login_uname . '<span>&nbsp;&nbsp;&nbsp;</span>';
                    echo 'UID: ' . $login_uid . '       ';
                    ?>
                </div>
                <div class="user-control-center hidden">
                    <ul>
                        <li>
                            <a href="">About Me</a>
                        </li>
                        <li>
                            <a href="login.php">Log Out</a>
                        </li>
                        <li class="delete-acc">
                            <a href="./php/process-delAccount.php">Delete Account</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Current User -->
    <div class="user-info-panel">

    </div>

    <!-- User Submit Form -->
    <div class="ask-question-form content-block">
        <h1>Ask whatever to whoever!</h1>
        <form action="./php/process-post.php" method="post">

            <!-- Hidden User ID Field -->
            <?php
            echo '<input type="hidden" id="uid" name="uid" value="' . $login_uid . '"></input>'
                ?>

            <!-- Question Content -->
            <div class="label-and-text-input">
                <label for="p_content">Type in what you want to ask:</label>
                <textarea type="text" id="p_content" name="p_content" class="non-empty"></textarea>
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Ask!" class="btn" id="ask-question"></input>
        </form>
    </div>

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

<script>
    handleEmptyForm('#ask-question');
    let headerUserName = document.querySelector('.header-user-name');
    let userControCenter = document.querySelector('.user-control-center');
    headerUserName.addEventListener('click', (e) => {
        userControCenter.classList.toggle('hidden');
        setTimeout(() => {
            userControCenter.classList.add('hidden');
        }, 3000);
    });

    userControCenter.addEventListener('mouseleave', (e) => {
        userControCenter.classList.add('hidden');
    });
</script>

<script>
    // Delete User
    let deleteAccBtn = document.querySelector('.delete-acc');
    deleteAccBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (window.confirm('Are you sure you want to delete your account?')) {
            // User confirmed, invoke default behavior
            let url = './php/process-delAccount.php';
            let xhr = new XMLHttpRequest();

            // Asynchronously post to the server
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    window.location.href = "login.php";
                } else {
                    console.log("Error: " + xhr.status);
                }
            };

            xhr.send();
        }
    });
</script>

</html>