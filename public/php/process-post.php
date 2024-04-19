<?php
include ('config-db.php');

$uid = $_POST['uid'];
$p_content = $_POST['p_content'];

/**
 * @param $conn     MySQL Connection
 * @return int|null Latest User ID. If no latest, return null.
 */
function getLatestPostID($conn)
{
    $sql = '
        SELECT p_id FROM post ORDER BY p_id DESC LIMIT 1;
    ';

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die('Prepared statement error.');
    }

    // Execute query
    mysqli_stmt_execute($stmt);

    // bind result to variable $db_latest_UID
    mysqli_stmt_bind_result($stmt, $db_l_pid);

    // fetch result
    if (mysqli_stmt_fetch($stmt)) {
        return $db_l_pid;
    } else {
        return null;
    }


}


/*
    --------- 1. Initialize db connection ---------
*/
$conn = initConnection($host, $username, $password, $dbname);

// 1.2 Get latest post ID
$latestPostID = getLatestPostID($conn) ? getLatestPostID($conn) : 1;
echo "<br>";
echo "Latest Post ID: " . $latestPostID;

/* 
    -------- 2. Insert new Post into DB -------- 
*/
$newPostID = $latestPostID + 1;

// 2.1 Prepare Statement
$sql = '
    INSERT INTO post (p_id, u_id, p_content) VALUES (?, ?, ?);
';

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('Prepared statement error.');
}

// 2.2 Bind parameters
mysqli_stmt_bind_param($stmt, 'iis', $newPostID, $uid, $p_content);

// 3.3 execute the query
mysqli_stmt_execute($stmt);

echo '<br>';
echo 'Question posted.';

mysqli_stmt_close($stmt);
mysqli_close($conn);