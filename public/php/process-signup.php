<?php
include ('config-db.php');

// Get User Name and User Password
$u_name = $_POST['u_name'];
$u_pwd = $_POST['u_pwd'];

/**
 * @param $conn     MySQL Connection
 * @param $u_name   User Name
 * @return bool     Whether there is a duplicate user name.
 */
function checkDupUserName($conn, $u_name)
{
    // MySQL query for checking user name.
    $checkDupUserName = '
        SELECT u_id FROM qa_user WHERE u_name = ?;
    ';

    // Prepare statement
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $checkDupUserName)) {
        die('Prepared statement error.');
    }

    // 1. bind parameters
    mysqli_stmt_bind_param($stmt, 's', $u_name);

    // 2. execute the query.
    mysqli_stmt_execute($stmt);

    // 3. bind result to variable $db_u_pwd
    mysqli_stmt_bind_result($stmt, $dup_u_name);

    // 4. execute query
    $haveDupUserName = false;

    if (mysqli_stmt_fetch($stmt)) {
        $haveDupUserName = true;
    }

    mysqli_stmt_close($stmt);

    return $haveDupUserName;

}

/**
 * @param $conn     MySQL Connection
 * @return int|null Latest User ID. If no latest, return null.
 */
function getLatestUID($conn)
{
    $sql = '
        SELECT u_id FROM qa_user ORDER BY u_id DESC LIMIT 1;
    ';

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die('Prepared statement error.');
    }

    // Execute query
    mysqli_stmt_execute($stmt);

    // bind result to variable $db_latest_UID
    mysqli_stmt_bind_result($stmt, $db_l_uid);

    // fetch result
    if (mysqli_stmt_fetch($stmt)) {
        return $db_l_uid;
    } else {
        return null;
    }


}

/*
    --------- 1. Initialize db connection ---------
*/
$conn = mysqli_connect(hostname: $host, username: $username, password: $password, database: $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_errno());
}

// 1.1 Check for user name duplicates
$haveDupUserName = checkDupUserName($conn, $u_name);
echo $haveDupUserName == true ? "User name already exists." : "User name is available.";

// If user name exists, then abort
if ($haveDupUserName == true) {
    die();
}

// 1.2 Get latest user ID
$latestUID = getLatestUID($conn) ? getLatestUID($conn) : 1;
echo "<br>";
echo "Latest UID: " . $latestUID;

// 1.3 Hashing password
$u_pwd_hash = hash('sha256', $u_pwd);

/* 
    -------- 2. Insert new User into DB -------- 
*/
$newUID = $latestUID + 1;

// 2.1 Prepare Statement
$sql = '
    INSERT INTO qa_user (u_id, u_name, u_pwd) VALUES (?, ?, ?);
';

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('Prepared statement error.');
}

// 2.2 Bind parameters
mysqli_stmt_bind_param($stmt, 'iss', $newUID, $u_name, $u_pwd_hash);

// 2.3 execute the query
mysqli_stmt_execute($stmt);

echo '<br>';
echo 'Sign Up Successful.';

mysqli_stmt_close($stmt);
mysqli_close($conn);