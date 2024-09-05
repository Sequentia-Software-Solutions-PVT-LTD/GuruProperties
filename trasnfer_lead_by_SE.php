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
    $Transfered = 'Transfered';
    $Available = 'Available';
    $Admin_Pending = 'Admin Pending';

    $sqlemp = "SELECT * FROM employee where employee_id = $transfer_employee_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_assign1 = $q->fetch(PDO::FETCH_ASSOC);

    $admin_id = $row_assign1['admin_id'];
    $employee_name = $row_assign1['employee_name'];
    $transfer_employee_type = $row_assign1['login_role'];

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
            `status` = ?
            WHERE `assign_leads_sr_id` = ?";

        $q = $pdo->prepare($sql);
        $q->execute(array($added_on, $Transfered, $transfer_reason, $transfer_employee_id, $transfer_employee_type, $Active, $assign_leads_sr_id));

        // ---------------------- transfer lead to SE-SE (insert new row)-------------------------------------------------------------------------------------------
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO `assign_leads_sr`(`leads_id`,`assign_leads_id`, `admin_id`, `employee_id`,`employee_name`,`employee_type`, `status`, `transfer_status`, `next_date`, `next_time`, `added_on`, `admin_request_date`,`request_for_admin`,`property_id`, `sub_property_id`,`variant`,`location1`,`assign_employee_id`,`assign_employee_type`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($leads_id, $assign_leads_id, $admin_id, $transfer_employee_id, $employee_name, 'SALES EXECUTIVE', $Transfered, $Admin_Pending, $next_date, $next_time, $added_on, $added_on, 'Yes', $property_id, $sub_property_id, $variant, $location1 , $assign_by_emp_id, 'SALES EXECUTIVE'));
        
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
             `status` = ?
             WHERE `assign_leads_sr_id` = ?";
 
         $q = $pdo->prepare($sql);
         $q->execute(array($added_on, $Transfered, $transfer_reason, $transfer_employee_id, $transfer_employee_type, $Active, $assign_leads_sr_id));
 
         // ---------------------- transfer lead to SE-SE (insert new row) -------------------------------------------------------------------------------------------
         
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`,`employee_name`,`assign_employee_type`, `status`, `transfer_status`,`transfer_employee_id`,`transfer_employee_type`, `transfer_reason`, `next_date`, `next_time`, `added_on`, `admin_request_date`, `request_for_admin`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
         $q = $pdo->prepare($sql);
         $q->execute(array($leads_id, $admin_id, $transfer_employee_id, $employee_name,'Customer EXECUTIVE', $from_SE, $Admin_Pending, $assign_by_emp_id, $assign_by_emp_type, $transfer_reason, $next_date, $next_time, $added_on, $added_on, 'Yes'));
         
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
                              <input type="hidden" value="<?php echo $_REQUEST['assign_leads_sr_id']; ?>" name="assign_leads_sr_id">
                              <input type="hidden" value="<?php echo $row_assign['leads_id']; ?>" name="leads_id">
                                <div class="card-body" style="padding-top: 0px;">
                                    
                                    <!-- <div class="mb-4">
                                        <label for="notes" class="form-label">Select Employee</label>
                                        <select id="roleDropdown" name="transfer_employee_id" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                          <option value="" data-select2-id="18">Select Employee</option>
                                            <?php
                                                $sql = "SELECT * FROM  employee where status='Active' and login_role='CUSTOMER EXECUTIVE'  and login_role='SALES EXECUTIVE'";
                                                foreach ($pdo->query($sql) as $row) 
                                                { 
                                                ?>
                                                  <option value="<?php echo $row['employee_id']?>"><?php echo $row['employee_name']?></option> 
                                              <?php } ?>
                                          </select>
                                    </div> -->

                                    <div class="mb-4">
                                        <label for="roleDropdown" class="form-label">Select Employee</label>
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
                                    </div>

                                    <!-- <div class="col-md-6 mb-6">
                                        <div class="form-floating form-floating-outline form-floating-bootstrap-select">
                                        <div class="dropdown bootstrap-select w-100 dropup"><select id="selectpickerGroups" class="selectpicker w-100" data-style="btn-default" tabindex="null">
                                            <optgroup label="Movies">
                                            <option>Rocky</option>
                                            <option>Pulp Fiction</option>
                                            <option>The Godfather</option>
                                            </optgroup>
                                            <optgroup label="Series">
                                            <option>Breaking Bad</option>
                                            <option>Black Mirror</option>
                                            <option>Money Heist</option>
                                            </optgroup>
                                        </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-default show" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox" aria-expanded="true" title="Rocky" data-id="selectpickerGroups"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Rocky</div></div> </div></button><div class="dropdown-menu show" style="max-height: 213.764px; overflow: hidden; min-height: 130px; position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(0px, -49.7778px, 0px);" data-popper-placement="top-start"><div class="inner show" role="listbox" id="bs-select-2" tabindex="-1" aria-activedescendant="bs-select-2-1" style="max-height: 197.764px; overflow: hidden auto; min-height: 114px;"><ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;"><li class="dropdown-header optgroup-1"><span class="text">Movies</span></li><li class="optgroup-1 selected active"><a role="option" class="dropdown-item opt selected active" id="bs-select-2-1" tabindex="0" aria-setsize="6" aria-posinset="1" aria-selected="true"><span class="text">Rocky</span></a></li><li class="optgroup-1"><a role="option" class="dropdown-item opt" id="bs-select-2-2" tabindex="0" aria-setsize="6" aria-posinset="2"><span class="text">Pulp Fiction</span></a></li><li class="optgroup-1"><a role="option" class="dropdown-item opt" id="bs-select-2-3" tabindex="0" aria-setsize="6" aria-posinset="3"><span class="text">The Godfather</span></a></li><li class="dropdown-divider optgroup-1div"></li><li class="dropdown-header optgroup-2"><span class="text">Series</span></li><li class="optgroup-2"><a role="option" class="dropdown-item opt" id="bs-select-2-6" tabindex="0" aria-setsize="6" aria-posinset="4"><span class="text">Breaking Bad</span></a></li><li class="optgroup-2"><a role="option" class="dropdown-item opt" id="bs-select-2-7" tabindex="0" aria-setsize="6" aria-posinset="5"><span class="text">Black Mirror</span></a></li><li class="optgroup-2"><a role="option" class="dropdown-item opt" id="bs-select-2-8" tabindex="0" aria-setsize="6" aria-posinset="6"><span class="text">Money Heist</span></a></li></ul></div></div></div>
                                        <label for="selectpickerGroups" class="form-floating-bootstrap-select-label">Groups</label>
                                        </div>
                                    </div> -->

                                    <div class="mb-4">
                                        <label for="next_date" class="form-label">Next Follow Up Date Time</label>
                                        <input class="form-control" type="datetime-local" id="next_date" name="next_date" required>
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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>
