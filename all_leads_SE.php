<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  $admin_id = $_SESSION['login_user_id'];
  
//   echo "<pre>";
//   print_r($_SESSION);
//   print_r($admin_id);
//   exit();
  

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  if(isSet($_POST["suspend"]))
  { 
    $id = $_POST['id'];
    // $property_title = $_POST['property_title'];
    // $builder_name = $_POST['builder_name'];
    $added_on = date('Y-m-d H-i-s');
    $status = "Suspended";
    // $varients = $_POST['varients'];
    // $area = $_POST['area'];
    // $price = $_POST['price'];
    // $location = $_POST['location'];

    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO property( status, edited_on) values(?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($status, $added_on));

    // echo "<pre>";
    // print_r($sql);
    // exit();
    
    header('location:assigned_leads');
     
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

    <title>View All Leads |  Guru Properties</title>

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
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h5 class="card-header mar-bot-10">All Leads</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All Leads are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of Leads</caption>
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Lead ID</th>
                            <th>Lead Name</th>
                            <!-- <th>Employee Name</th> -->
                            <th>Location</th>
                            <th>Contact</th>
                            <th>Email ID</th>
                            <th>Budget</th>
                            <th>Status</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sqllocation = "select * from location ";
                                $qlocation = $pdo->prepare($sqllocation);
                                $qlocation->execute(array());      
                                $row_location = $qlocation->fetchAll(PDO::FETCH_ASSOC);

                                $i = 1;
                                $today_date = date('Y-m-d');
                                // $sql = "SELECT * FROM assign_leads_sr where admin_id= $admin_id and status='Active' and transfer_status='Available' ";
                                $sql = "SELECT * FROM assign_leads_sr where admin_id = $admin_id GROUP BY leads_id ORDER BY  edited_on, added_on";
                                $q = $pdo->query($sql);
                                // print_r($sql);
                                // exit();
                                foreach ($pdo->query($sql) as $row1) 
                                { 
                                    // echo "<pre>";
                                    // print_r($row1);
                                    
                                    // $assign_leads_id = $row1['assign_leads_id'];
                                    $leads_id = $row1['leads_id'];
                                    $admin_id = $row1['admin_id'];

                                    $sqlemp = "select * from employee where admin_id = $admin_id ";
                                    $q = $pdo->prepare($sqlemp);
                                    $q->execute(array());      
                                    $row_emp = $q->fetch(PDO::FETCH_ASSOC);

                                    $sqlleads = "select * from leads where id = $leads_id ";
                                    $q = $pdo->prepare($sqlleads);
                                    $q->execute(array());     
                                    $row_leads = $q->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                    <td><i class="ri-building-2-line ri-22px text-primary me-4"></i><span class="fw-medium"><?php echo $i; ?></span></td>
                                    <td><?php echo $row1["leads_id"]; ?></td>
                                    <td><?php echo $row_leads["lead_name"]; ?></td>
                                    <!-- <td><?php //echo $row_emp["employee_name"]; ?></td> -->
                                    <td><?php 
                                        $needle = $row_leads["location"];
                                        $resultArray = array_filter($row_location, function ($v) use ($needle) {
                                          return $needle == $v['id']; 
                                        });
                                        if($needle == 1) $needle = 1;
                                        else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                        if(isset($resultArray[$needle]["name"]) && $resultArray[$needle]["name"] != "") echo $resultArray[$needle]["name"]; 
                                        else echo "Not Found";
                                        ?></td>
                                    <td><?php echo $row_leads["phone_no"]; ?></td>
                                    <td><?php echo $row_leads["email_id"]; ?></td>
                                    <td><?php echo $row_leads["budget_range"]; ?></td>
                                    <td>
                                      <?php 
                                            if($row1["status"] == "Active")
                                            echo '<span class="badge rounded-pill bg-label-danger">';
                                            else if($row1["status"] == "Followup")
                                            echo '<span class="badge rounded-pill bg-label-info">';
                                            else if($row1["status"] == "Assigned")
                                            echo '<span class="badge rounded-pill bg-label-primary">';
                                            else if($row1["status"] == "Transferred")
                                            echo '<span class="badge rounded-pill bg-label-warning">';
                                            else if($row1["status"] == "From SE")
                                            echo '<span class="badge rounded-pill bg-label-warning">';
                                            else if($row1["status"] == "Dead")
                                            echo '<span class="badge rounded-pill bg-label-dark">';
                                            else
                                            echo '<span class="badge rounded-pill bg-label-secondary">';
                                            echo $row1["status"]; 
                                            echo '</span>';
                                      ?></td>
                                    <td>
                                        <!-- <a class="dropdown-item waves-effect" href="view_single_lead_assigned_by_CE.php?assign_leads_sr_id=<?php echo $row1["assign_leads_sr_id"]; ?>"><i class="ri-eye-line me-1"></i> </a> -->
                                        
                                        <a class="dropdown-item" href="view_single_lead_assigned_by_CE.php?assign_leads_sr_id=<?php echo $row1["assign_leads_sr_id"]; ?>" style="overflow: visible;">
                                          <i class="ri-eye-line border-2 p-2 bg-success text-white rounded ri-18px"></i> 
                                        </a>
                                    </td>
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

        <script>
            $(document).on("click", ".open-myModal", function (e) 
            {
                e.preventDefault();
                var _self = $(this);
                var id = _self.data('id');
                $("#id").val(id);
                $(_self.attr('href')).modal('show');
            }); 
        </script>
    
  </body>
</html>
