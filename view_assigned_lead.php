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

    $connection_status = $_POST['connection_status'];
    $notes = $_POST['notes'];
    $lead_type = $_POST['lead_type'];

    $added_on = date('Y-m-d H-i-s');
    $status = "Followup";
    $t_status_ce = "Not Available";
    $transfer_status = "Available";

    $next_date_time = $_POST['next_date'];
    // Split the datetime into date and time
    $date_time_parts = explode('T', $next_date_time);
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

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `assign_leads` SET 
            `connection_status` = ?, 
            `notes` = ?, 
            `next_date` = ?, 
            `next_time` = ?, 
            `lead_type` = ?, 
            `edited_on` = ?, 
            `status` = ?,
            `transfer_status` = ?
            WHERE `assign_leads_id` = ?";

    $q = $pdo->prepare($sql);
    $q->execute(array($connection_status, $notes, $next_date, $next_time, $lead_type, $added_on, $status, $t_status_ce, $assign_leads_id));

    // ----------------------- Insert for new ffollowup ---------------------------------------------------------
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`,`employee_name`, `status`, `transfer_status`,`next_date`,`next_time`, `added_on`) VALUES (?,?,?,?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($leads_id, $admin_id, $employee_id, $employee_name, $status, $transfer_status, $next_date, $next_time, $added_on));
     // $lastInsertedId = $pdo->lastInsertId();
    
    header('location:assigned_leads.php');
    
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
    $date_time_parts = explode('T', $next_date_time);
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
              <h5 class="card-header mar-bot-10">Leads Details </h5>
                <div class="row">
                    <div class="col-xl-6 col-lg-5 col-md-5 ">
                        <!-- About User -->
                        <div class="card mb-6">
                        <div class="card-body">
                            <small class="card-text text-uppercase text-muted small">About</small>
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
                                <a class="btn btn-secondary" href="transfer_assigned_lead.php?assign_leads_id=<?php echo $row_assign["assign_leads_id"]; ?>">Transfer Lead </a>
                            </div>
                            <div class="col-md-12" style="text-align: right;margin-left: -22px;">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewCCModal"> Mark Dead </button>
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
                                        <input class="form-control" type="datetime-local" id="next_date" name="next_date" required>
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
                                                <input type="radio" class="switch-input" name="lead_type" value="warm">
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on"></span>
                                                    <span class="switch-off"></span>
                                                </span>
                                                <span class="switch-label">Warm</span>
                                            </label>

                                            <label class="switch">
                                                <input type="radio" class="switch-input" name="lead_type" value="cold">
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on"></span>
                                                    <span class="switch-off"></span>
                                                </span>
                                                <span class="switch-label">Cold</span>
                                            </label>

                                            
                                        </div>
                                    </div>

                                    <!-- <div class="mb-4">
                                        <div class="form-check form-check-danger">
                                            <input class="form-check-input" type="checkbox" value="yes" id="customCheckDanger" name="mark_dead" onchange="toggleReasonBox()">
                                            <label class="form-check-label" for="customCheckDanger">Mark Dead</label>
                                        </div>
                                    </div>

                                    <div id="reasonBox" class="mb-4" style="display:none;">
                                        <label for="dead_reason" class="form-label">Remark For Mark Dead</label>
                                        <textarea class="form-control" id="dead_reason" placeholder="Write comment here..." name="dead_reason"></textarea>
                                    </div> -->

                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-outline-info" href="view_leads_for_assigned_SE.php?assign_leads_id=<?php echo $row_assign["assign_leads_id"]; ?>">Assign Lead To Sales Executive </a>
                                        <button type="submit" name="submit" class="btn btn-success logo-btn">Submit</button>
                                        <!-- <a class="btn btn-secondary" href="transfer_assigned_lead.php?assign_leads_id=<?php echo $row_assign["assign_leads_id"]; ?>">Transfer Lead </a> -->
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Timeline code -->
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <h5 class="card-header">Timeline For &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-info"><?php echo $row_leads['lead_name']; ?></span></h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                <caption class="ms-6">Timeline For Lead</caption>
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Time Line Date</th>
                                    <th>Status</th>
                                    <!-- <th>Leads Information</th> -->
                                    <th>Follow Up Details</th>
                                    <th>Transfer Details</th>
                                    <th>Lead Dead</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        

                                        if($leads_id != 0 && $leads_id != "" && $leads_id != null  && $leads_id != "undefined" ) {
                                            if(isset($_REQUEST['assign_leads_id'])) {
                                                $assign_leads_id = $_REQUEST['assign_leads_id'];
                                                $sqlemp = "SELECT * FROM assign_leads where assign_leads_id= $assign_leads_id ";
                                                $q = $pdo->prepare($sqlemp);
                                                $q->execute(array());      
                                                $row_assign = $q->fetch(PDO::FETCH_ASSOC);

                                                $leads_id = $row_assign['leads_id']; 
                                            } else {
                                                $assign_leads_id = 0;
                                            }
                                        } else {
                                            $assign_leads_id = 0;
                                            $leads_id = 0;
                                        }

                                        $i = 1;
                                        $sql = "SELECT * FROM assign_leads where assign_leads_id=$assign_leads_id";
                                        $q = $pdo->query($sql);
                                        foreach ($pdo->query($sql) as $row1) 
                                        { 
                                            $assign_leads_id = $row1['assign_leads_id'];
                                            $leads_id = $row1['leads_id'];
                                            $admin_id = $row1['admin_id'];

                                            $sqlemp = "select * from employee where admin_id = $admin_id ";
                                            $q = $pdo->prepare($sqlemp);
                                            $q->execute(array());      
                                            $row_emp = $q->fetch(PDO::FETCH_ASSOC);

                                           
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?> 
                                        </td>
                                            <td>
                                                <?php echo date("d-m-Y", strtotime($row1['added_on'])); ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if(strtolower($row1["transfer_status"]) == 'trasnfered') {
                                                        if(strtoupper($row1["transfer_employee_type"]) == 'SALES EXECUTIVE') {
                                                            echo '<span class="badge rounded-pill bg-label-success" text-capitalized="">Trasnfered To Sales Executive</span>';
                                                        } else if(strtoupper($row1["transfer_employee_type"]) == 'CUSTOMER EXECUTIVE') {
                                                            echo '<span class="badge rounded-pill bg-label-warning" text-capitalized="">Trasnfered To Customer Executive</span>';
                                                        }
                                                        
                                                    } else if(strtolower($row1["mark_dead"]) == 'yes') {
                                                        echo '<span class="badge rounded-pill bg-label-danger" text-capitalized="">Marked Dead</span>';
                                                    } else {
                                                        echo '<span class="badge rounded-pill bg-label-info" text-capitalized="">No Action Taken</span>';
                                                    }                                                    
                                                ?>
                                            </td>
                                            <!-- <td>
                                                <?php
                                                    // $sqlleads = "select * from leads where id = $leads_id ";
                                                    // $q = $pdo->prepare($sqlleads);
                                                    // $q->execute(array());      
                                                    // $row_leads = $q->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <?php //echo $row_leads["lead_name"]; ?><br>
                                                <?php //echo '- '. $row_leads["phone_no"]; ?><br>
                                                <?php //echo '- '. $row_leads["email_id"]; ?><br>
                                                <?php //echo '-- '. $row_leads["location"]; ?><br>
                                                <?php //echo '-- '. $row_leads["budget_range"]; ?><br>
                                                <?php //echo '-- '. $row_leads["source"]; ?>
                                            </td> -->
                                            <td>
                                                <?php if($row1['next_date'] != "0000-00-00 00:00:00") { ?>
                                                <?php echo $row1["connection_status"]; ?><br>
                                                <?php echo $row1["notes"]; ?><br>
                                                <?php echo $row1["lead_type"]; ?><br>
                                                <?php //echo $row1["remark"]; ?><br>
                                                
                                                <?php echo date("d-m-Y", strtotime($row1["next_date"])); ?><br>
                                                <?php if($row1["next_time"] != "") echo date("H:i", strtotime($row1["next_time"])); ?><br>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if($row1["transfer_status"] == 'Trasnfered'); 
                                                    {
                                                        // echo "To Employee: <br> ";
                                                        // echo $row1["employee_name"].'<br>'.$row1["transfer_reason"]; 
                                                        if(strtoupper($row1["transfer_employee_type"]) == 'SALES EXECUTIVE') {
                                                    ?>
                                                     
                                                     <div class="d-flex justify-content-start align-items-center product-name"><div class="avatar-wrapper me-3"><div class="avatar rounded-3 bg-label-secondary"><img src="assets/img/front-pages/icons/transition-up.png" alt="Product-9" class="rounded-2"></div></div><div class="d-flex flex-column"><span class="text-nowrap text-heading fw-medium"><?php echo $row1["employee_name"]; ?></span><small class="text-truncate d-none d-sm-block"><?php echo $row1["transfer_reason"]; ?></small></div></div>

                                                    <?php } else if(strtoupper($row1["transfer_employee_type"]) == 'CUSTOMER EXECUTIVE') { ?>
                                                       
                                                    <div class="d-flex justify-content-start align-items-center product-name"><div class="avatar-wrapper me-3"><div class="avatar rounded-3 bg-label-secondary"><img src="assets/img/avatars/1.png    " alt="Product-9" class="rounded-2"></div></div><div class="d-flex flex-column"><span class="text-nowrap text-heading fw-medium"><?php echo $row1["employee_name"]; ?></span><small class="text-truncate d-none d-sm-block"><?php echo $row1["transfer_reason"]; ?></small></div></div>
                                                    
                                                    <?php } ?>
                                                    <?php } ?>
                                                
                                            </td>                                            
                                            <td>
                                                <?php 
                                                    if(strtolower($row1["mark_dead"]) == 'yes'); 
                                                    {
                                                        echo '<small class="text-truncate text-danger d-none d-sm-block">'.$row1["dead_reason"].'</small>'; 
                                                    }
                                                ?>
                                            </td>
                                    </tr>
                                    <?php $i++; } ?>
                                </tbody>
                                </table>
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
                  <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                      <div class="text-center mb-6">
                        <h4 class="mb-2">Mark As Dead</h4>
                        <p>Do you want to mark a lead as dead? </p>
                      </div>
                      <form id="addNewCCForm" class="row g-5"  method="POST" action="#">
                        <input type="hidden" value="<?php echo $_REQUEST['assign_leads_id']; ?>" name="assign_leads_id">
                        <div class="col-12">
                            <div class="mb-4">
                                <div class="form-check form-check-danger">
                                    <input class="form-check-input" type="checkbox" value="yes" id="customCheckDanger" name="mark_dead" onchange="toggleReasonBox()">
                                    <label class="form-check-label" for="customCheckDanger">Mark Dead</label>
                                </div>
                            </div>

                            <div id="reasonBox" class="mb-4" style="display:none;">
                                <label for="dead_reason" class="form-label">Remark For Mark Dead</label>
                                <textarea class="form-control" id="dead_reason" placeholder="Write a remark here..." name="dead_reason"></textarea>
                            </div>
                        </div>

                        <div class="col-12 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                          <button type="submit" name="submit_dead" class="btn btn-primary">Submit</button>
                          <button type="reset"  class="btn btn-outline-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                      </form>
                    </div>
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
    
  </body>
</html>
