<?php 
include_once ('dist/conf/checklogin.php');  
include ('dist/conf/db.php');
$pdo = Database::connect();

 if ( !empty($_POST['id'])) 
 {

 	// $admin_id = $_REQUEST['admin_id'];
    //  $id = $_POST['id'];
     $id = $_POST['id'];
     $added_on = date('Y-m-d H-i-s');
     $status = "Suspended";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql1 = "DELETE FROM `location` WHERE id = ?";  
	// $sql1 = "UPDATE employee set status = 'Suspended', edited_on = '$added_on' WHERE admin_id = ?";  
	$q = $pdo->prepare($sql1);
	$q->execute(array($id));

	header("Location: view_locations");
}
?>