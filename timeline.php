<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

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
        
            array_push($AllData, array(
                "table_name" => 'leads',
                "id" => $leadsSingle['id'],
                "status" => "Fresh Lead",
                "transfer_status" => "Fresh Lead",
                "timlinedate" => $timeline_date,
                "added_on" => $leadsSingle['added_on'],
                "edited_on" => $leadsSingle['edited_on'],
            ));
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
            ));
    }
    foreach($SE_Leads_Array as $SE_Leads_Single) {
        $timeline_date_se = null;

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
            ));
    }
    foreach($Converted_Leads_Array as $Converted_Leads_Single) {
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
            ));
    }
    
    // var_dump(count($AllData));
    echo '<pre>';
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
    echo '</pre>';
    // exit();

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

    <title> Timeline  |  Guru Properties</title>

    <meta name="description" content="" />
    <style>
   /* When either input is focused, apply border color to both */
    .prefix-class:focus,
    .user-id-class:focus,
    .user-id-class:focus + .prefix-class,
    .prefix-class:focus + .user-id-class
     {
        border: 2px solid #666cff; /* Highlight both inputs on focus */
    }
  </style>
    <!-- *********** header******************  -->
    e<?php include 'layout/header_js.php'; ?>
     <!-- *********** /header******************  -->
    
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- *********** sidebar ******************  -->
        <?php include 'layout/sidebar.php'; ?>

        <!-- Layout container -->
        <div class="layout-page">
          <?php include 'layout/header.php'; ?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              
              <div class="row overflow-hidden">
                <div class="col-12">
                  <ul class="timeline timeline-center mt-12">
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
                                  $message = "Call Status - ".strtoupper(str_replace("_", " ", $CEArray["connection_status"]));
                                  if(($CEArray["connection_status"]) != 'not_connected' ) {
                                    $leadType = $CEArray["lead_type"];
                                  } else {
                                    $leadType = "";
                                  }
                                  $reason = "";
                                  $noteRemark = strtoupper($CEArray["notes"]);
                                  $connectionStatus = $CEArray["connection_status"];
                                  $employeeName = $CEArray["employee_id"];
                                  
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
                                  
                              }
                              if($variant['status'] == "Active" && $variant['transfer_status']== "Transferred") {
                                  // What is the status of "request_for_admin"
                                  $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['edited_on']));
                                  $message = "The lead is transfer to ".$CEArray["transfer_employee_type"]." - ".$CEArray["transfer_employee_id"];
                                  $leadType = $CEArray["lead_type"];
                                  $reason = $CEArray["transfer_reason"];
                                  // if($CEArray['request_for_admin'] == "") {
                                  //   $noteRemark = "Waiting For Admin Approval.";
                                  // } else if(strtolower($CEArray['request_for_admin']) == "yes") {
                                  //   $noteRemark = "Admin Approved.";
                                  // }
                                  $noteRemark = "";
                                  $connectionStatus = $CEArray["connection_status"];
                                  $employeeName = $CEArray["employee_id"];
                                  
                              }

                              if($variant['status'] == "Assigned" && $variant['transfer_status']== "Transferred"){
                                  $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['edited_on']));
                                  $message = "This lead is assigned to the ". $CEArray['assign_employee_type'] ." - ".$CEArray['transfer_employee_id'];
                                  $leadType = "";
                                  $reason = $CEArray['transfer_reason'];
                                  $noteRemark = "";
                                  $connectionStatus = "";
                                  $employeeName = $CEArray['employee_id'];
                                  
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
                                  
                              }
                              if($variant['status'] == "Transferred" && $variant['transfer_status']== "Available" && strtolower($CEArray['request_for_admin']) == "yes" ){
                                $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['admin_aproved_date']));
                                $message = "Waiting for action";
                                $leadType = "";
                                $reason = $CEArray["transfer_reason"];
                                $noteRemark = "Next follow up on ".date("Y-m-d", strtotime($CEArray['next_date']))." ".date("H:i:s", strtotime($CEArray['next_time']));
                                $connectionStatus = "";
                                $employeeName = $CEArray["employee_id"];
                                
                              }
                              if($variant['status'] == "From SE" && $variant['transfer_status'] == "Admin Pending" && $CEArray['request_for_admin'] == "no" ){
                                  // What is the status of "request_for_admin"
                                  // if all the related information is getting copied to related columns
                                  $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['admin_request_date']));
                                  $message = "The lead is trasnferred from SALES EXECUTIVE ".$CEArray['transfer_employee_id']." to CUSTOMER EXECUTIVE ".$CEArray["employee_id"].". Waiting for admin approval.";
                                  $leadType = "";
                                  $reason = $CEArray["transfer_reason"];
                                  $noteRemark = "";
                                  $connectionStatus = "";
                                  $employeeName = $CEArray["employee_id"];
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
                              }
                              if($variant['status'] == "Dead"){
                                  $dateShowcase = date("Y-m-d H:i:s", strtotime($CEArray['edited_on']));
                                  $message = "Marked dead by CUSTOMER EXECUTIVE ".$CEArray["employee_id"]." on ".date("Y-m-d H:i:s", strtotime($CEArray['edited_on']));
                                  $leadType = "";
                                  $reason = $CEArray["dead_reason"];
                                  $noteRemark = "";
                                  $connectionStatus = "";
                                  $employeeName = $CEArray["employee_id"];
                              }
                            } 

                            if($variant['table_name'] == "assign_leads_sr") {
                              
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
                                  }
                                  if($variant['status'] == "Followup" && $variant['transfer_status']== "Not Available" && $ALArray['followup_or_another_property']=="Follow Up"){
                                    if($ALArray['visit_date'] == '0000-00-00') {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['next_date']))." ".date("H:i:s", strtotime($ALArray['next_time']));
                                    } else {
                                      $dateShowcase = date("Y-m-d", strtotime($ALArray['visit_date']))." ".date("H:i:s", strtotime($ALArray['visit_time']));
                                    }
                                      $message = "<img src='".$ALArray['photo']."' alt='SE Photo' style='height: 64px; width: 64px;'>";
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
                                  }
                                  if($variant['status'] == "Active" && $variant['transfer_status']== "Transferred" && strtoupper($ALArray['transfer_employee_type']) == "SALES EXECUTIVE" ){
                                      $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['edited_on']));
                                      $message = "Lead is transferred to SALES EXECUTIVE ".$ALArray['transfer_employee_id']." by ".$ALArray['employee_id'];
                                      $leadType = "";
                                      $reason = $ALArray["transfer_reason"];
                                      $noteRemark = "";
                                      $connectionStatus = "";
                                      $employeeName = $ALArray['employee_id'];
                                  }
                                  if($variant['status'] == "Active" && $variant['transfer_status']== "Transferred" && strtoupper($ALArray['transfer_employee_type']) == "SALES EXECUTIVE" && strtolower($ALArray['request_for_admin']) == "no"){
                                      $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date']));
                                      $message = "Lead is transferred to SALES EXECUTIVE ".$ALArray['transfer_employee_id']." by ".$ALArray['employee_id']." on ".date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date']));
                                      $leadType = "";
                                      $reason = $ALArray["transfer_reason"];
                                      $noteRemark = "";
                                      $connectionStatus = "";
                                      $employeeName = $ALArray['employee_id'];
                                  }
                                  if($variant['status'] == "Active" && $variant['transfer_status'] == "Transferred" && strtoupper($ALArray['transfer_employee_type']) == "CUSTOMER EXECUTIVE" && strtolower($ALArray['request_for_admin']) == ""){
                                    $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['edited_on']));
                                    $message = "Lead is transferred to CUSTOMER EXECUTIVE ".$ALArray['transfer_employee_id']." by ".$ALArray['employee_id'];
                                    $leadType = "";
                                    $reason = $ALArray["transfer_reason"];
                                    $noteRemark = "";
                                    $connectionStatus = "";
                                    $employeeName = $ALArray['employee_id'];
                                  }     
                          
                                  if($variant['status'] == "Transferred" && $variant['transfer_status']== "Admin Pending" && strtoupper($ALArray['assign_employee_type']) == "SALES EXECUTIVE" && strtolower($ALArray['request_for_admin']) == "no"){
                                    $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date']));
                                    $message = "Lead is transferred to SALES EXECUTIVE by ".$ALArray['assign_employee_id'].". Waiting for admin approval.";
                                    $leadType = "";
                                    $reason = $ALArray["transfer_reason"];
                                    $noteRemark = "";
                                    $connectionStatus = "";
                                    $employeeName = $ALArray['employee_id'];
                                  }
                                  
                                  if($variant['status'] == "Transferred" && $variant['transfer_status']== "Admin Pending" && strtoupper($ALArray['assign_employee_type']) == "SALES EXECUTIVE" && strtolower($ALArray['request_for_admin']) == "yes"){
                                    $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date']));
                                    $message = "Lead is transferred to SALES EXECUTIVE ".$ALArray['transfer_employee_id']." by ".$ALArray['employee_id']." on ".date("Y-m-d H:i:s", strtotime($ALArray['admin_request_date'])).". Waiting for admin approval.";
                                    $leadType = "";
                                    $reason = $ALArray["transfer_reason"];
                                    $noteRemark = "";
                                    $connectionStatus = "";
                                    $employeeName = $ALArray['employee_id'];
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
                                    $message = "Lead is transferred to SALES EXECUTIVE by ".$ALArray['assign_employee_id'].". Admin approved.";
                                    $leadType = "";
                                    $reason = $ALArray["transfer_reason"];
                                    $noteRemark = "";
                                    $connectionStatus = "";
                                    $employeeName = $ALArray['employee_id'];
                                  }                          
                                  if($variant['status'] == "Converted" && $variant['transfer_status']== "Converted"){
                                      $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['added_on']));
                                      $message = "This lead in converted with following details ".
                                      "<br> property_id:- ".$ALArray['property_id'].
                                      "<br> sub_property_id:- ".$ALArray['sub_property_id'].
                                      "<br> variant:- ".$ALArray['variant'].
                                      "<br> area:- ".$ALArray['area'].
                                      "<br> location1:- ".$ALArray['location1'];
                                      $leadType = "";
                                      $reason = "";
                                      $noteRemark = "";
                                      $connectionStatus = "";
                                      $employeeName = $ALArray["employee_id"];
                                  }
                                  if($variant['status'] == "Dead"){
                                    $dateShowcase = date("Y-m-d H:i:s", strtotime($ALArray['edited_on']));
                                    $message = "Marked dead by SALES EXECUTIVE ".$ALArray["employee_id"]." on ".date("Y-m-d H:i:s", strtotime($ALArray['edited_on']));
                                    $leadType = "";
                                    $reason = $ALArray["dead_reason"];
                                    $noteRemark = "";
                                    $connectionStatus = "";
                                    $employeeName = $ALArray["employee_id"];
                                  }
                            } 
                            
                            if($variant['table_name'] == "converted_leads") {
                                      $dateShowcase = date("Y-m-d H:i:s", strtotime($CONArray['added_on']));
                                      $message = "This lead in converted with following details ".
                                      "<br> property_name_id:- ".$CONArray['property_name_id'].
                                      "<br> property_variants:- ".$CONArray['property_variants'].
                                      "<br> property_tower_id:- ".$CONArray['property_tower_id'].
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
                                      $employeeName = $CONArray["employee_id"];
                            }

                            if($variant['table_name'] == "leads") {
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
                                $message .= $employee_id;
                              }
                              
                              $leadType = "";
                              $reason = "";
                              $noteRemark = "";
                              $connectionStatus = "";
                              $employeeName = "";
                              
                    }
                    ?>
                    <li class="timeline-item">
                      <span
                        class="timeline-indicator timeline-indicator-primary"
                        data-aos="zoom-in"
                        data-aos-delay="200">
                        <i class="ri-brush-line ri-20px"></i>
                      </span>
                      <div class="timeline-event card p-0" data-aos="<?php echo $showside; ?>">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                          <h6 class="card-title mb-0"><?php if($employeeName != "" ) echo $roleName." - ".$employeeName; else echo $roleName; ?></h6>
                          <div class="meta">
                            <span class="badge rounded-pill bg-label-primary"><?php echo $variant['status']; ?></span>
                            <span class="badge rounded-pill bg-label-success"><?php echo $variant['transfer_status']; ?></span>
                            <?php if(isset($data['transfer_employee_type'])) { ?>
                            <span class="badge rounded-pill bg-label-info"><?php echo $data['transfer_employee_type']; ?></span>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="card-body">
                          <p class="mb-2">
                            <?php //var_dump($data); ?>
                          </p>
                          <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <?php
                                    echo "dateShowcase:- ".$dateShowcase."<br><br>";
                                    echo "message:- ".$message."<br><br>";
                                    echo "leadType:- ".$leadType."<br><br>";
                                    echo "reason:- ".$reason."<br><br>";
                                    echo "noteRemark:- ".$noteRemark."<br><br>";
                                    echo "connectionStatus:- ".$connectionStatus."<br><br>";
                                    echo "employeeName:- ".$employeeName."<br><br>";
                                ?>
                            </div>
                          </div>
                        </div>
                        <div class="timeline-event-time"><?php 
                        echo date("d-m-Y" , strtotime($variant['timlinedate']));
                        echo "<br>";
                        echo date("H:i:s" , strtotime($variant['timlinedate']));
                        ?></div>
                      </div>
                    </li>
                    <?php } ?>
                    <!-- <li class="timeline-item">
                      <span
                        class="timeline-indicator timeline-indicator-success"
                        data-aos="zoom-in"
                        data-aos-delay="200">
                        <i class="ri-question-mark ri-20px"></i>
                      </span>
                      <div class="timeline-event card p-0" data-aos="fade-left">
                        <h6 class="card-header">Survey Report</h6>
                        <div class="card-body">
                          <div class="d-flex flex-wrap mb-6">
                            <div>
                              <div class="avatar avatar-xs me-4">
                                <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                              </div>
                            </div>
                            <span>assigned this task to <span class="fw-medium">Sarah</span></span>
                          </div>
                          <ul class="list-unstyled">
                            <li class="d-flex">
                              <div>
                                <div class="avatar avatar-xs me-4">
                                  <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                                </div>
                              </div>
                              <div class="mb-4 w-100">
                                <div class="progress bg-label-danger" style="height: 6px">
                                  <div
                                    class="progress-bar bg-danger"
                                    role="progressbar"
                                    style="width: 48.7%"
                                    aria-valuenow="25"
                                    aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                                <small>Jquery</small>
                              </div>
                            </li>
                            <li class="d-flex">
                              <div>
                                <div class="avatar avatar-xs me-4">
                                  <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                                </div>
                              </div>
                              <div class="mb-4 w-100">
                                <div class="progress" style="height: 6px">
                                  <div
                                    class="progress-bar bg-primary"
                                    role="progressbar"
                                    style="width: 31.3%"
                                    aria-valuenow="25"
                                    aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                                <small>React</small>
                                <small>React</small>
                                <small>React</small>
                                <small>React</small>
                              </div>
                            </li>
                            <li class="d-flex">
                              <div>
                                <div class="avatar avatar-xs me-4">
                                  <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                                </div>
                              </div>
                              <div class="mb-4 w-100">
                                <div class="progress bg-label-warning" style="height: 6px">
                                  <div
                                    class="progress-bar bg-warning"
                                    role="progressbar"
                                    style="width: 30%"
                                    aria-valuenow="25"
                                    aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                                <small>Angular</small>
                              </div>
                            </li>
                            <li class="d-flex">
                              <div>
                                <div class="avatar avatar-xs me-4">
                                  <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                </div>
                              </div>
                              <div class="mb-4 w-100">
                                <div class="progress bg-label-info" style="height: 6px">
                                  <div
                                    class="progress-bar bg-info"
                                    role="progressbar"
                                    style="width: 15%"
                                    aria-valuenow="25"
                                    aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                                <small>VUE</small>
                              </div>
                            </li>
                            <li class="d-flex">
                              <div>
                                <div class="avatar avatar-xs me-4">
                                  <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                </div>
                              </div>
                              <div class="w-100">
                                <div class="progress bg-label-success" style="height: 6px">
                                  <div
                                    class="progress-bar bg-success"
                                    role="progressbar"
                                    style="width: 10%"
                                    aria-valuenow="25"
                                    aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                                <small>Laravel</small>
                              </div>
                            </li>
                          </ul>
                        </div>
                        <div class="timeline-event-time">2nd January</div>
                      </div>
                    </li> -->
                  </ul>
                </div>
              </div>
              
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php //include_once('layout/footer.php'); ?>
            <?php include 'layout/footer.php'; ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
      <!-- Footer -->
        <?php include 'layout/footer_js.php'; ?>
      <!-- / Footer -->

      <script>
        $(document).ready(function() {
    $('#roleDropdown').change(function() {
        var selectedRole = $(this).val();
        var prefix = '';

        if (selectedRole === 'CUSTOMER EXECUTIVE') {
            prefix = 'CE';
        } else if (selectedRole === 'SALES EXECUTIVE') {
            prefix = 'SE';
        }

        // Set the prefix in the input field
        $('#prefixInput').val(prefix + '-');
    });
});
      </script>

<script>
function toggleReasonBox() {
    const checkbox = document.getElementById('customCheckDanger');
    const reasonBox = document.getElementById('reasonBox');

    if (checkbox.checked) {
        reasonBox.style.display = 'block';
    } else {
        reasonBox.style.display = 'none';
    }
}

// Initially hide the reason box if the checkbox is not checked
toggleReasonBox();
</script>
    
  </body>
</html>
