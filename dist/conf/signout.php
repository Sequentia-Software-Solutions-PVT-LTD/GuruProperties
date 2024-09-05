<?php
session_start();

// include ('dist/conf/db.php');
include ('db.php');
$pdo = Database::connect();
date_default_timezone_set('Asia/Kolkata'); // Set to your timezone

    // echo "<pre>";
    // print_r($_SESSION);
    // exit();

 // ------------- add atendence ----------------------
//  if(isset($_SESSION['sales_representative_id']))
//  {
    $login_id = $_SESSION['login_id'];
    $login_name = $_SESSION['login_name'];
    $login_role = $_SESSION['login_role'];
    $login_user_id = $_SESSION['login_user_id'];
    $date = date('Y-m-d');
    $time = date('H:i:s');
    $added_on = date('Y-m-d H-i-s'); 
    $status = "Logged OUT";
    // $status="Logged In";

    //  print_r($_SESSION);
    //  exit();

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `attendance`(`login_id`,`login_name`,`date`,`time`,`status`, `added_on`) VALUES (?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($login_user_id, $login_name, $date, $time, $status, $added_on));
 //}
   
// ------------- add atendence ----------------------

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