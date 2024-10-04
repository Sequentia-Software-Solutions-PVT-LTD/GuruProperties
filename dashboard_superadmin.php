<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

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

    <title> Dashboard |  Guru Properties</title>

    <meta name="description" content="" />

    <!-- *********** header******************  -->
    <?php include 'layout/header_js.php'; ?>
     <!-- *********** /header******************  -->

     <style>
        .mar-top {
            margin-top: -12px;
        }
        .heading-text {
            color:#000;
        }
     </style>
    
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

            <!-- Customer Executive Performance Weekly -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h3 class="card-header mar-bot-10 heading-text">Weekly Performance </h3>
              <h5 class="card-header mar-bot-10">Customer Executive Performance Weekly</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <th> Name</th>
                                <th> Fresh Leads </th>
                                <th> Followup Leads</th>
                                <th> Transferred Leads</th>
                                <th> Assigned Leads</th>
                                <th> Received Leads</th>
                                <th> Dead Leads</th>
                                <!-- <th> Addedon </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                // $sql = "SELECT * FROM assign_leads ";
                                $sql = " SELECT 
                                            employee_name,
                                            COUNT(CASE WHEN fresh_lead = 1 THEN 1 END) AS active_leads,
                                            COUNT(CASE WHEN status = 'Followup' and transfer_status = 'Available' THEN 1 END) AS followup_leads,
                                            COUNT(CASE WHEN status = 'Transferred' and transfer_status = 'Available' THEN 1 END) AS transferred_leads,
                                            COUNT(CASE WHEN status = 'Assigned' and transfer_status = 'Transferred' THEN 1 END) AS assigned_leads,
                                            COUNT(CASE WHEN status = 'From SE'  THEN 1 END) AS received_leads,
                                            COUNT(CASE WHEN status = 'Dead' THEN 1 END) AS dead_leads
                                        FROM assign_leads
                                        -- WHERE added_on >= CURDATE() - INTERVAL 7 DAY          -- Last 7 days logic   
                                        -- WHERE YEARWEEK(added_on, 1) = YEARWEEK(CURDATE(), 1)     -- and this is sunday to saturday week logic
                                        WHERE YEARWEEK(added_on, 1) = YEARWEEK(CURDATE() - INTERVAL 1 WEEK, 1)
                                        GROUP BY employee_name
                                    ";
                                // $sql = "SELECT * FROM assign_leads ";
                                $q = $pdo->query($sql);

                                // print_r($sql);
                                // exit();

                                foreach ($pdo->query($sql) as $row) 
                                { 
                                    $emp_name = $row["employee_name"];
                                    $sqlemp = "select * from employee where employee_name = '$emp_name' ";
                                    $q = $pdo->prepare($sqlemp);
                                    $q->execute(array());      
                                    $row_emp = $q->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row["employee_name"]; ?></td> -->
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                        <!-- <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"> -->
                                        <img src="assets/img/avatars/<?php echo $row_emp["login_photo"];?>" alt="Avatar" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="name text-truncate h6 mb-0"><?php echo $row["employee_name"]; ?></span>
                                        <small class="user_name text-truncate"><?php echo $row_emp["user_id"]; ?></small>
                                    </div>
                                    </div>
                                </td>
                                <td><?php echo $row["active_leads"]; ?></td>
                                <td><?php echo $row["followup_leads"]; ?></td>
                                <td><?php echo $row["transferred_leads"]; ?></td>
                                <td><?php echo $row["assigned_leads"]; ?></td>
                                <td><?php echo $row["received_leads"]; ?></td>
                                <td><?php echo $row["dead_leads"]; ?></td>
                                <!-- <td><?php echo $row["added_on"]; ?></td> -->
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
               <!-- *************** - /main containt in page write here - **********************  -->
            </div>
            <!-- / Content -->
             
            <!-- Sales Executive Performance Weekly -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h5 class="card-header mar-bot-10"style="margin-top:10px;">Sales Executive Performance Weekly</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <th> Name</th>
                                <th> Visited Leads </th>
                                <th> Followup Leads</th>
                                <th> Transferred Leads</th>
                                <!-- <th> Assigned Leads</th> -->
                                <!-- <th> Received Leads</th> -->
                                <th> Converted Leads</th>
                                <th> Dead Leads</th>
                                <!-- <th> Addedon </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                // $sql = "SELECT * FROM assign_leads ";
                                $sql_sr = " SELECT 
                                            employee_name,
                                            COUNT(CASE WHEN status = 'Active' and transfer_status = 'Available' THEN 1 END) AS received_leads,
                                            COUNT(CASE WHEN status = 'Followup' and transfer_status = 'Available' THEN 1 END) AS followup_leads,
                                            COUNT(CASE WHEN status = 'Transferred' and transfer_status = 'Available' THEN 1 END) AS transferred_leads,
                                            COUNT(CASE WHEN status = 'Converted'  THEN 1 END) AS converted_leads,
                                            COUNT(CASE WHEN status = 'Dead' THEN 1 END) AS dead_leads
                                        FROM assign_leads_sr
                                        -- WHERE added_on >= CURDATE() - INTERVAL 7 DAY
                                        -- WHERE YEARWEEK(added_on, 1) = YEARWEEK(CURDATE(), 1) 
                                        WHERE YEARWEEK(added_on, 1) = YEARWEEK(CURDATE() - INTERVAL 1 WEEK, 1)         
                                        GROUP BY employee_name
                                    ";
                                // $sql = "SELECT * FROM assign_leads ";
                                $q = $pdo->query($sql_sr);

                                // print_r($sql_sr);
                                // exit();

                                foreach ($pdo->query($sql_sr) as $row_sr) 
                                { 
                                    $emp_name = $row_sr["employee_name"];
                                    $sqlemp = "select * from employee where employee_name = '$emp_name' ";
                                    $q = $pdo->prepare($sqlemp);
                                    $q->execute(array());      
                                    $row_emp = $q->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row_sr["employee_name"]; ?></td> -->
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                        <!-- <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"> -->
                                        <img src="assets/img/avatars/<?php echo $row_emp["login_photo"];?>" alt="Avatar" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="name text-truncate h6 mb-0"><?php echo $row_sr["employee_name"]; ?></span>
                                        <small class="user_name text-truncate"><?php echo $row_emp["user_id"]; ?></small>
                                    </div>
                                    </div>
                                </td>
                                <td><?php echo $row_sr["received_leads"]; ?></td>
                                <td><?php echo $row_sr["followup_leads"]; ?></td>
                                <td><?php echo $row_sr["transferred_leads"]; ?></td>
                                <td><?php echo $row_sr["converted_leads"]; ?></td>
                                <td><?php echo $row_sr["dead_leads"]; ?></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
               <!-- *************** - /main containt in page write here - **********************  -->
            </div>
            <!-- / Content -->

            <hr>

            <!-- Customer Executive Performance Daily -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h3 class="card-header mar-bot-10 heading-text">Today's Performance </h3>
              <h5 class="card-header mar-bot-10">Customer Executive Performance Today's</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <th>  Name</th>
                                <th> Fresh Leads </th>
                                <th> Followup Leads</th>
                                <th> Transferred Leads</th>
                                <th> Assigned Leads</th>
                                <th> Received Leads</th>
                                <th> Dead Leads</th>
                                <!-- <th> Addedon </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                // $sql = "SELECT * FROM assign_leads ";
                                $sql = " SELECT 
                                            employee_name,
                                            COUNT(CASE WHEN fresh_lead = 1 THEN 1 END) AS active_leads,
                                            COUNT(CASE WHEN status = 'Followup' and transfer_status = 'Available' THEN 1 END) AS followup_leads,
                                            COUNT(CASE WHEN status = 'Transferred' and transfer_status = 'Available' THEN 1 END) AS transferred_leads,
                                            COUNT(CASE WHEN status = 'Assigned' and transfer_status = 'Transferred' THEN 1 END) AS assigned_leads,
                                            COUNT(CASE WHEN status = 'From SE'  THEN 1 END) AS received_leads,
                                            COUNT(CASE WHEN status = 'Dead' THEN 1 END) AS dead_leads
                                        FROM assign_leads
                                        WHERE added_on >= CURDATE()          -- Last 7 days logic   
                                        -- WHERE YEARWEEK(added_on, 1) = YEARWEEK(CURDATE(), 1)     -- and this is sunday to saturday week logic
                                        GROUP BY employee_name
                                    ";
                                // $sql = "SELECT * FROM assign_leads ";
                                $q = $pdo->query($sql);

                                // print_r($sql);
                                // exit();

                                foreach ($pdo->query($sql) as $row) 
                                { 
                                    $emp_name = $row["employee_name"];
                                    $sqlemp = "select * from employee where employee_name = '$emp_name' ";
                                    $q = $pdo->prepare($sqlemp);
                                    $q->execute(array());      
                                    $row_emp = $q->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row["employee_name"]; ?></td> -->
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                        <!-- <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"> -->
                                        <img src="assets/img/avatars/<?php echo $row_emp["login_photo"];?>" alt="Avatar" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="name text-truncate h6 mb-0"><?php echo $row["employee_name"]; ?></span>
                                        <small class="user_name text-truncate"><?php echo $row_emp["user_id"]; ?></small>
                                    </div>
                                    </div>
                                </td>
                                <td><?php echo $row["active_leads"]; ?></td>
                                <td><?php echo $row["followup_leads"]; ?></td>
                                <td><?php echo $row["transferred_leads"]; ?></td>
                                <td><?php echo $row["assigned_leads"]; ?></td>
                                <td><?php echo $row["received_leads"]; ?></td>
                                <td><?php echo $row["dead_leads"]; ?></td>
                                <!-- <td><?php echo $row["added_on"]; ?></td> -->
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
               <!-- *************** - /main containt in page write here - **********************  -->
            </div>
            <!-- / Content -->

            <!-- Sales Executive Performance Daily -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h5 class="card-header mar-bot-10" style="margin-top:10px;">Sales Executive Performance Today's</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <th>  Name</th>
                                <th> Visited Leads </th>
                                <th> Followup Leads</th>
                                <th> Transferred Leads</th>
                                <!-- <th> Assigned Leads</th> -->
                                <!-- <th> Received Leads</th> -->
                                <th> Converted Leads</th>
                                <th> Dead Leads</th>
                                <!-- <th> Addedon </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                // $sql = "SELECT * FROM assign_leads ";
                                $sql_sr = " SELECT 
                                            employee_name,
                                            COUNT(CASE WHEN status = 'Active' and transfer_status = 'Available' THEN 1 END) AS received_leads,
                                            COUNT(CASE WHEN status = 'Followup' and transfer_status = 'Available' THEN 1 END) AS followup_leads,
                                            COUNT(CASE WHEN status = 'Transferred' and transfer_status = 'Available' THEN 1 END) AS transferred_leads,
                                            COUNT(CASE WHEN status = 'Converted'  THEN 1 END) AS converted_leads,
                                            COUNT(CASE WHEN status = 'Dead' THEN 1 END) AS dead_leads
                                        FROM assign_leads_sr
                                        WHERE added_on >= CURDATE()        
                                        GROUP BY employee_name
                                    ";
                                // $sql = "SELECT * FROM assign_leads ";
                                $q = $pdo->query($sql_sr);

                                // print_r($sql_sr);
                                // exit();

                                foreach ($pdo->query($sql_sr) as $row_sr) 
                                { 
                                    $emp_name = $row_sr["employee_name"];
                                    $sqlemp = "select * from employee where employee_name = '$emp_name' ";
                                    $q = $pdo->prepare($sqlemp);
                                    $q->execute(array());      
                                    $row_emp = $q->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row_sr["employee_name"]; ?></td> -->
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                        <!-- <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"> -->
                                        <img src="assets/img/avatars/<?php echo $row_emp["login_photo"];?>" alt="Avatar" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="name text-truncate h6 mb-0"><?php echo $row_sr["employee_name"]; ?></span>
                                        <small class="user_name text-truncate"><?php echo $row_emp["user_id"]; ?></small>
                                    </div>
                                    </div>
                                </td>
                                <td><?php echo $row_sr["received_leads"]; ?></td>
                                <td><?php echo $row_sr["followup_leads"]; ?></td>
                                <td><?php echo $row_sr["transferred_leads"]; ?></td>
                                <td><?php echo $row_sr["converted_leads"]; ?></td>
                                <td><?php echo $row_sr["dead_leads"]; ?></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
               <!-- *************** - /main containt in page write here - **********************  -->
            </div>
            <!-- / Content -->

            <hr>

            <!-- Customer Executive Performance Yesterday -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h3 class="card-header mar-bot-10 heading-text">Yesterday's Performance </h3>
              <h5 class="card-header mar-bot-10">Customer Executive Performance Yesterday</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <th>  Name</th>
                                <th> Fresh Leads </th>
                                <th> Followup Leads</th>
                                <th> Transferred Leads</th>
                                <th> Assigned Leads</th>
                                <th> Received Leads</th>
                                <th> Dead Leads</th>
                                <!-- <th> Addedon </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                // $sql = "SELECT * FROM assign_leads ";
                                $sql = " SELECT 
                                            employee_name,
                                            COUNT(CASE WHEN fresh_lead = 1 THEN 1 END) AS active_leads,
                                            COUNT(CASE WHEN status = 'Followup' and transfer_status = 'Available' THEN 1 END) AS followup_leads,
                                            COUNT(CASE WHEN status = 'Transferred' and transfer_status = 'Available' THEN 1 END) AS transferred_leads,
                                            COUNT(CASE WHEN status = 'Assigned' and transfer_status = 'Transferred' THEN 1 END) AS assigned_leads,
                                            COUNT(CASE WHEN status = 'From SE'  THEN 1 END) AS received_leads,
                                            COUNT(CASE WHEN status = 'Dead' THEN 1 END) AS dead_leads
                                        FROM assign_leads
                                        WHERE added_on >= CURDATE() - INTERVAL 1 DAY          -- Last 7 days logic   
                                        AND added_on < CURDATE()   
                                        -- WHERE YEARWEEK(added_on, 1) = YEARWEEK(CURDATE(), 1)     -- and this is sunday to saturday week logic
                                        GROUP BY employee_name
                                    ";
                                // $sql = "SELECT * FROM assign_leads ";
                                $q = $pdo->query($sql);

                                // print_r($sql);
                                // exit();

                                foreach ($pdo->query($sql) as $row) 
                                { 
                                    $emp_name = $row["employee_name"];
                                    $sqlemp = "select * from employee where employee_name = '$emp_name' ";
                                    $q = $pdo->prepare($sqlemp);
                                    $q->execute(array());      
                                    $row_emp = $q->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row["employee_name"]; ?></td> -->
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                        <!-- <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"> -->
                                        <img src="assets/img/avatars/<?php echo $row_emp["login_photo"];?>" alt="Avatar" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="name text-truncate h6 mb-0"><?php echo $row["employee_name"]; ?></span>
                                        <small class="user_name text-truncate"><?php echo $row_emp["user_id"]; ?></small>
                                    </div>
                                    </div>
                                </td>
                                <td><?php echo $row["active_leads"]; ?></td>
                                <td><?php echo $row["followup_leads"]; ?></td>
                                <td><?php echo $row["transferred_leads"]; ?></td>
                                <td><?php echo $row["assigned_leads"]; ?></td>
                                <td><?php echo $row["received_leads"]; ?></td>
                                <td><?php echo $row["dead_leads"]; ?></td>
                                <!-- <td><?php echo $row["added_on"]; ?></td> -->
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
               <!-- *************** - /main containt in page write here - **********************  -->
            </div>
            <!-- / Content -->

            <!-- Sales Executive Performance Yesterday -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h5 class="card-header mar-bot-10" style="margin-top:10px;">Sales Executive Performance Yesterday</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <th> Name</th>
                                <th> Visited Leads </th>
                                <th> Followup Leads</th>
                                <th> Transferred Leads</th>
                                <!-- <th> Assigned Leads</th> -->
                                <!-- <th> Received Leads</th> -->
                                <th> Converted Leads</th>
                                <th> Dead Leads</th>
                                <!-- <th> Addedon </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                // $sql = "SELECT * FROM assign_leads ";
                                $sql_sr = " SELECT 
                                            employee_name,
                                            COUNT(CASE WHEN status = 'Active' and transfer_status = 'Available' THEN 1 END) AS received_leads,
                                            COUNT(CASE WHEN status = 'Followup' and transfer_status = 'Available' THEN 1 END) AS followup_leads,
                                            COUNT(CASE WHEN status = 'Transferred' and transfer_status = 'Available' THEN 1 END) AS transferred_leads,
                                            COUNT(CASE WHEN status = 'Converted'  THEN 1 END) AS converted_leads,
                                            COUNT(CASE WHEN status = 'Dead' THEN 1 END) AS dead_leads
                                        FROM assign_leads_sr
                                        WHERE added_on >= CURDATE() - INTERVAL 1 DAY 
                                        AND added_on < CURDATE()  
                                        GROUP BY employee_name
                                    ";
                                // $sql = "SELECT * FROM assign_leads ";
                                $q = $pdo->query($sql_sr);

                                // print_r($sql_sr);
                                // exit();

                                foreach ($pdo->query($sql_sr) as $row_sr) 
                                { 
                                    $emp_name = $row_sr["employee_name"];
                                    $sqlemp = "select * from employee where employee_name = '$emp_name' ";
                                    $q = $pdo->prepare($sqlemp);
                                    $q->execute(array());      
                                    $row_emp = $q->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row_sr["employee_name"]; ?></td> -->
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                        <!-- <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"> -->
                                        <img src="assets/img/avatars/<?php echo $row_emp["login_photo"];?>" alt="Avatar" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="name text-truncate h6 mb-0"><?php echo $row_sr["employee_name"]; ?></span>
                                        <small class="user_name text-truncate"><?php echo $row_emp["user_id"]; ?></small>
                                    </div>
                                    </div>
                                </td>
                                <td><?php echo $row_sr["received_leads"]; ?></td>
                                <td><?php echo $row_sr["followup_leads"]; ?></td>
                                <td><?php echo $row_sr["transferred_leads"]; ?></td>
                                <td><?php echo $row_sr["converted_leads"]; ?></td>
                                <td><?php echo $row_sr["dead_leads"]; ?></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
               <!-- *************** - /main containt in page write here - **********************  -->
            </div>
            <!-- / Content -->

            <hr>

            <!-- Customer Executive Performance Last Month -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h3 class="card-header mar-bot-10 heading-text">Last Month Performance </h3>
              <h5 class="card-header mar-bot-10">Customer Executive Performance Last Month</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <th>  Name</th>
                                <th> Fresh Leads </th>
                                <th> Followup Leads</th>
                                <th> Transferred Leads</th>
                                <th> Assigned Leads</th>
                                <th> Received Leads</th>
                                <th> Dead Leads</th>
                                <!-- <th> Addedon </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                // $sql = "SELECT * FROM assign_leads ";
                                $sql = " SELECT 
                                            employee_name,
                                            COUNT(CASE WHEN fresh_lead = 1 THEN 1 END) AS active_leads,
                                            COUNT(CASE WHEN status = 'Followup' and transfer_status = 'Available' THEN 1 END) AS followup_leads,
                                            COUNT(CASE WHEN status = 'Transferred' and transfer_status = 'Available' THEN 1 END) AS transferred_leads,
                                            COUNT(CASE WHEN status = 'Assigned' and transfer_status = 'Transferred' THEN 1 END) AS assigned_leads,
                                            COUNT(CASE WHEN status = 'From SE' THEN 1 END) AS received_leads,
                                            COUNT(CASE WHEN status = 'Dead' THEN 1 END) AS dead_leads
                                        FROM assign_leads
                                        WHERE YEAR(added_on) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                                        AND MONTH(added_on) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                                        GROUP BY employee_name
                                    ";

                                $q = $pdo->query($sql);

                                // print_r($sql);
                                // exit();

                                foreach ($pdo->query($sql) as $row) 
                                { 
                                    $emp_name = $row["employee_name"];
                                    $sqlemp = "select * from employee where employee_name = '$emp_name' ";
                                    $q = $pdo->prepare($sqlemp);
                                    $q->execute(array());      
                                    $row_emp = $q->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row["employee_name"]; ?></td> -->
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                        <!-- <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"> -->
                                        <img src="assets/img/avatars/<?php echo $row_emp["login_photo"];?>" alt="Avatar" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="name text-truncate h6 mb-0"><?php echo $row["employee_name"]; ?></span>
                                        <small class="user_name text-truncate"><?php echo $row_emp["user_id"]; ?></small>
                                    </div>
                                    </div>
                                </td>
                                <td><?php echo $row["active_leads"]; ?></td>
                                <td><?php echo $row["followup_leads"]; ?></td>
                                <td><?php echo $row["transferred_leads"]; ?></td>
                                <td><?php echo $row["assigned_leads"]; ?></td>
                                <td><?php echo $row["received_leads"]; ?></td>
                                <td><?php echo $row["dead_leads"]; ?></td>
                                <!-- <td><?php echo $row["added_on"]; ?></td> -->
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
               <!-- *************** - /main containt in page write here - **********************  -->
            </div>
            <!-- / Content -->

            <!-- Sales Executive Performance Last Month -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h5 class="card-header mar-bot-10" style="margin-top:10px;">Sales Executive Performance Last Month</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <th>  Name</th>
                                <th> Visited Leads </th>
                                <th> Followup Leads</th>
                                <th> Transferred Leads</th>
                                <!-- <th> Assigned Leads</th> -->
                                <!-- <th> Received Leads</th> -->
                                <th> Converted Leads</th>
                                <th> Dead Leads</th>
                                <!-- <th> Addedon </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                // $sql = "SELECT * FROM assign_leads ";
                                $sql_sr = " SELECT 
                                            employee_name,
                                            COUNT(CASE WHEN status = 'Active' and transfer_status = 'Available' THEN 1 END) AS received_leads,
                                            COUNT(CASE WHEN status = 'Followup' and transfer_status = 'Available' THEN 1 END) AS followup_leads,
                                            COUNT(CASE WHEN status = 'Transferred' and transfer_status = 'Available' THEN 1 END) AS transferred_leads,
                                            COUNT(CASE WHEN status = 'Converted'  THEN 1 END) AS converted_leads,
                                            COUNT(CASE WHEN status = 'Dead' THEN 1 END) AS dead_leads
                                        FROM assign_leads_sr
                                        WHERE YEAR(added_on) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                                        AND MONTH(added_on) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)    
                                        GROUP BY employee_name
                                    ";
                                // $sql = "SELECT * FROM assign_leads ";
                                $q = $pdo->query($sql_sr);

                                // print_r($sql_sr);
                                // exit();

                                foreach ($pdo->query($sql_sr) as $row_sr) 
                                { 
                                    $emp_name = $row_sr["employee_name"];
                                    $sqlemp = "select * from employee where employee_name = '$emp_name' ";
                                    $q = $pdo->prepare($sqlemp);
                                    $q->execute(array());      
                                    $row_emp = $q->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row_sr["employee_name"]; ?></td> -->
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                        <!-- <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"> -->
                                        <img src="assets/img/avatars/<?php echo $row_emp["login_photo"];?>" alt="Avatar" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="name text-truncate h6 mb-0"><?php echo $row_sr["employee_name"]; ?></span>
                                        <small class="user_name text-truncate"><?php echo $row_emp["user_id"]; ?></small>
                                    </div>
                                    </div>
                                </td>
                                <td><?php echo $row_sr["received_leads"]; ?></td>
                                <td><?php echo $row_sr["followup_leads"]; ?></td>
                                <td><?php echo $row_sr["transferred_leads"]; ?></td>
                                <td><?php echo $row_sr["converted_leads"]; ?></td>
                                <td><?php echo $row_sr["dead_leads"]; ?></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
               <!-- *************** - /main containt in page write here - **********************  -->
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
    
     
  </body>
</html>
