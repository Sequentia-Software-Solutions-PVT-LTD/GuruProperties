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
    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $property_name_id = $_POST['property_name_id'];
    $property_tower_id = $_POST['property_tower_id'];
    $property_tower_id = $_POST['property_tower_id'];
    // $property_variants = $_POST['property_variants'];
    $notes = $_POST['notes'];
    $agreement_value = $_POST['agreement_value'];
    $registrantion = $_POST['registrantion'];
    $gst = $_POST['gst'];
    $stamp_duty = $_POST['stamp_duty'];
    $commission = $_POST['commission'];
    $quoted_price = $_POST['quoted_price'];
    $sale_price = $_POST['sale_price'];

    $added_on = date('Y-m-d H-i-s');
    $status = "Converted";
    // $t_status_ce = "Not Available";
    $transfer_status = "Converted";
    
    $assign_leads_sr_id = $_POST['assign_leads_sr_id'];

    $property_variants_string = $_POST['property_variants']; // This is the array of selected variant IDs
    // Convert the array to a comma-separated string
    $property_variants = implode(',', $property_variants_string);

    $sqlemp = "SELECT * FROM assign_leads_sr where assign_leads_sr_id = $assign_leads_sr_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_assign = $q->fetch(PDO::FETCH_ASSOC);

    $leads_id = $row_assign['leads_id'];
    $admin_id = $row_assign['admin_id'];
    $employee_id = $row_assign['employee_id'];
    $employee_name = $row_assign['employee_name'];

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `assign_leads_sr` SET 
            `edited_on` = ?, 
            `status` = ?,
            `transfer_status` = ?
            WHERE `assign_leads_sr_id` = ?";

    $q = $pdo->prepare($sql);
    $q->execute(array($added_on, $status, $transfer_status, $assign_leads_sr_id));

    // ----------------------- Insert for new ffollowup ---------------------------------------------------------
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `converted_leads`(`assign_leads_sr_id`,`leads_id`, `admin_id`, `employee_id`, `employee_name`, `added_on`, `property_name_id`, `property_tower_id`, `property_variants`, `notes`, `agreement_value`, `registrantion`, `gst`, `stamp_duty`, `commission`, `quoted_price`, `sale_price`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($assign_leads_sr_id, $leads_id, $admin_id, $employee_id, $employee_name, $added_on, $property_name_id, $property_tower_id, $property_variants, $notes, $agreement_value, $registrantion, $gst, $stamp_duty, $commission, $quoted_price, $sale_price));
     // $lastInsertedId = $pdo->lastInsertId();
    
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

    <title> Convert Lead  |  Guru Properties</title>

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
                                <h5 class="card-title mb-0"><i class="ri-survey-line ri-24px text-body me-2"></i>Add Convert Details</h5>
                            </div>

                            <form action="#" method="post">
                                <input type="hidden" value="<?php echo $_REQUEST['assign_leads_sr_id']; ?>" name="assign_leads_sr_id">
                                <div class="card-body" style="padding-top: 0px;">

                                    <!--  -->
                                    <div class="row g-4">
                                        <div class="row">
                                          <h5 class="card-header mt-4" style="padding-left: 0px;"> Property Details </h5>
                                          <div class="col-md-12">
                                              
                                              <div class="row">
                                                  <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Title</label>
                                                  <div class="col-sm-9">
                                                      <select id="propertyDropdown" name="property_name_id" class="select2 form-select select2-hidden-accessiblee" data-allow-clear="true" required>
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

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Tower</label>
                                                    <div class="col-sm-9">
                                                        <select id="towerDropdown" name="property_tower_id" class="select2 form-select select2-hidden-accessiblee" data-allow-clear="true" required>
                                                            <option value="">Select Property Tower</option>
                                                            <!-- Towers will be loaded here based on the selected property -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Variants</label>
                                                    <div class="col-sm-9">
                                                        <!-- <select id="variantDropdown" name="property_variants[]" class="js-example-basic-single select2 form-select select2-hidden-accessiblee" multiple="multiple" data-allow-clear="true" required> -->
                                                        <select id="variantDropdown" name="property_variants[]" class="js-example-basic-single select2 form-select select2-hidden-accessiblee" data-allow-clear="true" required>
                                                            <option value="">Select Variants</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="row">
                                          <h5 class="card-header mt-4" style="padding-left: 0px;"> Other Details </h5>
                                          
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <label class="col-sm-4 col-form-label text-sm-end mar-top1" style="margin-top: -10px;"> Agreement Value</label>
                                                  <div class="col-sm-8">
                                                    <input class="form-control" type="number" placeholder="Agreement Value" id="stamp_duty" name="agreement_value">
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-md-12">
                                              <div class="row">
                                                  <label class="col-sm-4 col-form-label text-sm-end mar-top"> Registration </label>
                                                  <div class="col-sm-8">
                                                    <input class="form-control" type="number" placeholder="Registration" id="Registration" name="registrantion">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <label class="col-sm-4 col-form-label text-sm-end mar-top"> GST </label>
                                                  <div class="col-sm-8">
                                                    <input class="form-control" type="number" placeholder="GST Amount" id="gst" name="gst">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <label class="col-sm-4 col-form-label text-sm-end mar-top"> Stamp Duty</label>
                                                  <div class="col-sm-8">
                                                    <input class="form-control" type="number" placeholder="Stamp Duty" id="stamp_duty" name="stamp_duty">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <label class="col-sm-4 col-form-label text-sm-end mar-top"> Commission </label>
                                                  <div class="col-sm-8">
                                                    <input class="form-control" type="number" placeholder="Commission To Guru Properties" id="commission" name="commission">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <label class="col-sm-4 col-form-label text-sm-end mar-top"> Quoted Price </label>
                                                  <div class="col-sm-8">
                                                    <input class="form-control" type="number" placeholder="Quoted Price " id="quoted_price" name="quoted_price">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <label class="col-sm-4 col-form-label text-sm-end mar-top"> Sale Price </label>
                                                  <div class="col-sm-8">
                                                    <input class="form-control" type="number" placeholder="Sale Price" id="sale_price" name="sale_price">
                                                  </div>
                                              </div>
                                          </div>
                                          
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <label class="col-sm-4 col-form-label text-sm-end mar-top">Notes</label>
                                                  <div class="col-sm-8">
                                                    <input class="form-control" type="text" placeholder="Enter your notes" id="notes" name="notes">
                                                  </div>
                                              </div>
                                          </div>

                                        </div>
                                    </div>
                                    <!-- /new form -->
                                    <!--  -->

                                    <div class="d-flex justify-content-between">
                                        <button type="submit" name="submit" class="btn btn-success logo-btn">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
               <!-- *************** - /main containt in page write here - **********************  -->

               <script src="assets//js/pages-pricing.js"></script>

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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
            // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

    </script>

<script>
        // Fetch towers based on selected property
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

        // Fetch variants based on selected tower
        document.getElementById('towerDropdown').addEventListener('change', function() {
        var towerId = this.value;
        var xhr = new XMLHttpRequest();
        // alert(towerId);
        xhr.open('POST', 'fetch_variants.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('variantDropdown').innerHTML = xhr.responseText;
            }
        };
        xhr.send('tower_id=' + encodeURIComponent(towerId));
    });

</script>
    
  </body>
</html>
