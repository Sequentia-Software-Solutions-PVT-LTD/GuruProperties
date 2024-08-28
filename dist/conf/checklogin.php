<?php
	session_start();

	//Session Validation
	if (isset($_SESSION['login_id']))
	{
		if((time() - $_SESSION['login_time']) > 600000) // Time in Seconds
		{
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
			
			session_destroy();
			$redirect = $_SERVER['REQUEST_URI'];
			header("location:login?redirect=$redirect");
		}
		else
		{
			$_SESSION['login_time'] = time();
		}
	}

	if (!isset($_SESSION['login_id']))
	{
		$redirect = $_SERVER['REQUEST_URI'];
	    header("Location: login?redirect=$redirect" );
	}
?>