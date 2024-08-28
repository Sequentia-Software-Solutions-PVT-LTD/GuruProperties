<?php 
include_once ('dist/conf/checklogin.php');  
include ('dist/conf/db.php');
$pdo = Database::connect();

 if ( !empty($_POST['employee_id'])) 
 {

 	// $admin_id = $_REQUEST['admin_id'];
    //  $id = $_POST['id'];
     $employee_id = $_POST['employee_id'];
     $added_on = date('Y-m-d H-i-s');
     $status = "Suspended";

    $sql = "select * from employee where employee_id=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($employee_id));      
    $dataam = $q->fetch(PDO::FETCH_ASSOC);

    $admin_id = $dataam['admin_id'];

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE admin set status = 'Suspended' WHERE admin_id = ?";  
	$q = $pdo->prepare($sql);
	$q->execute(array($admin_id));

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql1 = "UPDATE employee set status = 'Suspended', edited_on = '$added_on' WHERE admin_id = ?";  
    // print_r($sql1);
    // exit();
	$q = $pdo->prepare($sql1);
	$q->execute(array($admin_id));

    
	header("Location: view-employees");
}
?>