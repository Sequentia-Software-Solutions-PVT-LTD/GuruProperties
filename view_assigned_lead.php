<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();
    
    $leads_id_timeline = 0;
    $i = 1;
    $assign_leads_id = $_REQUEST['assign_leads_id'];
    
    $sqlemp = "SELECT * FROM assign_leads where assign_leads_id= $assign_leads_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_assign = $q->fetch(PDO::FETCH_ASSOC);

    $leads_id = $row_assign['leads_id'];
    $leads_id_timeline = $row_assign['leads_id'];
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
   

    $connection_status = $_POST['connection_status'];
    $notes = $_POST['notes'];
    $lead_type = $_POST['lead_type'];

    $added_on = date('Y-m-d H-i-s');
    $status = "Followup";
    $t_status_ce = "Not Available";
    $transfer_status = "Available";

    $next_date_time = $_POST['next_date'];
    // Split the datetime into date and time
    $date_time_parts = explode(' ', $next_date_time);
    $next_date = $date_time_parts[0];  // 2024-08-22
    $next_time = $date_time_parts[1];  // 02:26
    
    $assign_leads_id = $_POST['assign_leads_id'];

    $sqlemp = "SELECT * FROM assign_leads where assign_leads_id= $assign_leads_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_assign = $q->fetch(PDO::FETCH_ASSOC);

    $leads_id = $row_assign['leads_id'];
    $admin_id = $row_assign['admin_id'];
    $employee_id = $row_assign['employee_id'];
    $employee_name = $row_assign['employee_name'];

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `assign_leads` SET 
            `connection_status` = ?, 
            `notes` = ?, 
            `next_date` = ?, 
            `next_time` = ?, 
            `lead_type` = ?, 
            `edited_on` = ?, 
            `status` = ?,
            `transfer_status` = ?,
            `latitude` = ?, 
            `longitude` = ?
            WHERE `assign_leads_id` = ? ";

    $q = $pdo->prepare($sql);
    $q->execute(array($connection_status, $notes, $next_date, $next_time, $lead_type, $added_on, $status, $t_status_ce, $longitude, $latitude, $assign_leads_id));
    
    // ----------------------- Insert for new ffollowup ---------------------------------------------------------
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`,`employee_name`, `status`, `transfer_status`,`next_date`,`next_time`, `added_on`) VALUES (?,?,?,?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($leads_id, $admin_id, $employee_id, $employee_name, $status, $transfer_status, $next_date, $next_time, $added_on));
     // $lastInsertedId = $pdo->lastInsertId();
    
    // header('location:assigned_leads.php');
    
  }

    //   mark dead button
  if(isSet($_POST["submit_dead"]))
  { 
    $mark_dead = $_POST['mark_dead'];
    $dead_reason = $_POST['dead_reason'];

    $added_on = date('Y-m-d H-i-s');
    $status = "Dead";
    // $transfer_status = "Available";
    $assign_leads_id = $_POST['assign_leads_id'];

    // print_r($_POST);
    // exit();

    // Split the datetime into date and time
    $date_time_parts = explode(' ', $next_date_time);
    $next_date = $date_time_parts[0];  // 2024-08-22
    $next_time = $date_time_parts[1];  // 02:26

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `assign_leads` SET 
            `mark_dead` = ?, 
            `dead_reason` = ?, 
            `edited_on` = ?, 
            `status` = ?
            WHERE `assign_leads_id` = ?";

    $q = $pdo->prepare($sql);
    $q->execute(array($mark_dead, $dead_reason, $added_on, $status, $assign_leads_id));

    header('location:assigned_leads.php');
    
  }
  $sqllocation = "select * from location ";
  $qlocation = $pdo->prepare($sqllocation);
  $qlocation->execute(array());      
  $row_location = $qlocation->fetchAll(PDO::FETCH_ASSOC);
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

    <title> View Assigned Leads  |  Guru Properties</title>

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
              <!-- <h5 class="card-header mar-bot-10">Leads Details </h5> -->
                <div class="row">
                    <div class="col-xl-6 col-lg-5 col-md-5 ">
                        <div class="row  justify-content-between align-items-center">
                            <div class="col-12">
                                <div class="card mb-6">
                                <div class="card-header header-elements">
                                        <!-- <h5 class="mb-0 me-2"><i class="ri-survey-line1 ri-24px text-body me-2"></i>Add Follow Up Details</h5> -->
                                        <h5 class="card-action-title mb-0 underline">Lead Details</h5>
                                        
                                        <div class="card-header-elements ms-sm-auto">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" style="visibility:hidden;">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr class="m-0">
                                    <div class="card-body demo-vertical-spacing demo-only-element">
                                        <!-- <small class="card-text text-uppercase text-muted small">About</small> -->
                                        <h5 class="card-action-title  mb-0">About</h5>
                                        <hr class="mt-1">
                                        <ul class="list-unstyled my-3 py-1" style="">
                                            <li class="d-flex align-items-center mb-4"><i class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">Lead Name:</span> <span><?php echo $row_leads['lead_name']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Location:</span> <span><?php 
                                                $needle = $row_leads["location"];
                                                $resultArray = array_filter($row_location, function ($v) use ($needle) {
                                                    return $needle == $v['id']; 
                                                });
                                                if($needle == 1) $needle = 1;
                                                else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                                if(isset($resultArray[$needle]["name"]) && $resultArray[$needle]["name"] != "") echo $resultArray[$needle]["name"]; 
                                                else echo "Not Found";
                                            ?></span></li>
                                            <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Budget Range:</span> <span><?php echo $row_leads['budget_range']; ?></span></li>
                                            <!-- <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Budget Range:</span> <span><?php echo $row_leads['budget_range']; ?></span></li> -->
                                        </ul>
                                        <!-- <small class="card-text text-uppercase text-muted small" >Contacts</small> -->
                                        <!-- <hr> -->
                                        <h5 class="card-action-title  mb-0">Contacts</h5>
                                        <hr class="mt-1">
                                        <ul class="list-unstyled my-3 py-1" style="">
                                            <li class="d-flex align-items-center mb-4"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Contact:</span> <span><?php echo $row_leads['phone_no']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Email ID:</span> <span><?php echo $row_leads['email_id']; ?></span></li>
                                        
                                        </ul>
                                        <!-- <small class="card-text text-uppercase text-muted small">Other</small> -->
                                        <!-- <hr> -->
                                        <h5 class="card-action-title  mb-0">Other</h5>
                                        <hr class="mt-1">
                                        
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
                            </div>
                        </div>                        
                    </div>
                    <!--  -->
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        
                        <div class="row  justify-content-between align-items-center">
                            <div class="col-12">
                                <div class="card mb-6" >

                                    <div class="card-header header-elements">
                                        <!-- <h5 class="mb-0 me-2"><i class="ri-survey-line1 ri-24px text-body me-2"></i>Add Follow Up Details</h5> -->
                                        <h5 class="card-action-title mb-0"><i class="ri-survey-line1 ri-24px me-2"></i>Add Follow Up Details</h5>
                                        <div class="card-header-elements ms-sm-auto">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success waves-effect waves-light">Update</button>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-bs-toggle="dropdown" data-bs-reference="parent" aria-expanded="false"></button>
                                                <div class="dropdown-menu" style="">
                                                    <a class="dropdown-item waves-effect" href="view_leads_for_assigned_SE.php?assign_leads_id=<?php echo $row_assign["assign_leads_id"]; ?>">Assign Lead</a>
                                                    <a class="dropdown-item waves-effect" href="transfer_assigned_lead.php?assign_leads_id=<?php echo $row_assign["assign_leads_id"]; ?>">Transfer Lead</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-effect" data-bs-toggle="modal" data-bs-target="#addNewCCModal">Mark Dead</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="m-0">

                                    <form action="#" method="post">
                                        
                                        <input type="hidden" value="<?php echo $_REQUEST['assign_leads_id']; ?>" name="assign_leads_id">
                                        
                                        <div class="col-md-12 pt-6">
                                            <div class="card-body demo-vertical-spacing demo-only-element">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="w-max-content mb-0">Connection Status*</h6>
                                                    <!-- <div class="mb-4"> -->
                                                        <!-- <label class="form-label">Connection Status</label> -->
                                                        <div  style="margin-left: 20px;">
                                                            <div class="form-check form-check-inline form-check-success mb-0 ">
                                                                <input name="connection_status" class="form-check-input" type="radio" value="connected" id="customRadioSuccess" checked>
                                                                <label class="form-check-label" for="customRadioSuccess">Connected</label>
                                                            </div>
                                                            <div class="form-check form-check-inline form-check-danger mb-0 ">
                                                                <input name="connection_status" class="form-check-input" type="radio" value="not_connected" id="customRadioDanger">
                                                            <label class="form-check-label" for="customRadioDanger">Not Connected</label>
                                                        </div>
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                            </div>
                                            <!-- <hr class="mt-0"> -->
                                        </div>

                                        <div class="col-12">
                                            <div class="card-body demo-vertical-spacing demo-only-element pb-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <!-- <h6 class="mt-0">2. Notes*</h6> -->
                                                    <div class="" style="width:100%">
                                                    <div class="mb-6 mt-1 form-floating form-floating-outline">
                                                        <textarea class="form-control" required type="text" placeholder="Enter your notes" id="notes" name="notes" style="width: 100%;height: 100px;resize: none;"></textarea>
                                                        <label for="notes">Notes</label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="card-body demo-vertical-spacing demo-only-element pb-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <!-- <h6 class="mt-0">3. Follow Up Date Time*</h6> -->   
                                                    <div class="" style="width:100%">
                                                        <div class="mb-4 form-floating form-floating-outline">
                                                        <!-- <input class="form-control" type="datetime-local" id="next_date" name="next_date" required >
                                                        <label for="next_date">Next Follow Up Date Time</label> -->
                                                        <div class="form-floating form-floating-outline">
                                                                <input
                                                                name="next_date"
                                                                type="text"
                                                                class="form-control"
                                                                placeholder="YYYY-MM-DD HH:MM"
                                                                id="flatpickr-datetime" />
                                                                <label for="flatpickr-datetime">Next Follow Up Date Time</label>
                                                        </div>
                                                    </div>        
                                                </div>        
                                                </div>
                                            </div>    
                                        </div>

                                        <div class="col-12">
                                            <div class="card-body demo-vertical-spacing demo-only-element">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mt-0">Lead Type*</h6>
                                                    <div class="mb-4 d-flex gap-4">
                                                        <label class="switch switch-danger">
                                                            <input type="radio" class="switch-input" name="lead_type" checked="" value="hot">
                                                            <span class="switch-toggle-slider">
                                                                <span class="switch-on"></span>
                                                                <span class="switch-off"></span>
                                                            </span>
                                                            <span class="switch-label">Hot</span>
                                                        </label>

                                                        <label class="switch switch-warning">
                                                            <input type="radio" class="switch-input" name="lead_type" value="warm">
                                                            <span class="switch-toggle-slider">
                                                                <span class="switch-on"></span>
                                                                <span class="switch-off"></span>
                                                            </span>
                                                            <span class="switch-label">Warm</span>
                                                        </label>

                                                        <label class="switch switch-info">
                                                            <input type="radio" class="switch-input" name="lead_type" value="cold">
                                                            <span class="switch-toggle-slider">
                                                                <span class="switch-on"></span>
                                                                <span class="switch-off"></span>
                                                            </span>
                                                            <span class="switch-label">Cold</span>
                                                        </label>
                                                    </div>        
                                                </div>
                                            </div>    
                                        </div>
                                    
                                        <div class="col-sm-12 text-center">
                                                <div class="form-floating form-floating-outline">
                                                    <input class="form-control" type="hidden" id="lat" readonly name="latitude">
                                                    <!-- <span>Current Latitude:- </span> -->
                                                    <!-- <span class="text-danger" id="latitude"></span>  -->
                                                    <!-- <br> -->
                                                    <input class="form-control" type="hidden" id="long" readonly name="longitude">
                                                    <!-- <span>Current Longitude:- </span> -->
                                                    <!-- <span class="text-danger" id="longitude"></span> -->
                                                    <!-- <br> -->
                                                    <!-- <span>Accuracy:- </span> -->
                                                    <!-- <span class="text-danger" id="accuracy"></span> -->
                                                    <div class="mx-7 alert alert-solid-warning" id="warningMessage" role="alert" style="display:none;">
                                                        Make sure your location is enabled before submitting this form
                                                    </div>
                                                    <div class="mx-7 alert alert-solid-danger" id="errormessage" role="alert" style="display:none;">
                                                        Please turn on location to submit this form!
                                                    </div>
                                                    <div class="mx-7 mb-0 alert text-danger alert-solid-success" id="successmessage" role="alert" style="display:none; width:max-content">
                                                        <span class="d-none" class="" id="latitude"></span><span class="d-none" id="longitude"></span>
                                                        <span class="text-white"  data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Make sure this is below 100" id="accuracy"></span>
                                                    </div>
                                                    
                                                </div>
                                        </div>
                    
                                        <div class="col-sm-12 text-right">
                                            <hr class="m-0">
                                        </div>

                                        <div class="col-sm-12 text-right">
                                            <div class="card-body demo-vertical-spacing demo-only-element">
                                                <!-- <div class="d-flex justify-content-end align-items-center"> -->
                                                    <!-- <div class="mx-7 mb-0 alert text-danger alert-solid-success" id="successmessage" role="alert"> -->
                                                        <span class="d-none" class="" id="latitude"></span><span class="d-none" id="longitude"></span>
                                                        
                                                    <!-- </div> -->
                                                    <!-- <button type="button" id="successmessage" class="btn btn-warning"  style="display:none;" >
                                                        <span class="text-white"  data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Make sure this is below 100" id="accuracy"></span>
                                                    </button> -->
                                                    

                                                    <!-- <button type="submit" id="submit1" name="submit" class="btn btn-success float-right">Submit</button> -->
                                                    
                                                    <div class="row d-flex mt-0">
                                                        <div class="col-md-12">
                                                            <button type="submit" id="submit1"  data-bs-toggle="tooltip" data-bs-placement="left"  class="btn btn-success waves-effect waves-light d-flex float-right" name="submit">Submit</button>
                                                            <button type="reset" class="btn btn-outline-secondary float-left" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                        </div>
                                                    </div>

                                                <!-- </div>         -->
                                            </div>    
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Timeline code -->
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <!-- <h5 class="card-header">Timeline For &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-info"><?php //echo $row_leads['lead_name']; ?></span></h5> -->
                            <h5 class="card-header text-center">Timeline</h5>
                            <hr class="m-0">
                            <div class="card-body">

                                <?php
                                $leads_id = $leads_id_timeline;
                                include_once("timeline_showcase.php");
                                ?>

                            </div>
                        </div>
                    </div>
                    <!-- /timeline code -->
                </div>
               <!-- *************** - /main containt in page write here - **********************  -->

               <script src="assets//js/pages-pricing.js"></script>

              <!-- Add New Credit Card Modal -->
              <div class="modal fade" id="addNewCCModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                  <div class="modal-content px-10 py-8">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form id="addNewCCForm" class="row g-5"  method="POST" action="#">
                        <div class="modal-body p-0">
                            <div class="text-center mb-6">
                                <h4 class="mb-2">Mark As Dead</h4>
                                <p>Do you want to mark a lead as dead? </p>
                            </div>
                            <input type="hidden" value="<?php echo $_REQUEST['assign_leads_id']; ?>" name="assign_leads_id">
                            <div class="col-12 text-center">
                                <div class="mb-4">
                                    <div class="form-check form-check-danger">
                                        <input class="form-check-input" type="checkbox" value="yes" id="customCheckDanger" name="mark_dead" onchange="toggleReasonBox()" style="left: 40%;">
                                        <label class="form-check-label" for="customCheckDanger">Mark Dead</label>
                                    </div>
                                </div>

                                <!-- <div id="reasonBox" class="mb-4" >
                                    <label for="dead_reason" class="form-label">Remark For Mark Dead</label>
                                    <textarea class="form-control" id="dead_reason" placeholder="Write a remark here..." name="dead_reason"></textarea>
                                </div> -->
                                <div id="reasonBox" class="mb-4" style="display:none;">
                                    <div class="col-sm-12 form-floating form-floating-outline">
                                        <textarea class="form-control" id="dead_reason" placeholder="Write a remark here..." name="dead_reason" style="height: 100px;"></textarea>
                                        <label for="dead_reason" class="form-label">Remark For Mark Dead</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer position-relative">
                            <!-- <div class="col-12 d-flex flex-wrap justify-content-center"> -->
                                <button type="submit" name="submit_dead" class="btn btn-success position-absolute end-0">Submit</button>
                                <button type="reset"  class="btn btn-outline-secondary btn-reset position-absolute start-0" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                            <!-- </div> -->
                        </div>
                    </form>
                </div>
                </div>
              </div>
              <!--/ Add New Credit Card Modal -->
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
<script type="text/javascript">
        initGeolocation();
        function prepareForm(event) {
                event.preventDefault();
                // Do something you need
                initGeolocation();
                document.getElementById("myForm").requestSubmit();
        }
        function initGeolocation()
        {
            document.getElementById('warningMessage').style.display = "none";
             document.getElementById('errormessage').style.display = "none";
             document.getElementById('successmessage').style.display = "none";
            window.setInterval(function(){
                navigator.geolocation.getCurrentPosition( success, fail );
            }, 1000);
        }

        function success(position)
        {   
                document.getElementById('warningMessage').style.display = "none";
                document.getElementById('errormessage').style.display = "none";
                document.getElementById('successmessage').style.display = "none";
                document.getElementById('long').value = position.coords.longitude;
                document.getElementById('longitude').innerHTML = position.coords.longitude;
                document.getElementById('lat').value = position.coords.latitude;
                document.getElementById('latitude').innerHTML = position.coords.latitude;
                document.getElementById('accuracy').innerHTML = position.coords.accuracy;
                document.getElementById('submit1').disabled  = false;
        }

        function fail()
        {
            document.getElementById('warningMessage').style.display = "none";
             document.getElementById('errormessage').style.display = "block";
             document.getElementById('successmessage').style.display = "none";
            // alert("Please enable your location and refresh the page, to submit this form.");
            // alert("Sorry, your browser does not support geolocation services.");
            document.getElementById('long').value = "00.0000000";
            document.getElementById('lat').value = "00.0000000";
            document.getElementById('submit1').disabled  = true;
        }
        

</script>    
  </body>
</html>
