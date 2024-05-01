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