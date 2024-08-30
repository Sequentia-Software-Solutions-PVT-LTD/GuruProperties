<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

    $i = 1;
    $assign_leads_sr_id = $_REQUEST['assign_leads_sr_id'];
    
    $sqlassign = "SELECT * FROM assign_leads_sr where assign_leads_sr_id = $assign_leads_sr_id ";
    $q = $pdo->prepare($sqlassign);
    $q->execute(array());      
    $row_assign = $q->fetch(PDO::FETCH_ASSOC);

    $leads_id = $row_assign['leads_id'];
    $admin_id = $row_assign['admin_id'];
    $assign_leads_id = $row_assign['assign_leads_id'];

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

    $employee_id = $_POST['transfer_employee_id'];
    $t_employee_id = $_POST['transfer_employee_id'];
    $property_name_id = $_POST['property_name_id'];
    $property_tower_id = $_POST['property_tower_id'];
    // $property_varients_id = $_POST['property_varients_id'];
    $assign_leads_id = $_POST['assign_leads_id'];
    $notes = $_POST['notes'];

    $next_date_time = $_POST['next_date'];
    // Split the datetime into date and time
    $date_time_parts = explode('T', $next_date_time);
    $next_date = $date_time_parts[0];  // 2024-08-22
    $next_time = $date_time_parts[1];  // 02:26

    
    $added_on = date('Y-m-d H-i-s');
    // $status = "Active";

    $property_variants = $_POST['property_variants']; // This is the array of selected variant IDs
    // Convert the array to a comma-separated string
    $property_variants_string = implode(',', $property_variants);


    $sqlemp = "SELECT * FROM assign_leads where assign_leads_id= $assign_leads_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_assign = $q->fetch(PDO::FETCH_ASSOC);
    $leads_id = $row_assign['leads_id'];
    $employee_id = $row_assign['employee_id'];
    $assign_employee_id = $row_assign['employee_id'];
    // $assign_employee_name = $row_assign['employee_name'];

    $sqlemp = "select * from employee where employee_id = $t_employee_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_emp = $q->fetch(PDO::FETCH_ASSOC);
    $employee_name = $row_emp['employee_name'];
    $admin_id = $row_emp['admin_id'];

    $sqlleads = "select * from leads where id = $leads_id ";
    $q = $pdo->prepare($sqlleads);
    $q->execute(array());      
    $row_leads = $q->fetch(PDO::FETCH_ASSOC);

    $sqlemp = "select * from property_name where property_name_id = $property_name_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_emp = $q->fetch(PDO::FETCH_ASSOC);
    $location = $row_emp['location'];

    // $sqlemp = "select * from property_varients where property_varients_id = $property_varients_id  ";
    // $q = $pdo->prepare($sqlemp);
    // $q->execute(array());      
    // $row_emp = $q->fetch(PDO::FETCH_ASSOC);
    // $area = $row_emp['area'];
    // $price = $row_emp['price'];

    $ce_status = 'Assigned';
    $ce_transfer_status = 'Transfered';

    $se_status = 'Active';
    $se_transfer_status = 'Available';

    $se_assign_employee_type = 'SALES EXECUTIVE';
    $ce_assign_employee_type = 'CUSTOMER EXECUTIVE';

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE `assign_leads` SET 
            `transfer_status` = ?, 
            `edited_on` = ?, 
            `status` = ?,
            `assign_employee_type` = ?,
            `transfer_employee_id` = ? 
            WHERE `assign_leads_id` = ?";

    $q = $pdo->prepare($sql);
    $q->execute(array($ce_transfer_status, $added_on, $ce_status, $se_assign_employee_type, $employee_id, $assign_leads_id));
       
    // ------------------ add lead for Sales Executive -----------------------------------

    // $sql = "INSERT INTO `assign_leads_sr`(`assign_leads_id`, `leads_id`, `next_date`, `next_time`, `status`, `admin_id`, `employee_id`, `employee_name`, `employee_type`, `property_id`, `sub_property_id`, `varient`, `location1`, `area`, `rate`, `notes`, `assign_employee_type`, `added_on`) 
    // VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?)";
    // $q = $pdo->prepare($sql);
    // $q->execute(array($assign_leads_id, $leads_id, '$next_date', '$next_time', $status, $admin_id, $employee_id, $employee_name, $assign_employee_type, $property_name_id, $property_tower_id, $property_varients_id, $location, $area, $price, $notes, $assign_employee_type, $added_on));

    $sql = "INSERT INTO `assign_leads_sr`(`assign_leads_id`, `leads_id`, `visit_date`, `visit_time`, `status`,`transfer_status`, `admin_id`, `employee_id`, `employee_name`, `employee_type`, `property_id`, `sub_property_id`, `variant`, `location1`, `notes`, `assign_employee_type`,`assign_employee_id`, `added_on`) 
    VALUES ($assign_leads_id, $leads_id, '$next_date', '$next_time', '$se_status', '$se_transfer_status', $admin_id, $t_employee_id, '$employee_name', '$se_assign_employee_type', $property_name_id, $property_tower_id, '$property_variants_string', '$location', '$notes', '$ce_assign_employee_type','$assign_employee_id', '$added_on')";
    $q = $pdo->prepare($sql);
    $q->execute(array());

    // print_r($sql);
    // exit();

    // header('location:assign_leads_to_sales_executive.php');
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

    <title> Converted Lead Details  |  Guru Properties</title>

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
                        <div class="card-body" style="display:flex; justify-content: space-around;">
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
                        </div>
                        </div>
                        <!--/ About User -->
                        
                    </div>
                    <!--  -->
                    <h5 class="card-header mar-bot-10">Property Details </h5>
                    <!--  -->
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card mb-6" >
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Basic Details</h5>
                                <!-- <a class="btn btn-secondary" href="transfer_assigned_lead.php?assign_leads_id=<?php echo $row_assign["assign_leads_id"]; ?>">Transfer Lead </a> -->
                            </div>

                            <!-- <form action="#" method="post" enctype="multipart/form-data"> -->
                                <input type="hidden" value="<?php echo $_REQUEST['assign_leads_sr_id']; ?>" name="assign_leads_sr_id">
                                <div class="card-body" style="padding-top: 0px;">
                                    <!--  -->
                                    <div style="display: flex; justify-content: space-between;">
                                    <div style="">
                                    <small class="card-text text-uppercase text-muted small">Project Details</small>
                                        <ul class="list-unstyled my-3 py-1" style="">
                                            <?php 

                                                $sqlcon = "SELECT * FROM converted_leads where assign_leads_sr_id = $assign_leads_sr_id ";
                                                $q = $pdo->prepare($sqlcon);
                                                $q->execute(array());      
                                                $row_assign1 = $q->fetch(PDO::FETCH_ASSOC);

                                                $property_id = $row_assign1['property_name_id'];
                                                $sub_property_id = $row_assign1['property_tower_id'];
                                                $variant = $row_assign1['property_variants'];

                                            //  property_varients
                                                $sqlpro = "SELECT * FROM property_name where property_name_id= $property_id ";
                                                $q = $pdo->prepare($sqlpro);
                                                $q->execute(array());      
                                                $row_property = $q->fetch(PDO::FETCH_ASSOC);

                                                $sqltower = "SELECT * FROM property_tower where property_tower_id = $sub_property_id ";
                                                $q = $pdo->prepare($sqltower);
                                                $q->execute(array());      
                                                $row_tower = $q->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">Property Name:</span> <span><?php echo $row_property['property_title']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Location:</span> <span><?php echo $row_property['location']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">Builder Name:</span> <span><?php echo $row_property['builder_name']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">Tower Name:</span> <span><?php echo $row_tower['property_tower_name']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">Builder Possesstion:</span> <span><?php echo $row_tower['builder_possession']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">RERA Possesstion:</span> <span><?php echo $row_tower['rera_possession']; ?></span></li>
                                        </div>
                                        <div style="">
                                            <small class="card-text text-uppercase text-muted small">Varient Details</small>
                                            
                                            <?php 
                                                    $sqlsr = "SELECT * FROM converted_leads WHERE assign_leads_sr_id = :assign_leads_sr_id";
                                                    $stmt = $pdo->prepare($sqlsr);
                                                    $stmt->execute(['assign_leads_sr_id' => $assign_leads_sr_id]);

                                                    while ($row_sr = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        $varient_group = $row_sr['property_variants']; // Assume this is a comma-separated string like "6,5,4"
                                                        
                                                        // Split the variant IDs into an array
                                                        $variant_ids = explode(',', $varient_group);
                                                        
                                                        // Prepare a SQL query to fetch variant names based on these IDs
                                                        $placeholders = implode(',', array_fill(0, count($variant_ids), '?'));
                                                        $sqlVariants = "SELECT varients, area, price FROM property_varients WHERE property_varients_id IN ($placeholders)";
                                                        $stmtVariants = $pdo->prepare($sqlVariants);
                                                        $stmtVariants->execute($variant_ids);
                                                        
                                                        // Fetch the variant details
                                                        $variant_details = $stmtVariants->fetchAll(PDO::FETCH_ASSOC);
                                                        
                                                        // Display each variant's details
                                                        foreach ($variant_details as $variant) {
                                            ?>
                                           
                                                <div style="display : flex; gap: 20px; margin-top:20px;">
                                                    <li class="d-flex align-items-center mb-2" ><span class="fw-medium mx-2">Variants:</span> <span><?php echo htmlspecialchars($variant['varients']); ?></span></li>
                                                    <li class="d-flex align-items-center mb-2"><span class="fw-medium mx-2">Area:</span> <span><?php echo htmlspecialchars($variant['area']); ?></span></li>
                                                    <li class="d-flex align-items-center mb-2"><span class="fw-medium mx-2">Price:</span> <span><?php echo htmlspecialchars($variant['price']); ?></span></li>
                                                </div>
                                            <?php } }?>
                                        
                                        </ul>
                                        </div>


                                        </div>
                                    <!--  -->
                                        <hr>
                                    
                                        <div class="col-xl-12 col-lg-12 col-md-12 ">
                                            <!-- About User -->
                                            <div class="card1 mb-61">
                                                 <small class="card-text text-uppercase text-muted small">Other Details</small>
                                                <div class="card-body" style="display:flex; justify-content: space-around;">
                                                    <!-- <small class="card-text text-uppercase text-muted small">Other Details</small> -->
                                                    <ul class="list-unstyled my-3 py-1" style="">
                                                        <!-- <small class="card-text text-uppercase text-muted small">Values</small> -->
                                                        <li class="d-flex align-items-center mb-4" style="margin-top: 20px;"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Agreement Value:</span> <span><?php echo $row_assign1['agreement_value']; ?></span></li>
                                                        <li class="d-flex align-items-center mb-4"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Registration:</span> <span><?php echo $row_assign1['registrantion']; ?></span></li>
                                                        <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Stamp Duty:</span> <span><?php echo $row_assign1['stamp_duty']; ?></span></li>
                                                        <!-- <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Budget Range:</span> <span><?php echo $row_leads['budget_range']; ?></span></li> -->
                                                    </ul>
                                                    
                                                    <ul class="list-unstyled my-3 py-1" style="">
                                                    <!-- <small class="card-text text-uppercase text-muted small" >Other</small> -->
                                                        <li class="d-flex align-items-center mb-4" style="margin-top: 20px;"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">GST:</span> <span><?php echo $row_assign1['gst']; ?></span></li>
                                                        <li class="d-flex align-items-center mb-4"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Commision:</span><span><?php echo $row_assign1['commission']; ?></span></li>
                                                    </ul>
                                                    
                                                    <ul class="list-unstyled my-3 py-1" style="">
                                                    <!-- <small class="card-text text-uppercase text-muted small" style="margin-bottom:20px;">Price</small> -->
                                                        <li class="d-flex align-items-center mb-4"  style="margin-top: 20px;"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Quoted Price:</span> <span><?php echo $row_assign1['quoted_price']; ?></span></li>
                                                        <li class="d-flex align-items-center mb-4"  style="margin-top: 20px;"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Sale Price:</span> <span><?php echo $row_assign1['sale_price']; ?></span></li>
                                                        <!-- <li class="d-flex align-items-center mb-4"><i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Date:</span> <span><?php echo date("d-M-Y" , strtotime($row_assign1['added_on'])); ?></span></li> -->
                                                    </ul>
                                                </div>
                                                <ul class="list-unstyled my-3 py-1" style="">
                                                <small class="card-text text-uppercase text-muted small" >Notes</small>
                                                    <li class="d-flex align-items-center mb-4" style="align-items: flex-start !important;margin-top: 20px;"><?php echo $row_assign1['notes']; ?></span></li>
                                                </ul>
                                            </div>
                                            <!--/ About User -->
                        
                                        </div>
                                        <!--  -->
                                </div>
                            <!-- </form> -->
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});


          // document.getElementById('propertyDropdown').addEventListener('change', function() {
          //     var propertyId = this.value;

          //     var xhr = new XMLHttpRequest();
          //     xhr.open('POST', 'fetch_towers.php', true);
          //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          //     xhr.onreadystatechange = function() {
          //         if (xhr.readyState === 4 && xhr.status === 200) {
          //             document.getElementById('towerDropdown').innerHTML = xhr.responseText;
          //         }
          //     };
          //     xhr.send('property_id=' + encodeURIComponent(propertyId));
          // });
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
