<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

    $i = 1;
    $leads_id = $_REQUEST['leads_id'];
    
    $sqlemp = "SELECT * FROM assign_leads where leads_id= $leads_id ";
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
    echo "<pre>";
    print_r($_POST);
    exit();

    $customRadioSuccess = $_POST['customRadioSuccess'];
    $customRadioDanger = $_POST['customRadioDanger'];
    $prefix = $_POST['prefix'];
    $user_id = $prefix.$user_id1;

    // [customRadioSuccess] => connected
    // [customRadioDanger] => not_connected
    // [remark] => rennnn
    // [next_date] => 2024-08-15T03:20
    // [switches-stacked-radio] => cold
    // [mark_dead] => yes
    // [dead_reason] => reaasfdsf
    // [submit] => 

    // print_r($user_id);
    // exit();

    $password_post = $_POST['password'];
    $password = password_hash($password_post, PASSWORD_BCRYPT);
    // $assistant_login_id = $_POST['assistant_login_id'];
    $added_on = date('Y-m-d H-i-s');
    $status = "Active";
    $login_role = $_POST['login_role'];
    $login_photo = "default.png";
    $email_id = $_POST['email_id'];

    $cell_no = $_POST['cell_no'];

    // echo "<pre>";
    // print_r($_POST);
    // exit();
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `admin`(`login_name`, `login_password`, `login_role`, `login_id`, `status`,`type`, `login_photo`) VALUES (?,?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($employee_name, $password, $login_role, $user_id, $status, $login_role, $login_photo));
    $lastInsertedId = $pdo->lastInsertId();

    // echo "<pre>";
    // print_r($sql);
    // exit();

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO employee(admin_id, employee_name, password, added_on, status, login_role,  cell_no, user_id,email_id,designation) values(?,?,?,?, ?, ?, ?, ?, ?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($lastInsertedId, $employee_name, $password, $added_on, 'Active', $login_role,  $cell_no, $user_id,$email_id,'Employee'));

    // echo "<pre>";
    // print_r($sql);
    // exit();
    
    header('location:add_employee');
     
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
                        <div class="card-body demo-vertical-spacing demo-only-element">
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
                        <!-- Activity Timeline -->
                        <div class="card card-action mb-6">
                            <div class="card-header align-items-center">
                                <h5 class="card-action-title mb-0"><i class="ri-survey-line ri-24px text-body me-4"></i>Add Follow Up Details</h5>
                                
                            </div>
                            <form action="#" method="post">
                                <div class="card-body demo-vertical-spacing demo-only-element pt-5x" style="padding-top: 0rem !important;">
                                    <!-- card -->

                                    <!-- <label class="form-check-label">Address Type</label> -->
                                    <div class="col mt-2" style="display:flex; gap: 20%;">
                                        <div class="form-check form-check-success">
                                            <input name="connection_status" class="form-check-input" type="radio" value="connected" id="customRadioSuccess" checked>
                                            <label class="form-check-label" for="customRadioSuccess">Connected</label>
                                        </div>
                                        <div class="form-check form-check-danger">
                                            <input name="connection_status" class="form-check-input" type="radio" value="not_connected" id="customRadioDanger">
                                            <label class="form-check-label" for="customRadioDanger">Not Connected</label>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-floating form-floating-outline mb-6">
                                        <input class="form-control" type="text" placeholder="Notes" id="html5-text-input"name="notes">
                                        <label for="html5-text-input">Notes</label>
                                    </div>

                                    <div class="form-floating form-floating-outline mb-6">
                                        <input class="form-control" type="datetime-local" id="html5-datetime-local-input" name="next_date">
                                        <label for="html5-datetime-local-input">Next Follow Up Date Time</label>
                                    </div>
                                    
                                    <!--  -->
                                    <div class="col-sm-6 p-6 pt-0">
                                        <div class="text-light small fw-medium mb-4">Lead Type</div>
                                        <div class="switches-stacked" style="display:flex;gap:20%;">
                                            <label class="switch">
                                            <input type="radio" class="switch-input" name="switches-stacked-radio" checked="" value="hot">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on"></span>
                                                <span class="switch-off"></span>
                                            </span>
                                            <span class="switch-label">Hot</span>
                                            </label>

                                            <label class="switch">
                                            <input type="radio" class="switch-input" name="switches-stacked-radio" value="warm">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on"></span>
                                                <span class="switch-off"></span>
                                            </span>
                                            <span class="switch-label">Warm</span>
                                            </label>

                                            <label class="switch">
                                            <input type="radio" class="switch-input" name="switches-stacked-radio" value="cold">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on"></span>
                                                <span class="switch-off"></span>
                                            </span>
                                            <span class="switch-label">Cold</span>
                                            </label>

                                            
                                        </div>
                                    </div>

                                    <div class="form-check form-check-danger">
                                        <input class="form-check-input" type="checkbox" value="yes" id="customCheckDanger" name="mark_dead" onchange="toggleReasonBox()">
                                        <label class="form-check-label" for="customCheckDanger">Mark Dead</label>
                                    </div>

                                    <div id="reasonBox" class="form-floating form-floating-outline mb-6">
                                        <textarea class="form-control h-px-50" id="exampleFormControlTextarea1" placeholder="Comments here..." name="dead_reason"></textarea>
                                        <label for="exampleFormControlTextarea1">Remark For Mark Dead</label>
                                    </div>


                                    <button type="submit" name="submit" class="btn btn-success waves-effect waves-light logo-btn" id="type-successxx">
                                        Submit
                                    </button>

                                    <button type="button" class="btn btn-secondary waves-effect waves-light" id="type-question" style="float: right; box-shadow: 0 1px 20px 1px #6d788d !important;">
                                        Transfer Lead
                                    </button>
                                    <!-- /card -->
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
