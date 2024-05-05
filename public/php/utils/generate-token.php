<?php

class TokenSet
{
    public $plain;
    public $hashed;

    public function __construct($var1, $var2)
    {
        $this->plain = $var1;
        $this->hashed = $var2;
    }
}

/**
 * Generates a login token for the user.
 * @param string $u_email  The user's email.
 * @param string $u_name   The user's name.
 */
function generateToken($u_email, $u_name)
{
    $determinantString = $u_email . $u_name;
    // Generate a random 16-character string based on $rawString

    $randomBytes = random_bytes(8);
    $randomString = bin2hex($randomBytes);

    $rawToken = $determinantString . $randomString;
    $token = hash('sha256', $rawToken);

    // Take the first 16 characters as the final token
    $token = substr($token, 0, 16);
    $hashedToken = hash('sha256', $token);

    // Encapsulate token set
    $tokenSet = new TokenSet($token, $hashedToken);

    return $tokenSet;
}

/**
 * Update user token in the database.
 * @param object $conn Database connection object.
 * @param string $u_id User ID.
 * @param string $u_email User Email.
 * @param string $u_name User Name.
 */
function updateToken($conn, $u_id, $u_email, $u_name)
{
    $newTokenSet = generateToken($u_email, $u_name);
    $sql_updateToken = 'UPDATE qa_user SET u_token = ? WHERE u_id = ?';
    $stmt_updateToken = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt_updateToken, $sql_updateToken)) {
        die('Prepared statement error.');
    }
    mysqli_stmt_bind_param($stmt_updateToken, 'si', $newTokenSet->hashed, $u_id);
    mysqli_stmt_execute($stmt_updateToken);

    mysqli_stmt_close($stmt_updateToken);
    mysqli_close($conn);

    return $newTokenSet;
}