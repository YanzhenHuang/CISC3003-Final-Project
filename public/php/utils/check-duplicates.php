<?php

/**
 * @param object $conn     MySQL Connection
 * @param string $item      Item to check
 * @param string $table     Table to check
 * @param string | int $targetVal Target Value
 * @return bool      Whether there is a duplicate item.
 */
function checkDuplicates($conn, $item, $table, $targetVal)
{
    $sql = '
        SELECT ' . $item . ' FROM ' . $table . ' WHERE ' . $item . ' = ?;
    ';

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die('Prepared statement error.');
    }

    // Formalize Value Type
    if (is_string($targetVal)) {
        $bindType = 's';
    } else if (is_int($targetVal)) {
        $bindType = 'i';
    } else {
        throw new Exception('Uncheckable value type!');
    }

    mysqli_stmt_bind_param($stmt, $bindType, $targetVal);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $dupVal);

    $haveDupVal = false;
    if (mysqli_stmt_fetch($stmt)) {
        $haveDupVal = true;
    }

    mysqli_stmt_close($stmt);

    return $haveDupVal;
}