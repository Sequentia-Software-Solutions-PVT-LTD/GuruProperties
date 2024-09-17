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

    $today_date = date('Y-m-d');
    $sqllocation = "select * from location ";
    $qlocation = $pdo->prepare($sqllocation);
    $qlocation->execute(array());      
    $row_location = $qlocation->fetchAll(PDO::FETCH_ASSOC);

  if(isSet($_POST["submit"]))
  { 
    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $property_name_id = $_POST['property_name_id'];
    $property_tower_id = $_POST['property_tower_id'];
    $property_tower_id = $_POST['property_tower_id'];
    // $property_variants = $_POST['property_variants'];

    $contact_person_name = $_POST['contact_person_name'];
    $contact_person_phone = $_POST['contact_person_phone'];

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
    $sql = "INSERT INTO `converted_leads`(`assign_leads_sr_id`,`leads_id`, `admin_id`, `employee_id`, `employee_name`, `added_on`, `property_name_id`, `property_tower_id`, `property_variants`, `notes`, `agreement_value`, `registrantion`, `gst`, `stamp_duty`, `commission`, `quoted_price`, `sale_price`, `contact_person_name`,`contact_person_phone`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($assign_leads_sr_id, $leads_id, $admin_id, $employee_id, $employee_name, $added_on, $property_name_id, $property_tower_id, $property_variants, $notes, $agreement_value, $registrantion, $gst, $stamp_duty, $commission, $quoted_price, $sale_price, $contact_person_name, $contact_person_phone));
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

                    <div class="col-xl-6 col-lg-6">
                        <div class="row  justify-content-between align-items-center">
                            <div class="col-12">
                                <div class="card mb-6 h-100">
                                    <div class="card-header header-elements">
                                        <!-- <h5 class="mb-0 me-2"><i class="ri-survey-line1 ri-24px text-body me-2"></i>Add Follow Up Details</h5> -->
                                        <h5 class="card-action-title mb-0 underline">Lead Details</h5>
                                        
                                        <!-- <div class="card-header-elements ms-sm-auto">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" style="visibility:hidden;">Update</button>
                                            </div>
                                        </div> -->
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

                                        <!-- <hr class="m-0"> -->
                                        <!-- <div class="card-body demo-vertical-spacing demo-only-element"> -->
                                            <!-- <small class="card-text text-uppercase text-muted small">About</small> -->
                                            <h5 class="card-action-title  mb-0">Project Details</h5>
                                            <hr class="mt-1">
                                            <?php 
                                                $sqlsr = "SELECT * FROM assign_leads_sr where assign_leads_sr_id= $assign_leads_sr_id ";
                                                $q = $pdo->prepare($sqlsr);
                                                $q->execute(array());      
                                                $row_assign1 = $q->fetch(PDO::FETCH_ASSOC);

                                                $property_id = $row_assign1['property_id'];
                                                $sub_property_id = $row_assign1['sub_property_id'];
                                                $variant = $row_assign1['variant'];

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
                                            <ul class="list-unstyled my-3 py-1" style="">
                                                    <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">Property Name:</span> <span class="fw-bold"><?php echo $row_property['property_title']; ?></span></li>
                                                    <li class="d-flex align-items-center mb-4"><i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Location:</span> <span class="fw-bold"><?php echo $row_property['location']; ?></span></li>
                                                    <!-- <li class="d-flex align-items-center mb-4"><i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Google Location:</span>Latitude: <span class="fw-bold"><?php //echo $row_property['google_location_lat']; ?> & </span>   &nbsp;Longitude: <span class="fw-bold"><?php //echo $row_property['google_location_long']; ?> </span></li> -->
                                                    <li class="d-flex align-items-center mb-4"><i class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">Builder Name:</span> <span class="fw-bold"><?php echo $row_property['builder_name']; ?></span></li>
                                                    <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">Tower Name:</span> <span class="fw-bold"><?php echo $row_tower['property_tower_name']; ?></span></li>
                                                    <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">Builder Possession:</span> <span class="fw-bold"><?php echo $row_tower['builder_possession']; ?></span></li>
                                                    <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">RERA Possession:</span> <span class="fw-bold"><?php echo $row_tower['rera_possession']; ?></span></li>
                                            </ul>
                                            <!-- <small class="card-text text-uppercase text-muted small" >Contacts</small> -->
                                            <!-- <hr> -->
                                            <h5 class="card-action-title  mb-0">Varient Details</h5>
                                            <hr class="mt-1">
                                            <?php 
                                                $sqlsr = "SELECT * FROM assign_leads_sr WHERE assign_leads_sr_id = :assign_leads_sr_id";
                                                $stmt = $pdo->prepare($sqlsr);
                                                $stmt->execute(['assign_leads_sr_id' => $assign_leads_sr_id]);

                                                while ($row_sr = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $varient_group = $row_sr['variant']; // Assume this is a comma-separated string like "6,5,4"
                                                    
                                                    // Split the variant IDs into an array
                                                    $variant_ids = explode(',', $varient_group);
                                                    
                                                    // Prepare a SQL query to fetch variant names based on these IDs
                                                    $placeholders = implode(',', array_fill(0, count($variant_ids), '?'));
                                                    $sqlVariants = "SELECT varients, area, price FROM property_varients WHERE property_varients_id IN ($placeholders)";
                                                    $stmtVariants = $pdo->prepare($sqlVariants);
                                                    $stmtVariants->execute($variant_ids);
                                                    
                                                    // Fetch the variant details
                                                    $variant_details = $stmtVariants->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                            <ul class="list-unstyled my-3 py-1" style="">
                                            <!-- <div style="display : flex; gap: 20px; margin-top:20px;"> -->
                                                <?php 
                                                    // Display each variant's details
                                                    foreach ($variant_details as $variant) {
                                                ?>
                                                <li class="d-flex align-items-center mb-2" >
                                                    <span class="fw-medium mx-2">Variants:</span> 
                                                    <span class="fw-bold"><?php echo htmlspecialchars($variant['varients']); ?></span>
                                                </li>
                                                <li class="d-flex align-items-center mb-2">
                                                    <span class="fw-medium mx-2">Area:</span> 
                                                    <span class="fw-bold"><?php echo htmlspecialchars($variant['area']); ?></span>
                                                </li>
                                                <li class="d-flex align-items-center mb-2">
                                                    <span class="fw-medium mx-2">Price:</span> 
                                                    <span class="fw-bold"><?php echo htmlspecialchars($variant['price']); ?></span>
                                                </li>
                                                <?php } }?>
                                            <!-- </div> -->
                                            </ul>
                                        <!-- </div> -->
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    
                    <div class="col-xl-6 col-lg-6">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-12">
                                <div class="card h-100" >

                                    <form action="#" method="post" enctype="multipart/form-data">
                                            <input type="hidden" value="<?php echo $_REQUEST['assign_leads_sr_id']; ?>" name="assign_leads_sr_id">        
                                            <div class="card-header header-elements">
                                                <h5 class="card-action-title mb-0">Add Convert Details</h5>
                                                <!-- <div class="card-header-elements ms-sm-auto">
                                                    <div class="btn-group">
                                                        <button type="submit" name="submit1" id="submit1"  class="btn btn-primary waves-effect waves-light">Update</button>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <hr class="m-0">   

                                            <div class="card-body demo-vertical-spacing demo-only-element">
                                                <h5 class="card-action-title  mb-0">Property Details</h5>
                                                <hr class="mt-1">
                                            </div>

                                            <!-- <div class="col-12 mt-4 px-5">
                                                <h5 class="card-action-title  mb-0">Property Details</h5>
                                                <hr class="mt-1">
                                            </div> -->
                                            
                                            <div class="col-md-12">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <div class="d-flex justify-content-between  align-items-center">
                                                        <!-- <h6 class="w-max-content mb-0">1. Property Title*</h6> -->
                                                        <!-- <div class="mb-4"> -->
                                                            <!-- <div class="d-flex gap-4" style="width:72%"> -->
                                                            <div class="d-flex gap-4" style="width:100%">
                                                                    <!-- <div class="row mt-4"> -->
                                                                    <!-- <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Title</label> -->
                                                                    <!-- <div class="col-sm-12 form-floating form-floating-outline"> -->
                                                                    <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                        <select id="propertyDropdown" name="property_name_id" class="select2 form-select select2-hidden-accessiblee" data-allow-clear="true" required>
                                                                            <option value="">Select Property Name</option>
                                                                            <?php
                                                                                $sql = "SELECT * FROM property_name";
                                                                                foreach ($pdo->query($sql) as $row) { 
                                                                                    echo '<option value="'.$row['property_name_id'].'">'.$row['property_title'].'</option>';
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                        <label for="propertyDropdown">Select Property Name</label>
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
                                                        <!-- <h6 class="my-0">2. Property Tower*</h6> -->
                                                        <!-- <div class="d-flex gap-4" style="width: 72%;"> -->
                                                        <div class="d-flex gap-4" style="width: 100%;">
                                                            <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                <select id="towerDropdown" name="property_tower_id" class="select2 form-select select2-hidden-accessiblee" data-allow-clear="true" required>
                                                                    <option value="">Select Property Tower</option>
                                                                    <!-- Towers will be loaded here based on the selected property -->
                                                                </select>
                                                                <label for="towerDropdown">Select Property Tower</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <!-- <h6 class="my-0">3. Property Variants*</h6> -->
                                                            <!-- <div class="d-flex gap-4" style="width: 72%;"> -->
                                                            <div class="d-flex gap-4" style="width: 100%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <select id="variantDropdown" name="property_variants[]" class="select2 form-select select2-hidden-accessiblee" data-allow-clear="true" required>
                                                                        <option value="">Select Property Variants</option>
                                                                    </select>
                                                                    <label for="variantDropdown">Select Property Variants</label>
                                                                </div>
                                                            </div>  
                                                    </div>      
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex gap-4" style="width: 100%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <input class="form-control" type="text" placeholder="Contact Person Name" id="contact_person_name" name="contact_person_name">
                                                                    <label for="stamp_duty"> Contact Person Name</label>
                                                                </div>
                                                            </div>  
                                                    </div>      
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="card-body demo-vertical-spacing demo-only-element">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex gap-4" style="width: 100%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <input class="form-control" type="tel" placeholder="+91-98789 87980" id="html5-tel-input" name="contact_person_phone">
                                                                    <!-- <input class="form-control" type="tel" pattern="[0-9]{10}" placeholder="Contact Person Phone Number" id="contact_person_phone" name="contact_person_phone"> -->
                                                                    <label for="stamp_duty"> Contact Person Phone Number</label>
                                                                </div>
                                                            </div>  
                                                    </div>      
                                                </div>
                                            </div>
                                            
                                            <div class="card-body demo-vertical-spacing demo-only-element">
                                                <h5 class="card-action-title  mb-0">Other Details</h5>
                                                <hr class="mt-1">
                                            </div>

                                            <div class="col-12">
                                                <!-- <div class="row"> -->
                                                    <!-- <h5 class="card-header" > Other Details </h5> -->
                                                    
                                                    <div class="card-body demo-vertical-spacing demo-only-element">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <!-- <h6 class="my-0">1.  Agreement Value*</h6> -->
                                                            <!-- <div class="d-flex gap-4" style="width: 72%;"> -->
                                                            <div class="d-flex gap-4" style="width: 100%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <input class="form-control" type="number" placeholder="Agreement Value" id="stamp_duty" name="agreement_value">
                                                                    <label for="stamp_duty"> Agreement Value</label>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <!-- <h6 class="my-0">2.  Registration *</h6> -->
                                                            <!-- <div class="d-flex gap-4" style="width: 72%;"> -->
                                                            <div class="d-flex gap-4" style="width: 100%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <input class="form-control" type="number" placeholder="Registration" id="Registration" name="registrantion">
                                                                    <label for="Registration">Registratione</label>
                                                                </div>
                                                            </div>  
                                                        </div>      
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <!-- <h6 class="my-0">3.  GST *</h6> -->
                                                            <!-- <div class="d-flex gap-4" style="width: 72%;"> -->
                                                            <div class="d-flex gap-4" style="width: 100%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <input class="form-control" type="number" placeholder="GST Amount" id="gst" name="gst">
                                                                    <label for="gst">GST Amount</label>
                                                                </div>
                                                            </div>  
                                                        </div>      
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <!-- <h6 class="my-0">4.  Stamp Duty*</h6> -->
                                                            <!-- <div class="d-flex gap-4" style="width: 72%;"> -->
                                                            <div class="d-flex gap-4" style="width: 100%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <input class="form-control" type="number" placeholder="Stamp Duty" id="stamp_duty" name="stamp_duty">
                                                                    <label for="stamp_duty">Stamp Duty Amount</label>
                                                                </div>
                                                            </div>  
                                                        </div>      
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <!-- <h6 class="my-0">5.  Commission *</h6> -->
                                                            <!-- <div class="d-flex gap-4" style="width: 72%;"> -->
                                                            <div class="d-flex gap-4" style="width: 100%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <input class="form-control" type="number" placeholder="Commission To Guru Properties" id="commission" name="commission">
                                                                    <label for="commission">Commission To Guru Properties</label>
                                                                </div>
                                                            </div>  
                                                        </div>      
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <!-- <h6 class="my-0">6.  Quoted Price *</h6> -->
                                                            <!-- <div class="d-flex gap-4" style="width: 72%;"> -->
                                                            <div class="d-flex gap-4" style="width: 100%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <input class="form-control" type="number" placeholder="Quoted Price " id="quoted_price" name="quoted_price">
                                                                    <label for="commission">Commission To Guru Properties</label>
                                                                </div>
                                                            </div>  
                                                        </div>      
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <!-- <h6 class="my-0">7.  Sale Price *</h6> -->
                                                            <!-- <div class="d-flex gap-4" style="width: 72%;"> -->
                                                            <div class="d-flex gap-4" style="width: 100%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <input class="form-control" type="number" placeholder="Sale Price" id="sale_price" name="sale_price">
                                                                    <label for="sale_price">Sale Price</label>
                                                                </div>
                                                            </div>  
                                                        </div>      
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <!-- <h6 class="my-0">8. Notes*</h6> -->
                                                            <!-- <div class="d-flex gap-4" style="width: 72%;"> -->
                                                            <div class="d-flex gap-4" style="width: 100%;">
                                                                <div class="form-floating form-floating-outline" style="width: 100%;">
                                                                    <input class="form-control" type="text" placeholder="Enter your notes" id="notes" name="notes">
                                                                    <label for="notes">Enter your notes</label>
                                                                </div>
                                                            </div>  
                                                        </div>      
                                                    </div>

                                                <!-- </div> -->
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
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <span class="d-none" class="" id="latitude"></span><span class="d-none" id="longitude"></span>
                                                        <button type="submit" name="submit1" id="submit1" class="btn btn-success">Submit</button>
                                                        
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
