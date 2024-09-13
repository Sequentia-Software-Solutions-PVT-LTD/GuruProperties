<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  $admin_id = $_SESSION['login_user_id'];

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
             
            <!-- Sales Executive Performance Weekly -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h5 class="card-header mar-bot-10">Sales Executive Performance Weekly</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <!-- <th> Sales Executive Name</th> -->
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
                                        WHERE YEARWEEK(added_on, 1) = YEARWEEK(CURDATE(), 1)  
                                        and admin_id = $admin_id      
                                        GROUP BY employee_name
                                    ";
                                // $sql = "SELECT * FROM assign_leads ";
                                $q = $pdo->query($sql_sr);

                                // print_r($sql_sr);
                                // exit();

                                foreach ($pdo->query($sql_sr) as $row_sr) 
                                { 
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row_sr["employee_name"]; ?></td> -->
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

            <!-- Sales Executive Performance Daily -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h5 class="card-header mar-bot-10">Sales Executive Performance Daily</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <!-- <th> Sales Executive Name</th> -->
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
                                         and admin_id = $admin_id       
                                        GROUP BY employee_name
                                    ";
                                // $sql = "SELECT * FROM assign_leads ";
                                $q = $pdo->query($sql_sr);

                                // print_r($sql_sr);
                                // exit();

                                foreach ($pdo->query($sql_sr) as $row_sr) 
                                { 
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row_sr["employee_name"]; ?></td> -->
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

            <!-- Sales Executive Performance Yesterday -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h5 class="card-header mar-bot-10">Sales Executive Performance Yesterday</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <!-- <th> Sales Executive Name</th> -->
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
                                         and admin_id = $admin_id    
                                        GROUP BY employee_name
                                    ";
                                // $sql = "SELECT * FROM assign_leads ";
                                $q = $pdo->query($sql_sr);

                                // print_r($sql_sr);
                                // exit();

                                foreach ($pdo->query($sql_sr) as $row_sr) 
                                { 
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row_sr["employee_name"]; ?></td> -->
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

            <!-- Sales Executive Performance Last Month -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h5 class="card-header mar-bot-10">Sales Executive Performance Last Month</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All performance data are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of data</caption>
                        <thead>
                            <tr>
                                <th> #</th>
                                <!-- <th> Sales Executive Name</th> -->
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
                                         and admin_id = $admin_id
                                        GROUP BY employee_name
                                    ";
                                // $sql = "SELECT * FROM assign_leads ";
                                $q = $pdo->query($sql_sr);

                                // print_r($sql_sr);
                                // exit();

                                foreach ($pdo->query($sql_sr) as $row_sr) 
                                { 
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <!-- <td><?php echo $row_sr["employee_name"]; ?></td> -->
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
