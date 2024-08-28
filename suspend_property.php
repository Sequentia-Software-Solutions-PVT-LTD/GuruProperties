<?php 
 include_once ('dist/conf/checklogin.php');  
 include ('dist/conf/db.php');
  $pdo = Database::connect();
 //echo $_REQUEST['employee_id'];


 if ( !empty($_REQUEST['id'])) 
 {

// if(isSet($_POST["suspend"]))
//   { 

    // echo "<pre>";
    // // print_r($_POST);
    // // print_r($id);
    // // print_r('hiifdfd');
    // exit();

 	// $admin_id = $_REQUEST['admin_id'];
     $id = $_POST['id'];
     $added_on = date('Y-m-d H-i-s');
     $status = "Suspended";

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE property set status = 'Suspended', edited_on = '$added_on' WHERE id = ?";  
	$q = $pdo->prepare($sql);
	$q->execute(array($id));

	header("Location: view-properties");
}
?>