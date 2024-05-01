<?php
function removeCookies($items)
{
    foreach ($items as $item) {
        if (isset($_COOKIE[$item])) {
            unset($_COOKIE[$item]);
            setcookie($item, '', time() - 3600, '/'); // empty value and old timestamp
        }
    }
}

function removeSessions($items)
{
    foreach ($items as $item) {
        if (isset($_SESSION[$item])) {
            unset($_SESSION[$item]);
        }
    }

    // session_destroy();
}