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

  if(isSet($_POST["submit"]))
  { 
    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $added_on = date('Y-m-d H-i-s');

    $assign_leads_id = $_POST['assign_leads_id'];
    $leads_id = $_POST['leads_id'];

    $transfer_employee_type = 'CUSTOMER EXECUTIVE';
    $transfer_employee_id = $_POST['transfer_employee_id'];
    $transfer_reason = $_POST['transfer_reason'];
    

    $sqlemp = "SELECT * FROM employee where employee_id= $transfer_employee_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_assign1 = $q->fetch(PDO::FETCH_ASSOC);

    $admin_id = $row_assign1['admin_id'];
    $employee_name = $row_assign1['employee_name'];

    $Active = 'Active';
    $Transfered = 'Transfered';
    $Available = 'Available';

    //------------------------- Update query for last assigned employee lead changes ----------------------------------------- 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `assign_leads` SET  
          `edited_on` = ?, 
          `transfer_status` = ?,
          `transfer_reason` = ?,
          `transfer_employee_id` = ?,
          `transfer_employee_type` = ?,
          `status` = ?
          WHERE `assign_leads_id` = ?";

    $q = $pdo->prepare($sql);
    $q->execute(array($added_on, $Transfered, $transfer_reason, $transfer_employee_id, $transfer_employee_type, $Active, $assign_leads_id));

    // ---------------------- Insert query for trasfered employee-------------------------------------------------------------------------------------------
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`,`employee_name`, `status`, `transfer_status`, `added_on`) VALUES (?,?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($leads_id, $admin_id, $transfer_employee_id, $employee_name, $Transfered, $Available, $added_on));
     
    // $lastInsertedId = $pdo->lastInsertId();

    
    // header('location:transfer_leads.php');
    header('location:assigned_leads.php');
     
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

    <title> Transfer Assigned Leads  |  Guru Properties</title>

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
                        </div>
                        </div>
                        <!--/ About User -->
                        
                    </div>
                    <!--  -->
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="card mb-6" >
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0"><i class="ri-survey-line ri-24px text-body me-2"></i>Add Transfer Details </h5>
                            </div>
                            <form action="#" method="post">
                              <input type="hidden" value="<?php echo $_REQUEST['assign_leads_id']; ?>" name="assign_leads_id">
                              <input type="hidden" value="<?php echo $row_assign['leads_id']; ?>" name="leads_id">
                                <div class="card-body" style="padding-top: 0px;">
                                    
                                    <div class="mb-4">
                                      <?php
                                          // $location = "1,2,3,4,9";
                                          // var_dump(gettype($location));
                                          // $locationArray = explode(",", $location);
                                          // var_dump($locationArray);
                                      ?>
                                        <!-- <label for="notes" class="form-label">Select Customer Executive</label> -->
                                        <!-- <select id="roleDropdown" name="transfer_employee_id" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                          <option value="" data-select2-id="18">Select Customer Executive</option>
                                            <?php
                                                // $sql = "SELECT * FROM  employee where status='Active' and login_role='CUSTOMER EXECUTIVE' ";
                                                // foreach ($pdo->query($sql) as $row) 
                                                // { 
                                                ?>
                                                  <option value="<?php //echo $row['employee_id']?>"><?php //echo $row['employee_name']?></option> 
                                              <?php //} ?>
                                          </select> -->
                                          <div class="form-floating form-floating-outline">
                                              <select
                                                id="transfer_employee_id"
                                                class="selectpicker w-100"
                                                data-style="btn-default"
                                                data-show-subtext="true">
                                                <option disable hidden selected>Select Customer Executive</option>
                                                <?php
                                                $sql = "SELECT * FROM  employee where status='Active' and login_role='CUSTOMER EXECUTIVE' ";
                                                foreach ($pdo->query($sql) as $row) 
                                                { 
                                                  $location = $row['location'];
                                                  $locationArray = explode(",", $location);
                                                  $locationName = array();
                                                  foreach($locationArray as $locationSingle) {                                                    
                                                    $locationid = $locationSingle;
                                                    $sqlEmployeeDetail = "SELECT * FROM location WHERE id = '$locationid'";
                                                    $q = $pdo->prepare($sqlEmployeeDetail);
                                                    $q->execute(array());
                                                    $result = $q->fetch(PDO::FETCH_ASSOC);
                                                    array_push($locationName, $result['name']);
                                                  }
                                                  sort($locationName);
                                                  $locationName = implode("-",$locationName);
                                                ?>
                                                  <option data-subtext="<?php echo $locationName; ?>" value="<?php echo $row['employee_id']; ?>"><?php echo $row['employee_name']; ?></option> 
                                              <?php } ?>
                                                <label for="transfer_employee_id">Select Customer Executive</label>
                                              </select>
                                          </div>
                                    </div>


                                    <div class="mb-4">
                                        <label for="notes" class="form-label">Reason For Transfer</label>
                                        <textarea class="form-control" id="transfer_reason" placeholder="Write Reason here..." name="transfer_reason"></textarea>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button type="submit" name="submit" class="btn btn-success logo-btn">
                                            Transfer
                                        </button>
                                        <!-- <button type="button" class="btn btn-secondary">
                                            Transfer Lead
                                        </button> -->
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
