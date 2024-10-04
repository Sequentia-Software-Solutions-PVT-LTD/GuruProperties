<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();
  
  if(isSet($_POST["pdf"]))
  { 

    // print_R($_POST);
    // exit();

    $current_year = $_POST['year'];

    $from_month = $_POST['from_month'];
    $to_month = $_POST['from_month'];
    $employee_name = $_POST['employee_name'];

    // Convert month numbers to date strings (e.g., '02' -> '2024-02-01' and '09' -> '2024-09-30')
    $from_date = "$current_year-$from_month-01";
    $to_date = date("Y-m-t", strtotime("$current_year-$to_month-01")); // 'Y-m-t' gives the last day of the given month

    // SQL query with month filtering
    $sql_query = "
        SELECT * 
        FROM attendance 
        WHERE login_name = :employee_name 
        AND date BETWEEN :from_date AND :to_date
    ";

    // Prepare the statement
    $pdata = $pdo->prepare($sql_query);

    // Bind the parameters
    $pdata->execute([
        ':employee_name' => $employee_name,
        ':from_date' => $from_date,
        ':to_date' => $to_date
    ]);

    // Fetch the results
    $results = $pdata->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($sql);
    // exit();

  }

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

    <title> Attendance report |  Guru Properties</title>

    <meta name="description" content="" />
    <!-- <link rel="stylesheet" href="assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css" /> -->

    <!-- *********** header******************  -->
    <?php include 'layout/header_js.php'; ?>
     <!-- *********** /header******************  -->

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
     <style>
        .mar-top {
            margin-top: -12px;

        }
     </style>
    
  </head>

  <body onload="window.print();">
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
              <h5 class="card-header mar-bot-10">Executive Attendance </h5>
              <!-- <hr class="my-12"> -->
                
                <div class="card">

                    
                    <!-- /filters -->
                    <h5 class="card-header"> All Executive are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of Executive</caption>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Executive Name</th>
                                <th>Date</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                // $sql = "SELECT * FROM attendance ";
                                // $q = $pdo->query($sql);
                                // foreach ($pdo->query($sql) as $row) 
                                // { 
                                foreach($results as $row)
                                {
                                  $status = $row['status'];
                                  if($status == 'Logged In'){
                                        $in_time = $row["time"];
                                  }
                                  else {
                                    $in_time = '-';
                                  }
                                //   
                                  if($status == 'Logged Out'){
                                    $out_time = $row["time"];
                                    }
                                    else {
                                        $out_time = '-';
                                    }

                                  // echo "$login_photo";
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                <td><span class="fw-medium"><?php echo $row["login_name"]; ?></span></td>
                                <td><?php echo $row["date"]; ?></td>
                                <td><?php echo $in_time; ?></td>
                                <td><?php echo $out_time; ?></td>
                                <td><?php echo $row["latitude"]; ?></td>
                                <td><?php echo $row["longitude"]; ?></td>
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
      <!-- <script src="assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script> -->
       <!-- Tagify JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    <!-- Your Custom JavaScript File -->
    <script>
        // Initialize Tagify on the #dateRangePicker input
        document.addEventListener('DOMContentLoaded', function() {
            var input = document.querySelector('#dateRangePicker');
            if (input) {
                new Tagify(input);
            }
        });
    </script>

  </body>
</html>
