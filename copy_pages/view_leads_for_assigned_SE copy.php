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
    $date_time_parts = explode(' ', $next_date_time);
    $next_date = $date_time_parts[0];  // 2024-08-22
    $next_time = $date_time_parts[1];  // 02:26

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
       
    header('location:assign_leads_to_sales_executive.php');
     
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

    <title> Assign Leads To Sales Executive  |  Guru Properties</title>

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
                    <div class="col-xl-12 col-lg-12 col-md-12 ">
                        <!-- About User -->
                        <div class="card mb-6">
                        <div class="card-body demo-vertical-spacing demo-only-element" style="display:flex; justify-content: space-around;">
                            <!-- <small class="card-text text-uppercase text-muted small">About</small> -->
                            <ul class="list-unstyled my-3 py-1" style="">
                              <small class="card-text text-uppercase text-muted small">About</small>
                                <li class="d-flex align-items-center mb-4" style="margin-top: 20px;"><i class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">Lead Name:</span> <span><?php echo $row_leads['lead_name']; ?></span></li>
                                <li class="d-flex align-items-center mb-4"><i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Location:</span> <span><?php echo $row_leads['location']; ?></span></li>
                                <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Budget Range:</span> <span><?php echo $row_leads['budget_range']; ?></span></li>
                                <!-- <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Budget Range:</span> <span><?php echo $row_leads['budget_range']; ?></span></li> -->
                            </ul>
                            
                            <ul class="list-unstyled my-3 py-1" style="">
                              <small class="card-text text-uppercase text-muted small" >Contacts</small>
                                <li class="d-flex align-items-center mb-4" style="margin-top: 20px;"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Contact:</span> <span><?php echo $row_leads['phone_no']; ?></span></li>
                                <li class="d-flex align-items-center mb-4"><i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Email ID:</span> <span><?php echo $row_leads['email_id']; ?></span></li>
                            </ul>
                            
                            <ul class="list-unstyled my-3 py-1" style="">
                              <small class="card-text text-uppercase text-muted small" style="margin-bottom:20px;">Other</small>
                                <li class="d-flex align-items-center mb-4"  style="margin-top: 20px;"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Source:</span> <span><?php echo $row_leads['source']; ?></span></li>
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
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card mb-6" >
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0"><i class="ri-survey-line ri-24px text-body me-2"></i>Form for assign Sales Executive to lead</h5>
                            </div>
                            <form action="#" method="post">
                                <input type="hidden" value="<?php echo $_REQUEST['assign_leads_id']; ?>" name="assign_leads_id">
                                <div class="card-body demo-vertical-spacing demo-only-element" style="padding-top: 0px;">

                                    <!-- new form -->
                                    <div class="row g-4">
                                    <div class="row">
                                        <h5 class="card-header mt-4" style="padding-left: 0px;"> Employee </h5>
                                        
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <label class="col-sm-3 col-form-label text-sm-end mar-top">Select Sales Executive</label>
                                                  <div class="col-sm-5">
                                                      <select id="roleDropdown" name="transfer_employee_id" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                                          <option value="" data-select2-id="18">Select Sales Executive</option>
                                                            <?php
                                                                $sql = "SELECT * FROM  employee where status='Active' and login_role='SALES EXECUTIVE' ";
                                                                foreach ($pdo->query($sql) as $row) 
                                                                { 
                                                            ?>
                                                                  <option value="<?php echo $row['employee_id']?>"><?php echo $row['employee_name']?></option> 
                                                              <?php } ?>
                                                      </select>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>                         
                                    </div>
                                    <!--  -->
                                    <!-- <h5 class="card-header mt-4" style="padding-left: 0px;"> Employee </h5> -->
                                    <div class="row g-4">
                                        <div class="row">
                                          <h5 class="card-header mt-4" style="padding-left: 0px;"> Property Details </h5>
                                          <div class="col-md-6">
                                              
                                              <div class="row">
                                                  <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Title</label>
                                                  <div class="col-sm-9">
                                                      <select id="propertyDropdown" name="property_name_id" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" required>
                                                          <option value="">Select Property Name</option>
                                                          <?php
                                                              $sql = "SELECT * FROM property_name";
                                                              foreach ($pdo->query($sql) as $row) { 
                                                                  echo '<option value="'.$row['property_name_id'].'">'.$row['property_title'].'</option>';
                                                              }
                                                          ?>
                                                      </select>
                                                  </div>
                                              </div>
                                          </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Tower</label>
                                                    <div class="col-sm-9">
                                                        <select id="towerDropdown" name="property_tower_id" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" required>
                                                            <option value="">Select Property Tower</option>
                                                            <!-- Towers will be loaded here based on the selected property -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="row">
                                          <div class="col-md-6">
                                              <div class="row">
                                                  <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Variants</label>
                                                  <div class="col-sm-9">
                                                      <select id="propertyDropdown" name="property_varients" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" required>
                                                          <option value="">Select Variants</option>
                                                          <?php
                                                              $sql = "SELECT * FROM property_varients";
                                                              foreach ($pdo->query($sql) as $row) { 
                                                                  echo '<option value="'.$row['property_varients_id'].'">'.$row['varients'].'</option>';
                                                              }
                                                          ?>
                                                      </select>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                          <h5 class="card-header mt-4" style="padding-left: 0px;"> Visit Detail </h5>
                                          <div class="col-md-6">
                                              <div class="row">
                                                  <label class="col-sm-3 col-form-label text-sm-end mar-top"> Visit Date</label>
                                                  <div class="col-sm-9">
                                                    <input class="form-control" type="datetime-local" id="next_date" name="next_date">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="row">
                                                  <label class="col-sm-3 col-form-label text-sm-end mar-top">Notes</label>
                                                  <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Enter your notes" id="notes" name="notes">
                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                    <!-- /new form -->
                                    
                                                            

                                    <div class="d-flex justify-content-between"><br>
                                        <button type="submit" name="submit" class="btn btn-success logo-btn" style="margin-top:30px;">
                                            Submit
                                        </button>
                                        <!-- <a class="btn btn-secondary" href="transfer_assigned_lead.php?assign_leads_id=<?php echo $row_assign["assign_leads_id"]; ?>">Transfer Lead </a> -->
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
       <!-- Include necessary JavaScript for Select2 -->
<!-- Include necessary JavaScript for Select2 and AJAX -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->

<script>
          document.getElementById('propertyDropdown').addEventListener('change', function() {
              var propertyId = this.value;

              var xhr = new XMLHttpRequest();
              xhr.open('POST', 'fetch_towers.php', true);
              xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
              xhr.onreadystatechange = function() {
                  if (xhr.readyState === 4 && xhr.status === 200) {
                      document.getElementById('towerDropdown').innerHTML = xhr.responseText;
                  }
              };
              xhr.send('property_id=' + encodeURIComponent(propertyId));
          });
      </script>

  </body>
</html>
