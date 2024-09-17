<?php 
  session_start(); 

    include ('dist/conf/checklogin.php');
    include ('dist/conf/db.php');
    $pdo = Database::connect();
?>
<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> View Today's Leads Details  |  Guru Properties</title>

    <meta name="description" content="" />
    <style>
   /* When either input is focused, apply border color to both */
    .prefix-class:focus,
    .user-id-class:focus,
    .user-id-class:focus + .prefix-class,
    .prefix-class:focus + .user-id-class
    {
        border: 2px solid #666cff;   /* Highlight both inputs on focus */
    }
  </style>
  
 <style>
	  .select2
	  {
		  width: 100% !important;
	  }
	  .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
		  padding: 4px 12px;
	  }
	  .select2-container .select2-selection--single {
		  height:30px;
	  }
	  .select2-container--default .select2-selection--single {
		  border-radius: 0px;
	  }
	  .modal-box
	  {
		border: 1px solid gainsboro!important;
		display:none;
	}

	.select2-container--default .select2-selection--multiple .select2-selection__choice__remove
	{
		color: #fff !important;
		margin-right:8px !important;
	}

	.select2-container--default .select2-selection--multiple .select2-selection__choice {
		background-color: #605ca8 !important;
	}
	.cameracss{
		display: flex;
		flex-direction: row;
		gap: 50px;
		justify-content: center;
		align-items: center;
		height:400px;
	}

    /* multi select dropdown */
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        color: #fff;
    }
  </style>
 <style>
	/* CSS comes here */
	#video,#video2 {
		border: 1px solid black;
		/* width: 120px;
		height: 140px; */
		height:265px;
		width:350px;
	}

	#photo,#photo2 {
		border: 1px solid black;
		/* width: 120px;
		height: 140px; */
		height:265px;
		width:350px;
	}

	#canvas,#canvas2 {
		display: none;
	}

	.camera,.camera2 {
		/* width: 140px; */
		display: inline-block;
	}

	.output,.output2 {
		/* width: 140px; */
		display: inline-block;
	}

	.close,.close2 {
		font-size:30px;
		opacity:1 !important;
		color:#000 !important;
	}

	/* #startbutton {
		display: block;
		position: relative;
		margin-left: auto;
		margin-right: auto;
		bottom: 36px;
		padding: 5px;
		background-color: #6a67ce;
		border: 1px solid rgba(255, 255, 255, 0.7);
		font-size: 14px;
		color: rgba(255, 255, 255, 1.0);
		cursor: pointer;
	} */

	.modal-dialog {
		width:900px !important;
	}
	/* .modal-body {
		height:483px !important;
	} */

	.modal-body-procedure {
		height:200px !important;
	}

	.contentarea {
		font-size: 16px;
		font-family: Arial;
		text-align: center;
	}
	</style>
    <?php include 'layout/header_js.php'; ?>
    
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <?php include 'layout/sidebar.php'; ?>

        <div class="layout-page">
          <?php include 'layout/header.php'; ?>

          <div class="content-wrapper">

            <div class="container-xxl flex-grow-1 container-p-y">
<?php
    // include ('dist/conf/db.php');
    // $pdo = Database::connect();

    $i = 1;
    // $leads_id = $_REQUEST['leads_id'];
    $leads_id = 24;
    
    
    $sqlleads = "select * from leads where id = $leads_id ";
    $qleads = $pdo->prepare($sqlleads);
    $qleads->execute(array());      
    $leadsArray = $qleads->fetchAll(PDO::FETCH_ASSOC);
    
    $sqlCE = "SELECT * FROM assign_leads where leads_id= $leads_id ";
    $qCE = $pdo->prepare($sqlCE);
    $qCE->execute(array());      
    $CE_Leads_Array = $qCE->fetchAll(PDO::FETCH_ASSOC);

    $sqlSE = "SELECT * FROM assign_leads_sr where leads_id= $leads_id ";
    $qSE = $pdo->prepare($sqlSE);
    $qSE->execute(array());      
    $SE_Leads_Array = $qSE->fetchAll(PDO::FETCH_ASSOC);

    $sqlconv = "SELECT * FROM converted_leads where leads_id= $leads_id ";
    $qconv = $pdo->prepare($sqlconv);
    $qconv->execute(array());      
    $Converted_Leads_Array = $qconv->fetchAll(PDO::FETCH_ASSOC);

    $sqlemployee = "SELECT * FROM employee";
    $qemployee = $pdo->prepare($sqlemployee);
    $qemployee->execute(array());      
    $employee_Array = $qemployee->fetchAll(PDO::FETCH_ASSOC);

    $sqlemployee = "SELECT * FROM employee";
    $qemployee = $pdo->prepare($sqlemployee);
    $qemployee->execute(array());      
    $employee_Array = $qemployee->fetchAll(PDO::FETCH_ASSOC);
    
    $sqlproperty = "SELECT * FROM property_name";
    $qproperty = $pdo->prepare($sqlproperty);
    $qproperty->execute(array());      
    $property_Array = $qproperty->fetchAll(PDO::FETCH_ASSOC);

    $sqlsubproperty = "SELECT * FROM property_tower";
    $qsubproperty = $pdo->prepare($sqlsubproperty);
    $qsubproperty->execute(array());      
    $sub_property_Array = $qsubproperty->fetchAll(PDO::FETCH_ASSOC);

    $sqlvariant = "SELECT * FROM property_varients";
    $qvariant = $pdo->prepare($sqlvariant);
    $qvariant->execute(array());      
    $varient_Array = $qvariant->fetchAll(PDO::FETCH_ASSOC);
    
    $admin_id = 0;
    // if($CE_Leads_Array != null) {
    //   var_dump($CE_Leads_Array);
    //     $admin_id = $CE_Leads_Array['admin_id'];
    // }

    // $sqlemp = "select * from employee where admin_id = ? ";
    // $q = $pdo->prepare($sqlemp);
    // $q->execute(array( $admin_id));      
    // $Emp_Array = $q->fetch(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // var_dump($leadsArray);
    // echo "<br>";
    // var_dump($CE_Leads_Array);
    // echo "<br>";
    // var_dump($SE_Leads_Array);
    // echo "<br>";
    // var_dump($Converted_Leads_Array);
    // echo "<br>";
    // var_dump($Emp_Array);
    // echo "<br>";
    // echo "</pre>";

    // $date = "2024-08-24 16:40:59";
    // var_dump($date);
    // $timeline_date = date("Y-m-d H:i:s", strtotime($date));
    // var_dump($timeline_date);

    $AllData = array();
    foreach($leadsArray as $leadsSingle) {
        // var_dump($leadsSingle['leads']);
        // var_dump($leadsSingle['id']);
        // var_dump($leadsSingle['status']);
        // var_dump($leadsSingle['status']);
        // var_dump($leadsSingle['added_on']);
        // var_dump($leadsSingle['edited_on']);
        $timeline_date = null;
        $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['added_on']));
        $dbContent = $leadsSingle;
            // array_push($AllData, array(
            //     "table_name" => 'leads',
            //     "id" => $leadsSingle['id'],
            //     "status" => "Fresh Lead",
            //     "transfer_status" => "Fresh Lead",
            //     "timlinedate" => $timeline_date,
            //     "added_on" => $leadsSingle['added_on'],
            //     "edited_on" => $leadsSingle['edited_on'],
            // ));
    }
    foreach($CE_Leads_Array as $CE_Leads_Single) {
        // var_dump($CE_Leads_Single['assign_leads']);
        // var_dump($CE_Leads_Single['assign_leads_id']);
        // var_dump($CE_Leads_Single['status']);
        // var_dump($CE_Leads_Single['transfer_status']);
        // var_dump($CE_Leads_Single['added_on']);
        // var_dump($CE_Leads_Single['edited_on']);
        // $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['added_on']));
        
        // if($CE_Leads_Single['status'] == "Active" && $CE_Leads_Single['transfer_status']== "Available"){
        //     $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['added_on']));
        // }
        // if($CE_Leads_Single['status'] == "Active" && $CE_Leads_Single['transfer_status']== "Transferred"){
        //     $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['edited_on']));
        // }
        // if($CE_Leads_Single['status'] == "Transferred" && $CE_Leads_Single['transfer_status']== "Available"){
        //     $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['added_on']));
        // }
        // if($CE_Leads_Single['status'] == "Assigned" && $CE_Leads_Single['transfer_status']== "Transferred"){
        //     $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['edited_on']));
        // }
        // if($CE_Leads_Single['status'] == "From SE" && $CE_Leads_Single['transfer_status']== "Available"){
        //     $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['added_on']));
        // }
        $dbContent = $CE_Leads_Single;
        $timeline_date_ce = null;
        if($CE_Leads_Single['status'] == "Active" && $CE_Leads_Single['transfer_status']== "Available"){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['added_on']));
        }
        if($CE_Leads_Single['status'] == "Followup" && $CE_Leads_Single['transfer_status']== "Not Available"){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['edited_on']));
        }
        if($CE_Leads_Single['status'] == "Followup" && $CE_Leads_Single['transfer_status']== "Available"){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['added_on']));
        }
        if($CE_Leads_Single['status'] == "Active" && $CE_Leads_Single['transfer_status']== "Transferred"){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['edited_on']));
        }
        if($CE_Leads_Single['status'] == "Transferred" && $CE_Leads_Single['transfer_status']== "Admin Pending" && strtolower($CE_Leads_Single['request_for_admin']) == "no" ){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['admin_request_date']));
        }
        if($CE_Leads_Single['status'] == "Transferred" && $CE_Leads_Single['transfer_status']== "Available" && strtolower($CE_Leads_Single['request_for_admin']) == "yes" ){
          $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['admin_aproved_date']));
        }
        if($CE_Leads_Single['status'] == "From SE" && $CE_Leads_Single['transfer_status']== "Admin Pending" && $CE_Leads_Single['request_for_admin']== "no" ){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['admin_request_date']));
        }
        if($CE_Leads_Single['status'] == "From SE" && $CE_Leads_Single['transfer_status']== "Available" && $CE_Leads_Single['request_for_admin']== "yes" ){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['admin_aproved_date']));
        }
        if($CE_Leads_Single['status'] == "Assigned" && $CE_Leads_Single['transfer_status']== "Transferred"){
          $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['edited_on']));
        }
        if($CE_Leads_Single['status'] == "Dead"){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['edited_on']));
        }
        

            array_push($AllData, array(
                "table_name" => 'assign_leads',
                "id" => $CE_Leads_Single['assign_leads_id'],
                "status" => $CE_Leads_Single['status'],
                "transfer_status" => $CE_Leads_Single['transfer_status'],
                "timlinedate" => $timeline_date_ce,
                "added_on" => $CE_Leads_Single['added_on'],
                "edited_on" => $CE_Leads_Single['edited_on'],
                "dbContent" => $dbContent,
            ));
    }
    foreach($SE_Leads_Array as $SE_Leads_Single) {
        $timeline_date_se = null;

        $dbContent = $SE_Leads_Single;
        if($SE_Leads_Single['status'] == "Active" && $SE_Leads_Single['transfer_status']== "Available"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['added_on']));
        }
        if($SE_Leads_Single['status'] == "Followup" && $SE_Leads_Single['transfer_status']== "Not Available"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }
        if($SE_Leads_Single['status'] == "Followup" && $SE_Leads_Single['transfer_status']== "Available" && $SE_Leads_Single['followup_or_another_property']=="Follow Up"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }
        if($SE_Leads_Single['status'] == "Followup" && $SE_Leads_Single['transfer_status']== "Available" && $SE_Leads_Single['followup_or_another_property']=="Another Property"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['added_on']));
        }
        if($SE_Leads_Single['status'] == "Followup" && $SE_Leads_Single['transfer_status']== "Available" && $SE_Leads_Single['followup_or_another_property']==""){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }
        // if($SE_Leads_Single['status'] == "Active" && $SE_Leads_Single['transfer_status']== "Transferred" && strtoupper($SE_Leads_Single['transfer_employee_type']) == "SALES EXECUTIVE"){
        //   $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        // }
        if($SE_Leads_Single['status'] == "Active" && $SE_Leads_Single['transfer_status']== "Transferred" && strtoupper($SE_Leads_Single['transfer_employee_type']) == "SALES EXECUTIVE" && strtolower($SE_Leads_Single['request_for_admin']) == "yes"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }
        if($SE_Leads_Single['status'] == "Active" && $SE_Leads_Single['transfer_status']== "Transferred" && strtoupper($SE_Leads_Single['transfer_employee_type']) == "SALES EXECUTIVE" && strtolower($SE_Leads_Single['request_for_admin']) == ""){
          $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }
        
        if($SE_Leads_Single['status'] == "Active" && $SE_Leads_Single['transfer_status'] == "Transferred" && strtoupper($SE_Leads_Single['transfer_employee_type']) == "CUSTOMER EXECUTIVE" && strtolower($SE_Leads_Single['request_for_admin']) == ""){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }     

        if($SE_Leads_Single['status'] == "Transferred" && $SE_Leads_Single['transfer_status']== "Admin Pending" && strtoupper($SE_Leads_Single['assign_employee_type']) == "SALES EXECUTIVE" && strtolower($SE_Leads_Single['request_for_admin']) == "no"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['admin_request_date']));
        }
        if($SE_Leads_Single['status'] == "Transferred" && $SE_Leads_Single['transfer_status']== "Admin Pending" && strtoupper($SE_Leads_Single['assign_employee_type']) == "SALES EXECUTIVE" && strtolower($SE_Leads_Single['request_for_admin']) == "yes"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['admin_aproved_date']));
        }
        
        if($SE_Leads_Single['status'] == "Transferred" && $SE_Leads_Single['transfer_status']== "Available" && strtoupper($SE_Leads_Single['assign_employee_type']) == "SALES EXECUTIVE" && strtolower($SE_Leads_Single['request_for_admin']) == "yes"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['admin_aproved_date']));
        }

        if($SE_Leads_Single['status'] == "Converted" && $SE_Leads_Single['transfer_status']== "Converted"){
          $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }
        if($SE_Leads_Single['status'] == "Dead"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }
        
        // var_dump($SE_Leads_Single['assign_leads_sr']);
        // var_dump($SE_Leads_Single['assign_leads_sr_id']);
        // var_dump($SE_Leads_Single['status']);
        // var_dump($SE_Leads_Single['transfer_status']);
        // var_dump($SE_Leads_Single['added_on']);
        // var_dump($SE_Leads_Single['edited_on']);
            array_push($AllData, array(
                "table_name" => 'assign_leads_sr',
                "id" => $SE_Leads_Single['assign_leads_sr_id'],
                "status" => $SE_Leads_Single['status'],
                "transfer_status" => $SE_Leads_Single['transfer_status'],
                "timlinedate" => $timeline_date_se,
                "added_on" => $SE_Leads_Single['added_on'],
                "edited_on" => $SE_Leads_Single['edited_on'],
                "dbContent" => $dbContent
            ));
    }
    foreach($Converted_Leads_Array as $Converted_Leads_Single) {
      
        $dbContent = $Converted_Leads_Single;
        $timeline_date_con = null;
        $timeline_date_con = date("Y-m-d H:i:s", strtotime($Converted_Leads_Single['added_on']));
        // var_dump($Converted_Leads_Single['converted_leads']);
        // var_dump($Converted_Leads_Single['converted_leads_id']);
        // var_dump($Converted_Leads_Single['status']);
        // var_dump($Converted_Leads_Single['status']);
        // var_dump($Converted_Leads_Single['added_on']);
        // var_dump($Converted_Leads_Single['edited_on']);
            array_push($AllData, array(
                "table_name" => 'converted_leads',
                "id" => $Converted_Leads_Single['converted_leads_id'],
                "status" => "Converted",
                "transfer_status" => "Converted",
                "timlinedate" => $timeline_date_con,
                "added_on" => $Converted_Leads_Single['added_on'],
                "edited_on" => $Converted_Leads_Single['edited_on'],
                "dbContent" => $dbContent
            ));
    }
    
    // var_dump(count($AllData));
    // echo '<pre>';
    // var_dump(array_multisort(
    //                 array_column($AllData, 'edited_on'), 
    //                 array_column($AllData, 'added_on'), 
    //                 SORT_DESC, 
    //                 $AllData
    //             )
    //         );
     array_multisort(
                    array_column($AllData, 'timlinedate'), 
                    SORT_DESC, 
                    $AllData
                );
    // var_dump($AllData);
    // echo '</pre>';
    // exit();

?>

              <div class="row overflow-hidden">
                <div class="col-12">
                  <ul class="timeline timeline-center mt-6">
                    <?php
                        foreach ($AllData as $variant) {
                           
                            $id=0;
                            if(isset($variant['id']) && $variant['id'] != 0) {
                                $id = $variant['id'];
                            }
                            $data = array();
                            $LEArray = array();
                            $CEArray = array();
                            $ALArray = array();
                            $CONArray = array();

                            $dateShowcase = "";
                            $message = "";
                            $leadType = "";
                            $reason = "";
                            $noteRemark = "";
                            $connectionStatus = "";
                            $employeeName = "";
                            $dbData = "";

                            if($variant['table_name'] == "leads") {
                                $sqlLE = "select * from leads where id = $id ";
                                $qLE = $pdo->prepare($sqlLE);
                                $qLE->execute(array());      
                                $LEArray = $qLE->fetch(PDO::FETCH_ASSOC);
                                $data = $LEArray;
                            }
                            if($variant['table_name'] == "assign_leads") {
                                $sqlCE = "select * from assign_leads where assign_leads_id = $id ";
                                $qCE = $pdo->prepare($sqlCE);
                                $qCE->execute(array());      
                                $CEArray = $qCE->fetch(PDO::FETCH_ASSOC);
                                $data = $CEArray;
                            }
                            if($variant['table_name'] == "assign_leads_sr") {
                                $sqlAL = "select * from assign_leads_sr where assign_leads_sr_id = $id ";
                                $qAL = $pdo->prepare($sqlAL);
                                $qAL->execute(array());      
                                $ALArray = $qAL->fetch(PDO::FETCH_ASSOC);
                                $data = $ALArray;
                            }
                            if($variant['table_name'] == "converted_leads") {
                                $sqlCON = "select * from converted_leads where converted_leads_id = $id ";
                                $qCON = $pdo->prepare($sqlCON);
                                $qCON->execute(array());      
                                $CONArray = $qCON->fetch(PDO::FETCH_ASSOC);
                                $data = $CONArray;
                            }
                            if($variant['table_name'] == "assign_leads_sr" || $variant['table_name'] == "converted_leads") {
                              $showside = "fade-right";
                              $roleName = "SALES EXECUTIVE";
                            } else if($variant['table_name'] == "assign_leads") {
                                $roleName = "CUSTOMER EXECUTIVE";
                                $showside = "fade-left";
                            } else if($variant['table_name'] == "leads") {
                              $roleName = "LEADS GENERATOR";
                              $showside = "fade-left";
                            } 

                            if($variant['table_name'] == "assign_leads") {
                              $dbData = $variant["dbContent"];
                              if($variant['status'] == "Active" && $variant['transfer_status']== "Available"){
                                  $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['added_on']));
                                  $message = "Waiting for CUSTOMER EXECUTIVE to take action.";
                                  $leadType = "";
                                  $reason = "";
                                  $noteRemark = "";
                                  $connectionStatus = "";
                                  $employeeName = $CEArray["employee_id"];
                                  
                                  
                              }
                              if($variant['status'] == "Followup" && $variant['transfer_status']== "Not Available"){
                                // why sales executive in the "transfer_employee_type"
                                  $dateShowcase = date("Y-m-d", strtotime($CEArray['next_date']))." ".date("H:i:s", strtotime($CEArray['next_time']));
                                  $callStatus = strtoupper(str_replace("_", " ", $CEArray["connection_status"]));
                                    if($callStatus == 'CONNECTED')
                                    $message = '<span class="badge rounded-pill bg-success">CONNECTED</span>';
                                    if($callStatus == 'NOT CONNECTED')
                                    $message = '<span class="badge rounded-pill bg-danger">NOT CONNECTED</span>';
                                  // $message = "Call Status - ".strtoupper(str_replace("_", " ", $CEArray["connection_status"]));
                                  if(($CEArray["connection_status"]) != 'not_connected' ) {
                                    $leadType = $CEArray["lead_type"];
                                  } else {
                                    $leadType = "";
                                  }
                                  $reason = "";
                                  $noteRemark = strtoupper($CEArray["notes"]);
                                  $connectionStatus = $CEArray["connection_status"];
                                  $employeeName = $CEArray["employee_id"];
                                  
                                  $needle = $employeeName;
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName = $resultArray[$needle]["employee_name"]; 
                                  
                              }
                              if($variant['status'] == "Followup" && $variant['transfer_status']== "Available"){
                                // why sales executive in the "transfer_employee_type"
                                $dateShowcase = date("Y-m-d", strtotime($CEArray['next_date']))." ".date("H:i:s", strtotime($CEArray['next_time']));
                                  $message = "Waiting For Follow Up";
                                  $leadType = "";
                                  $reason = "";
                                  $noteRemark = "";
                                  $connectionStatus = "";
                                  $employeeName = $CEArray["employee_id"];
                                  $needle = $employeeName;
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName = $resultArray[$needle]["employee_name"]; 
                                  
                              }
                              if($variant['status'] == "Active" && $variant['transfer_status']== "Transferred") {
                                  // What is the status of "request_for_admin"
                                  $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['edited_on']));
                                  // $message = "The lead is transfer to ".$CEArray["transfer_employee_type"]." - ".$CEArray["transfer_employee_id"];
                                  $message = "The lead is transfer to ".$CEArray["transfer_employee_type"]." - ";
                                
                                  $needle = $CEArray["transfer_employee_id"];
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $transferEmployeeName = $resultArray[$needle]["employee_name"];

                                  $message .= $transferEmployeeName."<br>";

                                  if($CEArray["request_for_admin"] == "yes")
                                      $message .= "Admin Approved";
                                  else
                                      $message .= "Admin Approval Pending";
                                  $leadType = $CEArray["lead_type"];
                                  $reason = $CEArray["transfer_reason"];
                                  // if($CEArray['request_for_admin'] == "") {
                                  //   $noteRemark = "Waiting For Admin Approval.";
                                  // } else if(strtolower($CEArray['request_for_admin']) == "yes") {
                                  //   $noteRemark = "Admin Approved.";
                                  // }
                                  $noteRemark = "";
                                  $connectionStatus = $CEArray["connection_status"];

                                  $needle = $CEArray["employee_id"];
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName = $resultArray[$needle]["employee_name"];
                                  
                              }

                              if($variant['status'] == "Assigned" && $variant['transfer_status']== "Transferred"){
                                  $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['edited_on']));
                                  // $message = "This lead is assigned to the ". $CEArray['assign_employee_type'] ." - ".$CEArray['transfer_employee_id'];
                                  $message = "This lead is assigned to the ". $CEArray['assign_employee_type'] ." - ";
                                  $needle = $CEArray["transfer_employee_id"];
                                  
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName = $resultArray[$needle]["employee_name"];

                                  $message .= $employeeName;
                                  $leadType = "";
                                  $reason = $CEArray['transfer_reason'];
                                  $noteRemark = "";
                                  $connectionStatus = "";
                                  $employeeName = $CEArray['employee_id'];
                                  $needle = $employeeName;
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName = $resultArray[$needle]["employee_name"]; 
                                  
                              }
                              if($variant['status'] == "Transferred" && $variant['transfer_status']== "Admin Pending" && strtolower($CEArray['request_for_admin']) == "no" ){
                                // What is the status of "request_for_admin"
                                  $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['admin_request_date']));
                                  $message = "Waiting For Admin Approval.";
                                  $leadType = "";
                                  $reason = $CEArray["transfer_reason"];
                                  $noteRemark = "Waiting For Admin Approval.";
                                  $connectionStatus = "";
                                  $employeeName = $CEArray["transfer_employee_id"];
                                  $needle = $employeeName;
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName = $resultArray[$needle]["employee_name"]; 
                                  
                              }
                              if($variant['status'] == "Transferred" && $variant['transfer_status']== "Available" && strtolower($CEArray['request_for_admin']) == "yes" ){
                                $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['admin_aproved_date']));
                                $message = "Waiting for action";
                                $leadType = "";
                                $reason = $CEArray["transfer_reason"];
                                $noteRemark = "Next follow up on ".date("Y-m-d", strtotime($CEArray['next_date']))." ".date("H:i:s", strtotime($CEArray['next_time']));
                                $connectionStatus = "";
                                $employeeName = $CEArray["employee_id"];
                                $needle = $employeeName;
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName = $resultArray[$needle]["employee_name"]; 
                                
                              }
                              if($variant['status'] == "From SE" && $variant['transfer_status'] == "Admin Pending" && $CEArray['request_for_admin'] == "no" ){
                                  // What is the status of "request_for_admin"
                                  // if all the related information is getting copied to related columns
                                  $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['admin_request_date']));
                                  // $message = "The lead is trasnferred from SALES EXECUTIVE ".$CEArray['transfer_employee_id']." to CUSTOMER EXECUTIVE ".$CEArray["employee_id"].". Waiting for admin approval.";
                                  $message = "The lead is trasnferred from SALES EXECUTIVE ";
                                  
                                  $needle = $CEArray['transfer_employee_id'];
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName1 = $resultArray[$needle]["employee_name"];

                                  $message .= $employeeName1;

                                  $message .= " to CUSTOMER EXECUTIVE ";

                                  $needle = $CEArray["employee_id"];
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName2 = $resultArray[$needle]["employee_name"];

                                  $message .= $employeeName2;

                                  $message .= ". Waiting for admin approval.";
                                  
                                  $needle = $CEArray["transfer_employee_id"];
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName = $resultArray[$needle]["employee_name"];

                                  $message .= $employeeName;

                                  $leadType = "";
                                  $reason = $CEArray["transfer_reason"];
                                  $noteRemark = "";
                                  $connectionStatus = "";
                                  $employeeName = $CEArray["employee_id"];
                                  $needle = $employeeName;
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName = $resultArray[$needle]["employee_name"]; 
                              }
                              if($variant['status'] == "From SE" && $variant['transfer_status']== "Available" && $CEArray['request_for_admin'] == "yes" ){
                                  // What is the status of "request_for_admin"
                                  // if all the related information is getting copied to related columns
                                  $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['admin_aproved_date']));
                                  $message = "The lead is trasnferred from SALES EXECUTIVE ".$CEArray['transfer_employee_id']. " on ".$CEArray['admin_request_date']." to ".$CEArray["employee_id"].". Approved by admin.";
                                  $leadType = "";
                                  $reason = $CEArray["transfer_reason"];
                                  $noteRemark = "";
                                  $connectionStatus = "";
                                  $employeeName = $CEArray["employee_id"];
                                  $needle = $CEArray["employee_id"];
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName = $resultArray[$needle]["employee_name"];

                              }
                              if($variant['status'] == "Dead"){
                                  $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['edited_on']));
                                  $message = "Marked dead by CUSTOMER EXECUTIVE ".$CEArray["employee_id"]." on ".date("Y-m-d H:i:s", strtotime($CEArray['edited_on']));
                                  $leadType = "";
                                  $reason = $CEArray["dead_reason"];
                                  $noteRemark = "";
                                  $connectionStatus = "";
                                  $employeeName = $CEArray["employee_id"];
                                  $needle = $CEArray["employee_id"];
                                  $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                    return $needle == $v['employee_id']; 
                                  });
                                  if($needle == 1) $needle = 0;
                                  else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                  if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                  $employeeName = $resultArray[$needle]["employee_name"];

                              }
                            } 

                            if($variant['table_name'] == "assign_leads_sr") {
                              $dbData = $variant["dbContent"];
                                  if($variant['status'] == "Active" && $variant['transfer_status']== "Available"){
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['visit_date']))." ".date("H:i:s", strtotime($ALArray['visit_time']));
                                      $message = "Property Details ".
                                                  $ALArray['property_id']." ".
                                                  $ALArray['sub_property_id']." ".
                                                  $ALArray['variant']." ".
                                                  $ALArray['area']." ".
                                                  $ALArray['location1']." ".
                                                  $ALArray['rate'];
                                      $leadType = "";
                                      $reason = "";
                                      $noteRemark = $ALArray['visit_notes'];
                                      $connectionStatus = "";
                                      $employeeName = $ALArray["employee_id"];

                                      $needle = $ALArray["employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName = $resultArray[$needle]["employee_name"];
                                  }
                                  if($variant['status'] == "Followup" && $variant['transfer_status'] == "Not Available" && $ALArray['followup_or_another_property']=="Follow Up"){
                                    if($ALArray['visit_date'] == '0000-00-00') {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['next_date']))." ".date("H:i:s", strtotime($ALArray['next_time']));
                                    } else {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['visit_date']))." ".date("H:i:s", strtotime($ALArray['visit_time']));
                                    }
                                      $message = "<img src='".$ALArray['photo']."' alt='SE Photo' style='height: 64px; width: 64px;'>";

                                      $property_id = $ALArray['property_id'];
                                      $property_id_name = "";
                                      $sub_property_id = $ALArray['sub_property_id'];
                                      $sub_property_id_name = "";
                                      $variant_id = $ALArray['variant'];
                                      $variant_name = "";
                                      
                                      $needle = $property_id;
                                      $resultArray = array_filter($property_Array, function ($v) use ($needle) {
                                        return $needle == $v['property_name_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["property_title"]) && $resultArray[$needle]["property_title"] != "") 
                                      $property_id_name = $resultArray[$needle]["property_title"];
                                      
                                      $needle = $sub_property_id;
                                      $resultArray = array_filter($sub_property_Array, function ($v) use ($needle) {
                                        return $needle == $v['property_tower_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["property_tower_name"]) && $resultArray[$needle]["property_tower_name"] != "") 
                                      $sub_property_id_name = $resultArray[$needle]["property_tower_name"];
                                      
                                      $variant_name_array = array();
                                      $variant_id = explode(",", $variant_id);
                                      foreach($variant_id as $variantelement) {
                                        $needle =  $variantelement;
                                        $resultArray = array_filter($varient_Array, function ($v) use ($needle) {
                                          return $needle == $v['property_varients_id']; 
                                        });
                                        if($needle == 1) $needle = 0;
                                        else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                        if(isset($resultArray[$needle]["varients"]) && $resultArray[$needle]["varients"] != "") 
                                        $variant_name = $resultArray[$needle]["varients"];
                                        array_push($variant_name_array, $variant_name);
                                      }
                                      $variant_name = implode(",", $variant_name_array);
                                      // $propertyDetails = [
                                      //   'property_id' => $ALArray['property_id'],
                                      //   'sub_property_id' => $ALArray['sub_property_id'],
                                      //   'variant' => $ALArray['variant'],
                                      //   'property_id' => $ALArray['property_id'],
                                      // ];
                                      $propertyDetails = [
                                        'property_name' => $property_id_name,
                                        'sub_property_name' => $sub_property_id_name,
                                        'variant_name' => $variant_name ,
                                        'property_name' => $property_id_name,
                                      ];
                                      
                                      $message .= implode("*", $propertyDetails);
                                      $leadType = $ALArray['lead_type'];
                                      $reason = "";
                                      $noteRemark = $ALArray['notes'];
                                      $connectionStatus = $ALArray['connection_status'];
                                      $employeeName = $ALArray["employee_id"];
                                      
                                      $needle = $ALArray["employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName = $resultArray[$needle]["employee_name"];
                                    
                                  }
                                  if($variant['status'] == "Followup" && $variant['transfer_status']== "Not Available" && $ALArray['followup_or_another_property']=="Another Property"){
                                    
                                    if($ALArray['visit_date'] == '0000-00-00') {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['next_date']))." ".date("H:i:s", strtotime($ALArray['next_time']));
                                    } else {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['visit_date']))." ".date("H:i:s", strtotime($ALArray['visit_time']));
                                    }
                                      $message = "<img src='".$ALArray['photo']."' alt='SE Photo' style='height: 64px; width: 64px;'>";
                                      $leadType = $ALArray['lead_type'];
                                      $reason = "";
                                      $noteRemark = $ALArray['notes'];
                                      $connectionStatus = $ALArray['connection_status'];
                                      $employeeName = $ALArray["employee_id"];
                                      
                                      $needle = $ALArray["employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName = $resultArray[$needle]["employee_name"];
                                  }

                                  if($variant['status'] == "Followup" && $variant['transfer_status']== "Not Available" && $ALArray['followup_or_another_property']==""){
                                    if($ALArray['visit_date'] == '0000-00-00') {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['next_date']))." ".date("H:i:s", strtotime($ALArray['next_time']));
                                    } else {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['visit_date']))." ".date("H:i:s", strtotime($ALArray['visit_time']));
                                    }
                                      $message = "<img src='".$ALArray['photo']."' alt='SE Photo' style='height: 64px; width: 64px;'>";
                                      $leadType = $ALArray['lead_type'];
                                      $reason = "";
                                      $noteRemark = $ALArray['notes'];
                                      $connectionStatus = $ALArray['connection_status'];
                                      $employeeName = $ALArray["employee_id"];
                                      
                                      $needle = $ALArray["employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName = $resultArray[$needle]["employee_name"];
                                  }
                                  
                                  if($variant['status'] == "Followup" && $variant['transfer_status']== "Available" && $ALArray['followup_or_another_property']=="Follow Up"){
                                      
                                    if($ALArray['visit_date'] == '0000-00-00') {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['next_date']))." ".date("H:i:s", strtotime($ALArray['next_time']));
                                    } else {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['visit_date']))." ".date("H:i:s", strtotime($ALArray['visit_time']));
                                    }
                                      $message = "<img src='".$ALArray['photo']."' alt='SE Photo' style='height: 64px; width: 64px;'>";
                                      $leadType = $ALArray['lead_type'];
                                      $reason = "";
                                      $noteRemark = $ALArray['notes'];
                                      $connectionStatus = $ALArray['connection_status'];
                                      $employeeName = $ALArray["employee_id"];
                                      
                                      $needle = $ALArray["employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName = $resultArray[$needle]["employee_name"];
                                  }
                                  if($variant['status'] == "Followup" && $variant['transfer_status']== "Available" && $ALArray['followup_or_another_property']=="Another Property"){
                                      
                                    if($ALArray['visit_date'] == '0000-00-00') {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['next_date']))." ".date("H:i:s", strtotime($ALArray['next_time']));
                                    } else {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['visit_date']))." ".date("H:i:s", strtotime($ALArray['visit_time']));
                                    }
                                      $message = "";
                                      if($ALArray['photo'] != "") {
                                        $photo = "<img src='".$ALArray['photo']."' alt='SE Photo' style='height: 64px; width: 64px;'>";
                                      } else {
                                        $photo = "";
                                      }
                                      $message .= $photo;
                                      $propertyDetails = [
                                        'property_id' => $ALArray['property_id'],
                                        'sub_property_id' => $ALArray['sub_property_id'],
                                        'variant' => $ALArray['variant'],
                                        'property_id' => $ALArray['property_id'],
                                      ];
                                      $message .= implode("*", $propertyDetails);
                                      $leadType = $ALArray['lead_type'];
                                      $reason = "";
                                      $noteRemark = $ALArray['notes'];
                                      $connectionStatus = $ALArray['connection_status'];
                                      $employeeName = $ALArray["employee_id"];
                                      
                                      $needle = $ALArray["employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName = $resultArray[$needle]["employee_name"];
                                  }
                                  if($SE_Leads_Single['status'] == "Followup" && $SE_Leads_Single['transfer_status']== "Available" && $SE_Leads_Single['followup_or_another_property']==""){
                                    if($ALArray['visit_date'] == '0000-00-00') {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['next_date']))." ".date("H:i:s", strtotime($ALArray['next_time']));
                                    } else {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['visit_date']))." ".date("H:i:s", strtotime($ALArray['visit_time']));
                                    }
                                      $message = "";
                                      if($ALArray['photo'] != "") {
                                        $photo = "<img src='".$ALArray['photo']."' alt='SE Photo' style='height: 64px; width: 64px;'>";
                                      } else {
                                        $photo = "";
                                      }
                                      $message .= $photo;
                                      $propertyDetails = [
                                        'property_id' => $ALArray['property_id'],
                                        'sub_property_id' => $ALArray['sub_property_id'],
                                        'variant' => $ALArray['variant'],
                                        'property_id' => $ALArray['property_id'],
                                      ];
                                      $message .= implode("*", $propertyDetails);
                                      $leadType = $ALArray['lead_type'];
                                      $reason = "";
                                      $noteRemark = $ALArray['notes'];
                                      $connectionStatus = $ALArray['connection_status'];
                                      $employeeName = $ALArray["employee_id"];
                                      
                                      $needle = $ALArray["employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName = $resultArray[$needle]["employee_name"];
                                  }
                                  if($variant['status'] == "Active" && $variant['transfer_status']== "Transferred" && strtoupper($ALArray['transfer_employee_type']) == "SALES EXECUTIVE" ){
                                      $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['edited_on']));
                                      // $message = "Lead is transferred to SALES EXECUTIVE ".$ALArray['transfer_employee_id']." by ".$ALArray['employee_id'];
                                      $message = "Lead is transferred to SALES EXECUTIVE ";
                                    
                                      $needle = $ALArray["transfer_employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName = $resultArray[$needle]["employee_name"];
                                      
                                      $message .= $employeeName;
                                      $message .= " by ";
                                      
                                      $needle = $ALArray["employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName1 = $resultArray[$needle]["employee_name"];
                                      $message .= $employeeName1;
                                      
                                      $leadType = "";
                                      $reason = $ALArray["transfer_reason"];
                                      $noteRemark = "";
                                      $connectionStatus = "";
                                      // $employeeName = $ALArray['employee_id'];
                                  }
                                  if($variant['status'] == "Active" && $variant['transfer_status']== "Transferred" && strtoupper($ALArray['transfer_employee_type']) == "SALES EXECUTIVE" && strtolower($ALArray['request_for_admin']) == "no"){
                                      $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date']));
                                      $message = "Lead is transferred to SALES EXECUTIVE ";
                                      
                                      $needle = $ALArray["transfer_employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName1 = $resultArray[$needle]["employee_name"];

                                      $message .= $employeeName1;

                                      $message .= " by ";
                                      $needle = $ALArray["employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName = $resultArray[$needle]["employee_name"];
                                      $message .= $employeeName;
                                      
                                      $message .= " on ".date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date']));
                                      $leadType = "";
                                      $reason = $ALArray["transfer_reason"];
                                      $noteRemark = "";
                                      $connectionStatus = "";
                                      // $employeeName = $ALArray['employee_id'];
                                  }
                                  if($variant['status'] == "Active" && $variant['transfer_status'] == "Transferred" && strtoupper($ALArray['transfer_employee_type']) == "CUSTOMER EXECUTIVE" && strtolower($ALArray['request_for_admin']) == ""){
                                    $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['edited_on']));
                                    $message = "Lead is transferred to CUSTOMER EXECUTIVE ";
                                    
                                    $needle = $ALArray["transfer_employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName1 = $resultArray[$needle]["employee_name"];
                                    
                                    $message .= $employeeName1;
                                    $message .= " by ";
                                    
                                    $needle = $ALArray["employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName = $resultArray[$needle]["employee_name"];
                                    
                                      $message .= $employeeName;
                                      
                                    $leadType = "";
                                    $reason = $ALArray["transfer_reason"];
                                    $noteRemark = "";
                                    $connectionStatus = "";
                                    // $employeeName = $ALArray['employee_id'];
                                  }     
                          
                                  if($variant['status'] == "Transferred" && $variant['transfer_status']== "Admin Pending" && strtoupper($ALArray['assign_employee_type']) == "SALES EXECUTIVE" && strtolower($ALArray['request_for_admin']) == "no"){
                                    $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date']));
                                    $message = "Lead is transferred to SALES EXECUTIVE by ";
                                    
                                    $needle = $ALArray["assign_employee_id"];
                                    $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                      return $needle == $v['employee_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                    $employeeName1 = $resultArray[$needle]["employee_name"];
                                    
                                    $message .= $employeeName1;
                                    $message .= ". Waiting for admin approval.";
                                    $leadType = "";
                                    $reason = $ALArray["transfer_reason"];
                                    $noteRemark = "";
                                    $connectionStatus = "";
                                    // $employeeName = $ALArray['employee_id'];
                                    $needle = $ALArray["employee_id"];
                                    $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                      return $needle == $v['employee_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                    $employeeName = $resultArray[$needle]["employee_name"];
                                  }
                                  
                                  if($variant['status'] == "Transferred" && $variant['transfer_status']== "Admin Pending" && strtoupper($ALArray['assign_employee_type']) == "SALES EXECUTIVE" && strtolower($ALArray['request_for_admin']) == "yes"){
                                    $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date']));
                                    $message = "Lead is transferred to SALES EXECUTIVE ";
                                    
                                    $needle = $ALArray["transfer_employee_id"];
                                    $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                      return $needle == $v['employee_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                    $employeeName1 = $resultArray[$needle]["employee_name"];

                                    $message .= $employeeName1;
                                    $message .= " by ";

                                    $needle = $ALArray["employee_id"];
                                    $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                      return $needle == $v['employee_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                    $employeeName = $resultArray[$needle]["employee_name"];

                                    $message .= $employeeName;
                                    $message .= " on ".date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date'])).". Waiting for admin approval.";
                                    
                                    $leadType = "";
                                    $reason = $ALArray["transfer_reason"];
                                    $noteRemark = "";
                                    $connectionStatus = "";
                                    // $employeeName = $ALArray['employee_id'];
                                  }


                                  // if($variant['status'] == "Transferred" && $variant['transfer_status'] == "Admin pending" && strtoupper($ALArray['transfer_employee_type']) == "SALES EXECUTIVE" && strtolower($ALArray['request_for_admin']) == "no"){
                                  //   $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date']));
                                  //   $message = "Lead is transferred to SALES EXECUTIVE ".$ALArray['transfer_employee_id']." by ".$ALArray['employee_id']." on ".date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date'])).". Waiting for admin approval.";
                                  //   $leadType = "";
                                  //   $reason = $ALArray["transfer_reason"];
                                  //   $noteRemark = "";
                                  //   $connectionStatus = "";
                                  //   $employeeName = $ALArray['employee_id'];
                                  // }
                                  if($variant['status'] == "Transferred" && $variant['transfer_status']== "Available" && strtoupper($ALArray['assign_employee_type']) == "SALES EXECUTIVE" && strtolower($ALArray['request_for_admin']) == "yes"){
                                    $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date']));
                                    $message = "Lead is transferred to SALES EXECUTIVE by ";

                                    $needle = $ALArray["assign_employee_id"];
                                    $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                      return $needle == $v['employee_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                    $employeeName1 = $resultArray[$needle]["employee_name"];
                                    $message .= $employeeName1;
                                    
                                    $message .= ". Admin approved.";
                                    $leadType = "";
                                    $reason = $ALArray["transfer_reason"];
                                    $noteRemark = "";
                                    $connectionStatus = "";
                                    // $employeeName = $ALArray['employee_id'];
                                    $needle = $ALArray["employee_id"];
                                    $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                      return $needle == $v['employee_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                    $employeeName = $resultArray[$needle]["employee_name"];
                                  }                          
                                  if($variant['status'] == "Converted" && $variant['transfer_status']== "Converted"){

                                    $property_id = $ALArray['property_id'];
                                      $property_id_name = "";
                                      $sub_property_id = $ALArray['sub_property_id'];
                                      $sub_property_id_name = "";
                                      $variant_id = $ALArray['variant'];
                                      $variant_name = "";
                                      
                                      $needle = $property_id;
                                      $resultArray = array_filter($property_Array, function ($v) use ($needle) {
                                        return $needle == $v['property_name_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["property_title"]) && $resultArray[$needle]["property_title"] != "") 
                                      $property_id_name = $resultArray[$needle]["property_title"];
                                      
                                      $needle = $sub_property_id;
                                      $resultArray = array_filter($sub_property_Array, function ($v) use ($needle) {
                                        return $needle == $v['property_tower_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["property_tower_name"]) && $resultArray[$needle]["property_tower_name"] != "") 
                                      $sub_property_id_name = $resultArray[$needle]["property_tower_name"];
                                      
                                      $variant_name_array = array();
                                      $variant_id = explode(",", $variant_id);
                                      foreach($variant_id as $variantelement) {
                                        $needle =  $variantelement;
                                        $resultArray = array_filter($varient_Array, function ($v) use ($needle) {
                                          return $needle == $v['property_varients_id']; 
                                        });
                                        if($needle == 1) $needle = 0;
                                        else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                        if(isset($resultArray[$needle]["varients"]) && $resultArray[$needle]["varients"] != "") 
                                        $variant_name = $resultArray[$needle]["varients"];
                                        array_push($variant_name_array, $variant_name);
                                      }
                                      $variant_name = implode(",", $variant_name_array);


                                      $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['added_on']));
                                      $message = "This lead in converted with following details ".
                                      "<br> property_id:- ".$property_id_name.
                                      "<br> sub_property_id:- ".$sub_property_id_name.
                                      "<br> variant:- ".$variant_name.
                                      "<br> area:- ".$ALArray['area'].
                                      "<br> location1:- ".$ALArray['location1'];
                                      $leadType = "";
                                      $reason = "";
                                      $noteRemark = "";
                                      $connectionStatus = "";
                                      // $employeeName = $ALArray["employee_id"];
                                      $needle = $ALArray["employee_id"];
                                    $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                      return $needle == $v['employee_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                    $employeeName = $resultArray[$needle]["employee_name"];
                                  }
                                  if($variant['status'] == "Dead"){
                                    $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['edited_on']));
                                    $needle = $ALArray["employee_id"];
                                    $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                      return $needle == $v['employee_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                    $employeeName = $resultArray[$needle]["employee_name"];

                                    $message = "Marked dead by SALES EXECUTIVE ".$employeeName." on ".date("Y-m-d H:i:s", strtotime($ALArray['edited_on']));
                                    $leadType = "";
                                    $reason = $ALArray["dead_reason"];
                                    $noteRemark = "";
                                    $connectionStatus = "";
                                    // $employeeName = $employeeName;
                                    
                                  }
                            } 
                            
                            if($variant['table_name'] == "converted_leads") {
                              $dbData = $variant["dbContent"];
                                      $property_id = $CONArray['property_name_id'];
                                      $property_id_name = "";
                                      $sub_property_id = $CONArray['property_tower_id'];
                                      $sub_property_id_name = "";
                                      $variant_id = $CONArray['property_variants'];
                                      $variant_name = "";
                                      
                                      $needle = $property_id;
                                      $resultArray = array_filter($property_Array, function ($v) use ($needle) {
                                        return $needle == $v['property_name_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["property_title"]) && $resultArray[$needle]["property_title"] != "") 
                                      $property_id_name = $resultArray[$needle]["property_title"];
                                      
                                      $needle = $sub_property_id;
                                      $resultArray = array_filter($sub_property_Array, function ($v) use ($needle) {
                                        return $needle == $v['property_tower_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["property_tower_name"]) && $resultArray[$needle]["property_tower_name"] != "") 
                                      $sub_property_id_name = $resultArray[$needle]["property_tower_name"];
                                      
                                      $variant_name_array = array();
                                      $variant_id = explode(",", $variant_id);
                                      foreach($variant_id as $variantelement) {
                                        $needle =  $variantelement;
                                        $resultArray = array_filter($varient_Array, function ($v) use ($needle) {
                                          return $needle == $v['property_varients_id']; 
                                        });
                                        if($needle == 1) $needle = 0;
                                        else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                        if(isset($resultArray[$needle]["varients"]) && $resultArray[$needle]["varients"] != "") 
                                        $variant_name = $resultArray[$needle]["varients"];
                                        array_push($variant_name_array, $variant_name);
                                      }
                                      $variant_name = implode(",", $variant_name_array);

                                      $dateShowcase = date("Y-m-d H:i:s", strtotime($CONArray['added_on']));
                                      $message = "This lead in converted with following details ".
                                      "<br> property_name_id:- ".$property_id_name.
                                      "<br> property_variants:- ".$variant_name.
                                      "<br> property_tower_id:- ".$sub_property_id_name.
                                      "<br> agreement_value:- ".$CONArray['agreement_value'].
                                      "<br> registrantion:- ".$CONArray['registrantion'].
                                      "<br> gst:- ".$CONArray['gst'].
                                      "<br> stamp_duty:- ".$CONArray['stamp_duty'].
                                      "<br> commission:- ".$CONArray['commission'].
                                      "<br> quoted_price:- ".$CONArray['quoted_price'].
                                      "<br> sale_price:- ".$CONArray['sale_price'].
                                      "<br> notes:- ".$CONArray['notes'];
                                      $leadType = "";
                                      $reason = "";
                                      $noteRemark = "";
                                      $connectionStatus = "";
                                      // $employeeName = $CONArray["employee_id"];
                                      $needle = $CONArray["employee_id"];
                                      $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                      });
                                      if($needle == 1) $needle = 0;
                                      else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                      if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                      $employeeName = $resultArray[$needle]["employee_name"];
                            }

                            if($variant['table_name'] == "leads") {
                              $dbData = $variant["dbContent"];
                              // $dateShowcase = date("Y-m-d H:i:s", strtotime($LEArray['lead_gen_date']));
                              $dateShowcase = "";
                              $message = "This lead in added and assigned to CUSTOMER EXECUTIVE ";
                              
                              $idleads_assignedLeads = $LEArray['assign_lead_id'];
                              if($id != 0) {
                                $sqlleads_assignedLeads = "select * from assign_leads where assign_leads_id = $idleads_assignedLeads ";
                                $qleads_assignedLeads = $pdo->prepare($sqlleads_assignedLeads);
                                $qleads_assignedLeads->execute(array());      
                                $leads_assignedLeadsArray = $qleads_assignedLeads->fetch(PDO::FETCH_ASSOC);
                                $employee_id = $leads_assignedLeadsArray['employee_id'];

                                $needle = $employee_id;
                                $resultArray = array_filter($employee_Array, function ($v) use ($needle) {
                                  return $needle == $v['employee_id']; 
                                });
                                if($needle == 1) $needle = 0;
                                else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                $employeeName = $resultArray[$needle]["employee_name"]; 
                                $message .= $employeeName;
                              }
                              
                              $leadType = "";
                              $reason = "";
                              $noteRemark = "";
                              $connectionStatus = "";
                              $employeeName = "";
                              
                    }
                    ?>
                    <li class="timeline-item">
                      
                      <?php 
                      if ($roleName == 'SALES EXECUTIVE') { ?>
                      <span
                        class="timeline-indicator timeline-indicator-warning"
                        data-aos="zoom-in"
                        data-aos-delay="200">
                        <i class="ri-map-pin-line ri-20px"></i>
                      </span>
                      <?php } else if ($roleName == 'CUSTOMER EXECUTIVE') { ?>
                        <span
                          class="timeline-indicator timeline-indicator-success"
                          data-aos="zoom-in"
                          data-aos-delay="200">
                          <i class="ri-open-arm-line ri-20px"></i>
                        </span>
                      <?php } else if ($roleName == 'LEADS GENERATOR') { ?>
                        <span
                          class="timeline-indicator timeline-indicator-primary"
                          data-aos="zoom-in"
                          data-aos-delay="200">
                          <i class="ri-donut-chart-fill ri-20px"></i>
                        </span>
                      <?php } else { ?>
                        <span
                          class="timeline-indicator timeline-indicator-dander"
                          data-aos="zoom-in"
                          data-aos-delay="200">
                          <i class="ri-question-mark ri-20px"></i>
                        </span>
                      <?php } ?>

                      <div class="timeline-event card p-0" data-aos="<?php echo $showside; ?>">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                          <h6 class="card-title mb-0">
                            <?php //if($employeeName != "" ) echo $roleName." - ".$employeeName; else echo $roleName; ?>
                            <?php echo $roleName; ?>
                          </h6>
                          <div class="meta">
                            <!-- <span class="badge rounded-pill bg-label-primary"><?php echo $variant['status']; ?></span> -->
                            <!-- <span class="badge rounded-pill bg-label-success"><?php echo $variant['transfer_status']; ?></span> -->
                            <?php
                                if($variant["status"] == "Active")
                                echo '<span class="badge rounded-pill bg-label-danger">';
                                else if($variant["status"] == "Followup")
                                echo '<span class="badge rounded-pill bg-label-info">';
                                else if($variant["status"] == "Assigned")
                                echo '<span class="badge rounded-pill bg-label-primary">';
                                else if($variant["status"] == "Transferred")
                                echo '<span class="badge rounded-pill bg-label-warning">';
                                else if($variant["status"] == "From SE")
                                echo '<span class="badge rounded-pill bg-label-warning">';
                                else if($variant["status"] == "From CE")
                                echo '<span class="badge rounded-pill bg-label-warning">';
                                else if($variant["status"] == "Dead")
                                echo '<span class="badge rounded-pill bg-label-dark">';
                                else if($variant["status"] == "Converted")
                                echo '<span class="badge rounded-pill bg-label-success">';
                                else
                                echo '<span class="badge rounded-pill bg-label-secondary">';
                                echo $variant["status"]; 
                                echo '</span>';
                            ?>
                            <?php if(isset($data['transfer_employee_type'])) { ?>
                            <span class="badge rounded-pill bg-label-info"><?php echo $data['transfer_employee_type']; ?></span>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="card-body demo-vertical-spacing demo-only-element">
                          <p class="mb-2">
                            <?php //var_dump($data); ?>
                          </p>
                          <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <?php
                                    echo $message."<br>";
                                    echo $reason."<br>";
                                    echo $noteRemark."<br>";
                                    // echo "message:- ".$message."<br><br>";
                                    // echo "reason:- ".$reason."<br><br>";
                                    // echo "noteRemark:- ".$noteRemark."<br><br>";
                                    // echo "dateShowcase:- ".$dateShowcase."<br><br>";
                                    // echo "leadType:- ".$leadType."<br><br>";
                                    // echo "noteRemark:- ".$noteRemark."<br><br>";
                                    // echo "connectionStatus:- ".$connectionStatus."<br><br>";
                                    // echo "employeeName:- ".$employeeName."<br><br>";
                                    echo "<pre>";
                                    var_dump($dbData);
                                ?>
                            </div>
                            
                          </div>
                          <div>
                            <p class="text-muted mb-2">Employee Name - <?php echo $employeeName; ?></p>
                            <ul class="list-unstyled users-list d-flex align-items-center avatar-group">
                              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                                <img class="rounded-circle" src="assets/img/avatars/5.png" alt="Avatar">
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="timeline-event-time"><?php 
                        echo date("d-m-Y" , strtotime($variant['timlinedate']));
                        echo "<br>";
                        echo date("H:i:s" , strtotime($variant['timlinedate']));
                        ?>
                        </div>
                      </div>
                      
                    </li>
                    <?php } ?>