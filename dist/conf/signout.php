<?php
session_start();

unset($_SESSION['login_photo']);
unset($_SESSION['login_name']);
unset($_SESSION['login_id']);
unset($_SESSION['login_role']);
unset($_SESSION['login_time']);

$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

header("location: ../../login" );
?>