<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

    $i = 1;
    $assign_leads_sr_id = $_REQUEST['assign_leads_sr_id'];
    
    $sqlemp = "SELECT * FROM assign_leads_sr where assign_leads_sr_id= $assign_leads_sr_id ";
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

    $sqllocation = "select * from location ";
    $qlocation = $pdo->prepare($sqllocation);
    $qlocation->execute(array());      
    $row_location = $qlocation->fetchAll(PDO::FETCH_ASSOC);

  if(isSet($_POST["submit"]))
  { 
    echo "<pre>";
    // print_r($_POST);
    // exit();

    $added_on = date('Y-m-d H-i-s');

    $assign_leads_sr_id = $_POST['assign_leads_sr_id'];
    $leads_id = $_POST['leads_id'];

    // $transfer_employee_type = 'CUSTOMER EXECUTIVE';
    $transfer_employee_id = $_POST['transfer_employee_id'];
    $transfer_reason = $_POST['transfer_reason'];

    $next_date_time = $_POST['next_date'];
    // Split the datetime into date and time
    $date_time_parts = explode('T', $next_date_time);
    $next_date = $date_time_parts[0];  // 2024-08-22
    $next_time = $date_time_parts[1];  // 02:26 

    $sqlassign_sr = "SELECT * FROM assign_leads_sr where assign_leads_sr_id = $assign_leads_sr_id ";
    $q = $pdo->prepare($sqlassign_sr);
    $q->execute(array());      
    $row_assign_sr = $q->fetch(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($row_assign_sr);
    // exit();

    $assign_leads_id = $row_assign_sr['assign_leads_id'];    
    $assign_by_emp_id = $row_assign_sr['employee_id'];    
    $assign_by_admin_id = $row_assign_sr['admin_id'];    
    $assign_by_emp_name = $row_assign_sr['employee_name'];    
    $assign_by_emp_type = $row_assign_sr['employee_type'];

    $property_id = $row_assign_sr['property_id'];
    $sub_property_id = $row_assign_sr['sub_property_id'];
    $variant = $row_assign_sr['variant'];
    $location1 = $row_assign_sr['location1'];

    $from_SE = 'From SE';       
    $Active = 'Active';
    $Transferred = 'Transferred';
    $Available = 'Available';
    $Admin_Pending = 'Admin Pending';

    $sqlemp = "SELECT * FROM employee where employee_id = $transfer_employee_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_assign1 = $q->fetch(PDO::FETCH_ASSOC);

    $admin_id = $row_assign1['admin_id'];
    $employee_name = $row_assign1['employee_name'];
    $transfer_employee_type = $row_assign1['login_role'];

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    if($transfer_employee_type == 'SALES EXECUTIVE')
    {

        //------------------------- transfer lead to SE-SE (update existing) ----------------------------------------- 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE `assign_leads_sr` SET  
            `edited_on` = ?, 
            `transfer_status` = ?,
            `transfer_reason` = ?,
            `transfer_employee_id` = ?,
            `transfer_employee_type` = ?,
            `status` = ?,
            `latitude` = ?, 
            `longitude` = ?
            WHERE `assign_leads_sr_id` = ?";

        $q = $pdo->prepare($sql);
        $q->execute(array($added_on, $Transferred, $transfer_reason, $transfer_employee_id, $transfer_employee_type, $Active, $latitude, $longitude, $assign_leads_sr_id));

        // ---------------------- transfer lead to SE-SE (insert new row)-------------------------------------------------------------------------------------------
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO `assign_leads_sr`(`leads_id`,`assign_leads_id`, `admin_id`, `employee_id`,`employee_name`,`employee_type`, `status`, `transfer_status`, `next_date`, `next_time`, `added_on`, `admin_request_date`,`request_for_admin`,`property_id`, `sub_property_id`,`variant`,`location1`,`assign_employee_id`,`assign_employee_type`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($leads_id, $assign_leads_id, $admin_id, $transfer_employee_id, $employee_name, 'SALES EXECUTIVE', $Transferred, $Admin_Pending, $next_date, $next_time, $added_on, $added_on, 'no', $property_id, $sub_property_id, $variant, $location1 , $assign_by_emp_id, 'SALES EXECUTIVE'));
        
        // $lastInsertedId = $pdo->lastInsertId();
    }
    else {
         //------------------------- transfer lead to SE-CE (update existing) ----------------------------------------- 
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         $sql = "UPDATE `assign_leads_sr` SET  
             `edited_on` = ?, 
             `transfer_status` = ?,
             `transfer_reason` = ?,
             `transfer_employee_id` = ?,
             `transfer_employee_type` = ?,
             `status` = ?,
              `latitude` = ?, 
              `longitude` = ?
             WHERE `assign_leads_sr_id` = ?";
 
         $q = $pdo->prepare($sql);
         $q->execute(array($added_on, $Transferred, $transfer_reason, $transfer_employee_id, $transfer_employee_type, $Active, $latitude, $longitude, $assign_leads_sr_id));
 
         // ---------------------- transfer lead to SE-SE (insert new row) -------------------------------------------------------------------------------------------
         
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`,`employee_name`,`assign_employee_type`, `status`, `transfer_status`,`transfer_employee_id`,`transfer_employee_type`, `transfer_reason`, `next_date`, `next_time`, `added_on`, `admin_request_date`, `request_for_admin`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
         $q = $pdo->prepare($sql);
         $q->execute(array($leads_id, $admin_id, $transfer_employee_id, $employee_name,'Customer EXECUTIVE', $from_SE, $Admin_Pending, $assign_by_emp_id, $assign_by_emp_type, $transfer_reason, $next_date, $next_time, $added_on, $added_on, 'no'));
         
    }

    // print_r($sql);
    // exit();
    // header('location:transfer_leads.php');
    header('location:view_tomorrow_leads_SE.php');
     
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

    <title> Transfer Lead By SE  |  Guru Properties</title>

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
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
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
                    <div class="col-xl-6 col-lg-6">
                        <div class="row  justify-content-between align-items-center">
                            <div class="col-12">
                                <div class="card mb-6 h-100">
                                    <div class="card-header header-elements">
                                        <!-- <h5 class="mb-0 me-2"><i class="ri-survey-line ri-24px text-body me-2"></i>Add Follow Up Details</h5> -->
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
                                        
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-12">
                                <div class="card pb-5 h-100" >

                                    <form action="#" method="post" enctype="multipart/form-data">
                                            <input type="hidden" value="<?php echo $_REQUEST['assign_leads_sr_id']; ?>" name="assign_leads_sr_id">
                                            <input type="hidden" value="<?php echo $row_assign['leads_id']; ?>" name="leads_id">

                                            <div class="card-header header-elements">
                                                <h5 class="card-action-title mb-0"><i class="ri-survey-line ri-24px me-2"></i>Add Transfer Details</h5>
                                                <div class="card-header-elements ms-sm-auto">
                                                    <div class="btn-group">
                                                        <button type="submit" name="submit1" id="submit1"  class="btn btn-primary waves-effect waves-light">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="m-0">   

                                            <!-- <div class="card-body demo-vertical-spacing demo-only-element">
                                                <h5 class="card-action-title  mb-0">Property Details</h5>
                                                <hr class="mt-1">
                                            </div> -->
                                            <div class="col-md-12 pt-8">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <div class="d-flex justify-content-between  align-items-center">
                                                        <h6 class="w-max-content mb-0">1. Select Employee*</h6>
                                                        <!-- <div class="mb-4"> -->
                                                            <!-- <label class="form-label">Connection Status</label> -->
                                                            <div class="d-flex gap-4" style="width:72%">
                                                                    <!-- <div class="row mt-4"> -->
                                                                    <!-- <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Title</label> -->
                                                                    <!-- <div class="col-sm-12 form-floating form-floating-outline"> -->
                                                                    <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <select id="roleDropdown" name="transfer_employee_id" class="form-select" required>
                                                                        <option value="">Select Employee</option>
                                                                        <!-- PHP to generate grouped options -->
                                                                        <?php
                                                                        $sql = "SELECT * FROM employee WHERE status='Active' AND login_role IN ('CUSTOMER EXECUTIVE', 'SALES EXECUTIVE') ORDER BY login_role";
                                                                        $stmt = $pdo->query($sql);
                                                                        $currentRole = '';

                                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                            $employeeRole = $row['login_role'];

                                                                            // Add a header if the role changes
                                                                            if ($employeeRole !== $currentRole) {
                                                                                if ($currentRole != '') {
                                                                                    echo '<option disabled></option>'; // Add a separator
                                                                                }
                                                                                echo '<option disabled>' . htmlspecialchars($employeeRole) . 's ARE</option>';
                                                                                $currentRole = $employeeRole;
                                                                            }

                                                                            // Add the employee option
                                                                            echo '<option value="' . htmlspecialchars($row['employee_id']) . '">' 
                                                                            . htmlspecialchars($row['employee_name']) . ' - ' 
                                                                            . htmlspecialchars($row['location']) 
                                                                            . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>                                        
                                                                    <label for="roleDropdown">Customer Executive</label>
                                                                    </div>
                                                                    <!-- </div> -->
                                                            </div>
                                                        <!-- </div> -->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <!-- <h6 class="mt-0">2. Remark For Today's Visit*</h6> -->
                                                        <h6 class="my-0">2. Follow Up*</h6>
                                                        <div class="d-flex gap-4" style="width: 72%;">
                                                            <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                <input class="form-control" type="datetime-local" id="next_date" name="next_date" required>
                                                                <label for="next_date">Next Follow Up Date Time</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="my-0">3. Reason*</h6>
                                                            <div class="d-flex gap-4" style="width: 72%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <textarea class="form-control" id="transfer_reason" placeholder="Write Reason here..." required name="transfer_reason" style="height: 100px;"></textarea>
                                                                    <label for="transfer_reason">Reason For Transfer</label>
                                                                </div>
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
                        
                                            <!-- <div class="col-sm-12 text-right">
                                                <hr class="m-0">
                                            </div> -->

                                            <div class="col-sm-12 text-right">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <span class="d-none" class="" id="latitude"></span><span class="d-none" id="longitude"></span>
                                                        <!-- <button type="submit" name="submit1" id="submit1" class="btn btn-success">Submit</button> -->
                                                    </div>        
                                                </div>    
                                            </div>
                                    </form>

                                </div>
                            </div>
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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>
