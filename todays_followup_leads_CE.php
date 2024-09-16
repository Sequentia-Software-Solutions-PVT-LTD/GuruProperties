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
    
    header('location:view-properties');
     
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

    <title>View Today's Follow Up Leads |  Guru Properties</title>

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
              <h5 class="card-header mar-bot-10">Leads Management</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All Today's Followup Leads are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of Leads</caption>
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Lead Name</th>
                            <!-- <th>Employee Name</th> -->
                            <th>Location</th>
                            <th>Contact</th>
                            <!-- <th>Email ID</th> -->
                            <th>Lead Type</th>
                            <th>Budget</th>
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
                                $sql = "SELECT * FROM assign_leads WHERE admin_id = $admin_id and status = 'Followup' And transfer_status='Available' and mark_dead='' AND DATE(next_date) = '$today_date'";
                                // $sql = "SELECT * FROM assign_leads WHERE admin_id = $admin_id And transfer_status='Available' and mark_dead='' AND DATE(next_date) = '2024-08-23'";
                                $q = $pdo->query($sql);
                                // print_r($sql);
                                // exit();
                                foreach ($pdo->query($sql) as $row1) 
                                { 
                                    // echo "<pre>";
                                    // print_r($row1);
                                    // exit();

                                    $assign_leads_id = $row1['assign_leads_id'];
                                    $leads_id = $row1['leads_id'];
                                    $admin_id = $row1['admin_id'];
                                    $employee_id = $row1['employee_id'];
                                    $next_date = $row1['next_date'];

                                    $sqlasnl = "select * from assign_leads where employee_id = $employee_id and status = 'Followup' and transfer_status = 'Not Available' and next_date = '$next_date' ";
                                    $q = $pdo->prepare($sqlasnl);
                                    $q->execute(array());      
                                    $row_asn_leads = $q->fetch(PDO::FETCH_ASSOC);

                                    // echo "<pre>";
                                    // print_r($row_asn_leads);
                                    // exit();

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
                                    <!-- <td><?php echo $row_leads["email_id"]; ?></td> -->
                                    <td>                                      
                                        <?php 
                                          if($row_asn_leads["lead_type"] == 'hot')
                                          echo "<span class='badge rounded-pill bg-danger text-uppercase'>";
                                          if($row_asn_leads["lead_type"] == 'warm')
                                          echo "<span class='badge rounded-pill bg-warning text-uppercase'>";
                                          if($row_asn_leads["lead_type"] == 'cold')
                                          echo "<span class='badge rounded-pill bg-info text-uppercase'>";
                                          echo $row_asn_leads["lead_type"]; 
                                          echo "</span>";
                                        ?>
                                    </td>
                                    <td><?php echo $row_leads["budget_range"]; ?></td>
                                    <td>
                                        <!-- <a class="dropdown-item waves-effect" href="view_assigned_lead.php?assign_leads_id=<?php echo $row1["assign_leads_id"]; ?>"><i class="ri-eye-line me-1"></i> </a> -->
                                        <a class="dropdown-item" href="view_assigned_lead.php?assign_leads_id=<?php echo $row1["assign_leads_id"]; ?>" style="overflow: visible;">
                                          <i class="ri-eye-line border-2 p-2 bg-success text-white rounded ri-18px"></i> 
                                        </a>
                                    </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
                 <!-- Enable OTP Modal -->
              <div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
                  <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                      <div class="text-center mb-6">
                        <h4 class="mb-2">Suspend!..</h4>
                        <p>Do you really want suspend this property?</p>
                      </div>
                      <!-- <p class="mb-5">
                        Enter your mobile phone number with country code and we will send you a verification code.
                      </p> -->
                      <form id="enableOTPForm" class="row g-5"  action="suspend_property.php" method="POST">
                        <input type="hidden" name="id" id="id" value="" />
                        
                        <!-- <div class="col-12 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                          <button
                            type="reset"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                          </button>

                          <button type="submit" name ="suspend" class="btn btn-danger">Suspend</button>
                        </div> -->

                        <div class="row mt-10">
                          <div class="col-md-12">
                                <button type="submit"  data-bs-toggle="tooltip" data-bs-placement="left"  class="btn btn-success waves-effect waves-light d-flex float-right" name="submit">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                          </div>
                        </div>
                        
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Enable OTP Modal -->
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
