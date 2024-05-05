<?php

function db_validateUser($conn, $validate_uid, $validate = true)
{
    $validate = $validate ? 1 : 0;
    $sql_db_u_valid = 'UPDATE qa_user SET u_valid = ' . $validate . ' WHERE u_id = ?;';
    $stmt_db_u_valid = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt_db_u_valid, $sql_db_u_valid)) {
        die('wrong');
    }
    mysqli_stmt_bind_param($stmt_db_u_valid, 'i', $validate_uid);
    mysqli_stmt_execute($stmt_db_u_valid);
}