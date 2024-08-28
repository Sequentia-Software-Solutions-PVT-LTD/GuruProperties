<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

    $i = 1;
    $assign_leads_id = $_REQUEST['assign_leads_id'];
    
    $sqlemp = "SELECT * FROM assign_leads where assign_leads_id= $assign_leads_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_assign = $q->fetch(PDO::FETCH_ASSOC);

    $leads_id = $row_assign['leads_id'];
    $admin_id = $row_assign['admin_id'];

    $sqlemp = "select * from employee where admin_id = $admin_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_emp = $q->fetch(PDO::FETCH_ASSOC);

    $sqlleads = "select * from leads where id = $leads_id ";
    $q = $pdo->prepare($sqlleads);
    $q->execute(array());      
    $row_leads = $q->fetch(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // // print_r($row_emp);
    // print_r($row_leads);
    // print_r($row_assign);
    // exit();

  if(isSet($_POST["submit"]))
  { 
    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $connection_status = $_POST['connection_status'];
    $notes = $_POST['notes'];
    // $next_date = $_POST['next_date'];
    $lead_type = $_POST['lead_type'];
    $mark_dead = $_POST['mark_dead'];
    $dead_reason = $_POST['dead_reason'];

    $added_on = date('Y-m-d H-i-s');
    $status = "Active";

    $assign_leads_id = $_POST['assign_leads_id'];

    $next_date_time = $_POST['next_date'];
    // Split the datetime into date and time
    $date_time_parts = explode('T', $next_date_time);
    $next_date = $date_time_parts[0];  // 2024-08-22
    $next_time = $date_time_parts[1];  // 02:26

    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `assign_leads` SET 
            `connection_status` = ?, 
            `notes` = ?, 
            `next_date` = ?, 
            `next_time` = ?, 
            `lead_type` = ?, 
            `mark_dead` = ?, 
            `dead_reason` = ?, 
            `added_on` = ?, 
            `status` = ? 
            WHERE `assign_leads_id` = ?";

    $q = $pdo->prepare($sql);
    $q->execute(array($connection_status, $notes, $next_date, $next_time, $lead_type, $mark_dead, $dead_reason, $added_on, $status, $assign_leads_id));
        
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $sql = "INSERT INTO `admin`(`connection_status`, `notes`, `next_date`,`next_time`, `lead_type`, `mark_dead`,`dead_reason`, `added_on`, `status`) VALUES (?,?,?,?,?,?,?,?,?)";
    // $q = $pdo->prepare($sql);
    // $q->execute(array($connection_status, $notes, $next_date, $next_time, $lead_type, $mark_dead, $dead_reason, $added_on, $status));
    
    // $lastInsertedId = $pdo->lastInsertId();

    // echo "<pre>";
    // print_r($sql);
    // exit();

    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $sql = "INSERT INTO employee(admin_id, employee_name, password, added_on, status, login_role,  cell_no, user_id,email_id,designation) values(?,?,?,?, ?, ?, ?, ?, ?,?)";
    // $q = $pdo->prepare($sql);
    // $q->execute(array($lastInsertedId, $employee_name, $password, $added_on, 'Active', $login_role,  $cell_no, $user_id,$email_id,'Employee'));

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

    <title> Add Employee  |  Guru Properties</title>

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
    <?php include 'layout/header_js.php'; ?>
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
               
              <!-- // -->
              <h5 class="card-header mar-bot-10">Leads Details </h5>
                <div class="row">
                    <div class="col-xl-6 col-lg-5 col-md-5 ">
                        <!-- About User -->
                        <div class="card mb-6">
                        <div class="card-body">
                            <small class="card-text text-uppercase text-muted small">About</small>
                            <ul class="list-unstyled my-3 py-1" style="">
                                <li class="d-flex align-items-center mb-4"><i class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">Lead Name:</span> <span><?php echo $row_leads['lead_name']; ?></span></li>
                                <li class="d-flex align-items-center mb-4"><i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Location:</span> <span><?php echo $row_leads['location']; ?></span></li>
                                <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Budget Range:</span> <span><?php echo $row_leads['budget_range']; ?></span></li>
                                <!-- <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Budget Range:</span> <span><?php echo $row_leads['budget_range']; ?></span></li> -->
                            </ul>
                            <small class="card-text text-uppercase text-muted small" >Contacts</small>
                            <ul class="list-unstyled my-3 py-1" style="">
                                <li class="d-flex align-items-center mb-4"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Contact:</span> <span><?php echo $row_leads['phone_no']; ?></span></li>
                                <li class="d-flex align-items-center mb-4"><i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Email ID:</span> <span><?php echo $row_leads['email_id']; ?></span></li>
                               
                            </ul>
                            <small class="card-text text-uppercase text-muted small">Other</small>
                            <ul class="list-unstyled my-3 py-1" style="">
                                <li class="d-flex align-items-center mb-4"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Source:</span> <span><?php echo $row_leads['source']; ?></span></li>
                                <li class="d-flex align-items-center mb-4"><i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Date:</span> <span><?php echo date("d-M-Y" , strtotime($row_leads['added_on'])); ?></span></li>
                            </ul>

                            <!-- <ul class="list-unstyled my-3 py-1" style="">
                                <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light">
                                    <i class="ri-user-follow-line ri-16px me-2"></i>Add Followup
                                </a>
                                <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light">
                                    <i class="ri-user-follow-line ri-16px me-2"></i>Transfer Leads
                                </a>
                            </ul> -->
                        </div>
                        </div>
                        <!--/ About User -->
                        
                    </div>
                    <!--  -->
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="card mb-6" >
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0"><i class="ri-survey-line ri-24px text-body me-2"></i>Add Follow Up Details</h5>
                                <!-- <a class="btn btn-secondary" href="transfer_assigned_lead.php?assign_leads_id=<?php echo $row_assign["assign_leads_id"]; ?>">Transfer Lead </a> -->
                            </div>
                            <form action="#" method="post">
                            <input type="hidden" value="<?php echo $_REQUEST['assign_leads_id']; ?>" name="assign_leads_id">
                                <div class="card-body" style="padding-top: 0px;">
                                    <div class="mb-4">
                                        <label class="form-label">Connection Status</label>
                                        <div class="d-flex gap-4">
                                            <div class="form-check form-check-success">
                                                <input name="connection_status" class="form-check-input" type="radio" value="connected" id="customRadioSuccess" checked>
                                                <label class="form-check-label" for="customRadioSuccess">Connected</label>
                                            </div>
                                            <div class="form-check form-check-danger">
                                                <input name="connection_status" class="form-check-input" type="radio" value="not_connected" id="customRadioDanger">
                                                <label class="form-check-label" for="customRadioDanger">Not Connected</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="notes" class="form-label">Notes</label>
                                        <input class="form-control" type="text" placeholder="Enter your notes" id="notes" name="notes">
                                    </div>

                                    <div class="mb-4">
                                        <label for="next_date" class="form-label">Next Follow Up Date Time</label>
                                        <input class="form-control" type="datetime-local" id="next_date" name="next_date">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Lead Type</label>
                                        <div class="d-flex gap-4">
                                            <label class="switch">
                                                <input type="radio" class="switch-input" name="lead_type" checked="" value="hot">
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on"></span>
                                                    <span class="switch-off"></span>
                                                </span>
                                                <span class="switch-label">Hot</span>
                                            </label>

                                            <label class="switch">
                                                <input type="radio" class="switch-input" name="lead_type" value="cold">
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on"></span>
                                                    <span class="switch-off"></span>
                                                </span>
                                                <span class="switch-label">Cold</span>
                                            </label>

                                            <label class="switch">
                                                <input type="radio" class="switch-input" name="lead_type" value="warm">
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on"></span>
                                                    <span class="switch-off"></span>
                                                </span>
                                                <span class="switch-label">Warm</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-check form-check-danger">
                                            <input class="form-check-input" type="checkbox" value="yes" id="customCheckDanger" name="mark_dead" onchange="toggleReasonBox()">
                                            <label class="form-check-label" for="customCheckDanger">Mark Dead</label>
                                        </div>
                                    </div>

                                    <div id="reasonBox" class="mb-4" style="display:none;">
                                        <label for="dead_reason" class="form-label">Remark For Mark Dead</label>
                                        <textarea class="form-control" id="dead_reason" placeholder="Write comment here..." name="dead_reason"></textarea>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button type="submit" name="submit" class="btn btn-success logo-btn">
                                            Submit
                                        </button>
                                        <a class="btn btn-secondary" href="transfer_assigned_lead.php?assign_leads_id=<?php echo $row_assign["assign_leads_id"]; ?>">Transfer Lead </a>
                                    </div>
                                </div>
                            </form>
                        </div>
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
