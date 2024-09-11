<?php
  include_once ('dist/conf/checklogin.php'); 
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

    $i = 1;
    $assign_leads_sr_id = $_REQUEST['assign_leads_sr_id'];
    
    // $sqlemp = "SELECT * FROM assign_leads where assign_leads_id= $assign_leads_id ";
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

  if(isSet($_POST["submit1"]))
  { 
    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $next_date_followup1 = "";
    $next_time_followup1 = "";
    $next_date_visit1 = "";
    $next_time_visit1 = "";

    $connection_status = $_POST['connection_status'];
    // $notes = $_POST['notes'];
    $lead_type = $_POST['lead_type'];
    $today_visit_remark = $_POST['today_visit_remark'];
    $followup_or_another_property = $_POST['followup_or_another_property'];
    
    $added_on = date('Y-m-d H-i-s');

    $status = "Followup";
    $t_status_ce = "Not Available";
    $transfer_status = "Available";

    $next_date_time = $_POST['next_date_visit'];
    if ($next_date_time) {
        // Split the datetime into date and time
        $date_time_parts = explode('T', $next_date_time);
        
        // if (count($date_time_parts) === 2) {
            $next_date_visit1 = $date_time_parts[0];  // e.g., 2024-08-22
            $next_time_visit1 = $date_time_parts[1];  // e.g., 02:26
        } else {
            // Handle the case where the datetime is not in the expected format
            $next_date_visit1 = '';
            $next_time_visit1 = '';
            // Optionally, log an error or handle it accordingly
        // }
    }

    // $next_date_time_followup = $_POST['next_date_followup'];
    // // Split the datetime into date and time
    // $date_time_parts = explode('T', $next_date_time_followup);
    // $next_date_followup = $date_time_parts[0];  // 2024-08-22
    // $next_time_followup = $date_time_parts[1];  // 02:26

    $next_date_time_followup = $_POST['next_date_followup'];
    if ($next_date_time_followup) {
        // Split the datetime into date and time
        $date_time_parts = explode('T', $next_date_time_followup);
        
        // if (count($date_time_parts) === 2) {
            $next_date_followup1 = $date_time_parts[0];  // e.g., 2024-08-22
            $next_time_followup1 = $date_time_parts[1];  // e.g., 02:26
        } else {
            // Handle the case where the datetime is not in the expected format
            $next_date_followup1 = '';
            $next_time_followup1 = '';
            
            // Optionally, log an error or handle it accordingly
        // }
    }
    
    $assign_leads_sr_id = $_POST['assign_leads_sr_id'];

    $followup_or_another_property = $_POST['followup_or_another_property'];

    if($followup_or_another_property == 'Follow Up')
    {
        $sqlleads_sr = "select * from assign_leads_sr where assign_leads_sr_id = $assign_leads_sr_id ";
        $q = $pdo->prepare($sqlleads_sr);
        $q->execute(array());      
        $row_leads_sr = $q->fetch(PDO::FETCH_ASSOC);

        // echo "<pre>";
        // print_r($row_leads_sr);
        // exit();

        $property_name_id = $row_leads_sr['property_id'];
        $property_tower_id = $row_leads_sr['sub_property_id'];
        $property_variants = $row_leads_sr['variant'];
    }
    else{
        $property_name_id = $_POST['property_name_id'];
        $property_tower_id = $_POST['property_tower_id'];

        $property_variants_string = $_POST['property_variants']; // This is the array of selected variant IDs
        // Convert the array to a comma-separated string
        $property_variants = implode(',', $property_variants_string);
    }

    // -----------upload photo script(by select pic)-----------
    $photo_capture1 = $_POST['photo_capture1'];
	// $photo_capture2 = $_POST['photo_capture2'];

	$photo1 = NULL;
	if ($_POST['photo_capture1'] != "") {
		$target_dir = "photos/";
		$photo1 = $target_dir . "photo_" . date("Ymdhis") . ".png"; // store photo1 in db
		$exp1 = explode(',', $_POST['photo_capture1']);
		$base64_1 = array_pop($exp1);
		$data1 = base64_decode($base64_1);
		file_put_contents($photo1, $data1);
	}
    // -----------/upload photo script(by select pic)-----------

    // $sqlemp = "SELECT * FROM assign_leads where assign_leads_id= $assign_leads_id ";
    $sqlemp = "SELECT * FROM assign_leads_sr where assign_leads_sr_id = $assign_leads_sr_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_assign = $q->fetch(PDO::FETCH_ASSOC);

    $leads_id = $row_assign['leads_id'];
    $assign_leads_id = $row_assign['assign_leads_id'];
    $admin_id = $row_assign['admin_id'];
    $employee_id = $row_assign['employee_id'];
    $employee_name = $row_assign['employee_name'];

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `assign_leads_sr` SET 
            `connection_status` = ?, 
            `notes` = ?, 
            `next_date` = ?, 
            `next_time` = ?, 
            `visit_date` = ?, 
            `visit_time` = ?, 
            `lead_type` = ?, 
            `edited_on` = ?, 
            `status` = ?,
            `photo` = ?,
            `transfer_status` = ?,
            `latitude` = ?, 
            `longitude` = ?
            WHERE `assign_leads_sr_id` = ?";

    $q = $pdo->prepare($sql);
    $q->execute(array($connection_status, $today_visit_remark, $next_date_followup1, $next_time_followup1, $next_date_visit1, $next_time_visit1, $lead_type, $added_on, $status, $photo1, $t_status_ce, $assign_leads_sr_id,$latitude, $longitude));


    // ----------------------- Insert for new ffollowup ---------------------------------------------------------
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `assign_leads_sr`(`assign_leads_id`,`leads_id`, `admin_id`, `employee_id`,`employee_name`, `status`, `transfer_status`,`next_date`,`next_time`,`visit_date`,`visit_time`,`followup_or_another_property`,`variant`, `property_id`, `sub_property_id`, `added_on`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($assign_leads_id, $leads_id, $admin_id, $employee_id, $employee_name, $status, $transfer_status, $next_date_followup1, $next_time_followup1, $next_date_visit1, $next_time_visit1, $followup_or_another_property, $property_variants, $property_name_id, $property_tower_id, $added_on));
    // $lastInsertedId = $pdo->lastInsertId();
    
    header('location:view_todays_leads_SE.php');
    
  }

    //   mark dead button
  if(isSet($_POST["submit_dead"]))
  { 
    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $mark_dead = 'Yes';
    $dead_reason = $_POST['dead_reason'];

    $added_on = date('Y-m-d H-i-s');
    $status = "Dead";
    // $transfer_status = "Available";
    $assign_leads_sr_id = $_POST['assign_leads_sr_id'];

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `assign_leads_sr` SET 
            `mark_dead` = ?, 
            `dead_reason` = ?, 
            `edited_on` = ?,
            `status` = ?,
            `transfer_status` = ?
            WHERE `assign_leads_sr_id` = ?";

    $q = $pdo->prepare($sql);
    $q->execute(array($mark_dead, $dead_reason, $added_on, $status, $status, $assign_leads_sr_id));

    header('location:view_todays_leads_SE.php');
    
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

    <title> View Today's Leads Details  |  Guru Properties</title>

    <meta name="description" content="" />
    <style>
   /* When either input is focused, apply border color to both */
    .prefix-class:focus,
    .user-id-class:focus,
    .user-id-class:focus + .prefix-class,
    .prefix-class:focus + .user-id-class
    {
        border: 2px solid #666cff;   /* Highlight both inputs on focus */
    }
  </style>
  
 <style>
	  .select2
	  {
		  width: 100% !important;
	  }
	  .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
		  padding: 4px 12px;
	  }
	  .select2-container .select2-selection--single {
		  height:30px;
	  }
	  .select2-container--default .select2-selection--single {
		  border-radius: 0px;
	  }
	  .modal-box
	  {
		border: 1px solid gainsboro!important;
		display:none;
	}

	.select2-container--default .select2-selection--multiple .select2-selection__choice__remove
	{
		color: #fff !important;
		margin-right:8px !important;
	}

	.select2-container--default .select2-selection--multiple .select2-selection__choice {
		background-color: #605ca8 !important;
	}
	.cameracss{
		display: flex;
		flex-direction: row;
		gap: 50px;
		justify-content: center;
		align-items: center;
		height:400px;
	}

    /* multi select dropdown */
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        color: #fff;
    }
  </style>
 <style>
	/* CSS comes here */
	#video,#video2 {
		border: 1px solid black;
		/* width: 120px;
		height: 140px; */
		height:265px;
		width:350px;
	}

	#photo,#photo2 {
		border: 1px solid black;
		/* width: 120px;
		height: 140px; */
		height:265px;
		width:350px;
	}

	#canvas,#canvas2 {
		display: none;
	}

	.camera,.camera2 {
		/* width: 140px; */
		display: inline-block;
	}

	.output,.output2 {
		/* width: 140px; */
		display: inline-block;
	}

	.close,.close2 {
		font-size:30px;
		opacity:1 !important;
		color:#000 !important;
	}

	/* #startbutton {
		display: block;
		position: relative;
		margin-left: auto;
		margin-right: auto;
		bottom: 36px;
		padding: 5px;
		background-color: #6a67ce;
		border: 1px solid rgba(255, 255, 255, 0.7);
		font-size: 14px;
		color: rgba(255, 255, 255, 1.0);
		cursor: pointer;
	} */

	.modal-dialog {
		width:900px !important;
	}
	.modal-body {
		height:483px !important;
	}

	.modal-body-procedure {
		height:200px !important;
	}

	.contentarea {
		font-size: 16px;
		font-family: Arial;
		text-align: center;
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
                            <div class="card-body demo-vertical-spacing demo-only-element">
                                <div style="">
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
                                      ?>  </span></li>
                                    <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Budget Range:</span> <span><?php echo $row_leads['budget_range']; ?></span></li>
                                    <!-- <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Budget Range:</span> <span><?php echo $row_leads['budget_range']; ?></span></li> -->
                                </ul>
                                <small class="card-text text-uppercase text-muted small" >Contacts</small>
                                <ul class="list-unstyled my-3 py-1" style="">
                                    <li class="d-flex align-items-center mb-4"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Contact:</span> <span><?php echo $row_leads['phone_no']; ?></span></li>
                                    <li class="d-flex align-items-center mb-4"><i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Email ID:</span> <span><?php echo $row_leads['email_id']; ?></span></li>
                                
                                </ul>
                                </div>
                                <small class="card-text text-uppercase text-muted small">Other</small>
                                <ul class="list-unstyled my-3 py-1" style="">
                                    <li class="d-flex align-items-center mb-4"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Source:</span> <span><?php echo $row_leads['source']; ?></span></li>
                                    <li class="d-flex align-items-center mb-4"><i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Date:</span> <span><?php echo date("d-M-Y" , strtotime($row_leads['added_on'])); ?></span></li>
                                </ul>

                                <small class="card-text text-uppercase text-muted small">Assigned Details</small>
                                <ul class="list-unstyled my-3 py-1" style="">
                                    <li class="d-flex align-items-center mb-4"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Employee Name:</span> <span><?php echo $row_assign['employee_name']; ?></span></li>
                                    <!-- <li class="d-flex align-items-center mb-4"><i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Employee Type:</span> <span><?php echo $row_assign['employee_type']; ?></span></li> -->
                                    <li class="d-flex align-items-center mb-4"><i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Visit Date Time:</span> <span>
                                        <?php
                                            if($row_assign['visit_date'] == "0000-00-00") {
                                                echo date("d-M-Y" , strtotime($row_assign['next_date'])); 
                                            } else {
                                                echo date("d-M-Y" , strtotime($row_assign['visit_date'])); 
                                            }
                                        ?>
                                        </span> &nbsp;&nbsp; <span>
                                        <?php 
                                            if($row_assign['visit_time'] == "00:00:00") {
                                                echo date("H:i A" , strtotime($row_assign['next_time'])); 
                                            } else {
                                                echo date("H:i A" , strtotime($row_assign['visit_time'])); 
                                            }
                                        ?>
                                        </span></li>
                                </ul>

                                <div class="col-md-12" style="text-align: right;">
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#addNewCCModald"> Mark Dead </button>
                                    <a class="btn btn-success" href="convert_lead_by_SE.php?assign_leads_sr_id=<?php echo $row_assign["assign_leads_sr_id"]; ?>">Convert </a>
                                    <a class="btn btn-success" href="trasnfer_lead_by_SE.php?assign_leads_sr_id=<?php echo $row_assign["assign_leads_sr_id"]; ?>">Transfer </a>
                                </div>
                            </div>
                        </div>
                        <!--/ About User -->
                    </div>
                    <!--  -->
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card mb-6" >
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0"><i class="ri-survey-line ri-24px text-body me-2"></i>Add Visit Details</h5>
                                <!-- <a class="btn btn-secondary" href="transfer_assigned_lead.php?assign_leads_id=<?php echo $row_assign["assign_leads_id"]; ?>">Transfer Lead </a> -->
                            </div>

                            <form action="#" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $_REQUEST['assign_leads_sr_id']; ?>" name="assign_leads_sr_id">
                                <div class="card-body demo-vertical-spacing demo-only-element" style="padding-top: 0px;">
                                    <!--  -->
                                    <div style="display: flex; justify-content: space-between;">
                                    <div style="">
                                    <small class="card-text text-uppercase text-muted small">Project Details</small>
                                        <ul class="list-unstyled my-3 py-1" style="">
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
                                            <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">Property Name:</span> <span><?php echo $row_property['property_title']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Location:</span> <span><?php echo $row_property['location']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Google Location:</span>Latitude: <span><?php echo $row_property['google_location_lat']; ?> & Longitude: <?php echo $row_property['google_location_long']; ?> </span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">Builder Name:</span> <span><?php echo $row_property['builder_name']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">Tower Name:</span> <span><?php echo $row_tower['property_tower_name']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">Builder Possession:</span> <span><?php echo $row_tower['builder_possession']; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="ri-home-smile-line ri-24px"></i><span class="fw-medium mx-2">RERA Possession:</span> <span><?php echo $row_tower['rera_possession']; ?></span></li>
                                        </div>
                                        <div style="">
                                            <small class="card-text text-uppercase text-muted small">Varient Details</small>
                                            <?php 
                                                // $sqlsr = "SELECT * FROM assign_leads_sr where assign_leads_sr_id= $assign_leads_sr_id ";
                                                // foreach ($pdo->query($sqlsr) as $row_sr) 
                                                // {
                                                //     $varient_group = $row_sr['variant'];
                                            ?>
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
                                    <div style="display: flex;gap:200px;">
                                        <div class="mb-4" style="display: flex; gap:30px;">
                                            <label class="form-label" for="notes">Visited?</label>
                                            <div class="d-flex gap-4">
                                                <div class="form-check form-check-success">
                                                    <input name="connection_status" class="form-check-input" type="radio" value="connected" id="customRadioSuccess" checked>
                                                    <label class="form-check-label" for="customRadioSuccess">Yes</label>
                                                </div>
                                                <div class="form-check form-check-danger">
                                                    <input name="connection_status" class="form-check-input" type="radio" value="not_connected" id="customRadioDanger">
                                                    <label class="form-check-label" for="customRadioDanger">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4" style="display: flex;gap:20px;">
                                            <label class="form-label">Lead Type:</label>
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
                                    </div>

                                    <label for="notes" class="form-label w-100 text-left">Remark For Today's Visit</label>
                                    <div class="mb-4 form-floating form-floating-outline">
                                        <input class="form-control" type="text" placeholder="Enter your remark here.." id="today_visit_remark" name="today_visit_remark">
                                        <label for="today_visit_remark">Remark For Today's Visit</label>
                                    </div>

                                    <!-- photo Options -->
                                        <!-- <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" id="take_photo_div" style="">
                                                    <div class="row">
                                                        <div class="col-sm-11" style="display:flex;gap:20px;">
                                                            <label for="patientDate" class="col-sm-2 control-label" style="margin-top: 10px;">Today's Visit Photo</label>
                                                            <div class="col-sm-3" style="padding-right: 0px;">
                                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewCCModal" onclick="startup();"> Take Photo </button>
                                                            </div>
                                                            <div class="col-sm-4"style="padding: 0px;" >
                                                                <input type="hiddden" class="form-control" name="photo_capture1" id="photo_capture1" readonly />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>	
                                            </div>
                                        </div> -->
                                        <!-- /photo options -->

                                        <!-- Photo Options -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="take_photo_div" style="">
                                                        <div class="row justify-content-center">
                                                            <div class="col-sm-12 text-center">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input class="form-control" type="hidden" id="lat" readonly name="latitude">
                                                                    <span>Current Latitude:- </span>
                                                                    <span class="text-danger" id="latitude"></span> 
                                                                    
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <!-- <label for="latitude">Latitude</label> -->
                                                                <!-- </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-floating form-floating-outline"> -->
                                                                    <input class="form-control" type="hidden" id="long" readonly name="longitude">
                                                                    <span>Current Longitude:- </span>
                                                                    <span class="text-danger" id="longitude"></span>
                                                                    <!-- <label for="longitude">Longitude</label> -->
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                                    <span>Accuracy:- </span>
                                                                    <span class="text-danger" id="accuracy"></span>
                                                                    

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-11 mt-6" style="display:flex;gap:20px;">
                                                                <label for="patientDate" class="col-sm-2 control-label" style="margin-top: 10px;">Today's Visit Photo</label>
                                                                <div class="col-sm-3" style="padding-right: 0px;">
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewCCModal" onclick="startup();"> Take Photo </button>
                                                                </div>
                                                                <!-- Image display section -->
                                                                <div class="col-sm-4" style="padding: 0px;">
                                                                    <!-- <img id="captured_photo_preview" src="" alt="Captured Photo" style="max-width: 150px; display: none;" /> -->
                                                                    <img id="captured_photo_preview" src="" alt="Captured Photo" style="max-width: 150px; display: none;" />
                                                                    <input type="hidden" class="form-control" name="photo_capture1" id="photo_capture1" readonly />
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>  
                                                </div>
                                            </div>
                                        <!-- /photo options -->

                                        <hr>

                                    <!-- <div class="col-12"> -->

                                        <!-- <div class="mb-4" sstyle="">
                                            <div class="form-check form-check-danger">
                                                <input class="form-check-input" type="checkbox" value="yes" id="customCheckDanger1" name="is_next_date" onchange="toggleReasonBox1()">
                                                <label class="form-check-label" for="customCheckDanger1">Is next date?</label>
                                            </div>
                                        </div> -->

                                        <label for="next_date" class="form-label">Select One Option</label>
                                    <div class="mb-4 form-floating form-floating-outline" id="selectBox1">
                                        <select id="roleDropdown" name="followup_or_another_property" class="select2 form-select select2-hidden-accessiblee" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                            <option value="" data-select2-id="18">Select One</option>
                                            <option value="Follow Up">Follow Up</option>
                                            <option value="Another Property">Another Property</option>
                                        </select>
                                        <label for="roleDropdown">Select One Option</label>
                                    </div>
                                    
                                    <!-- <label for="next_date" class="form-label">Next Follow Up Date Time</label> -->
                                    <div class="mb-4  form-floating form-floating-outline" id="reasonBoxfollowup" style="display:none;">
                                        <input class="form-control" type="datetime-local" id="next_date_followup" name="next_date_followup" required>
                                        <label for="next_date_followup">Next Follow Up Date Time</label>
                                    </div>

                                    <!-- <div class="mb-4" id="reasonBoxvisit" style="display:none;">
                                        <label for="next_date" class="form-label">Visit Date Time</label>
                                        <input class="form-control" type="datetime-local" id="next_date_visit" name="next_date_visit" required>
                                    </div> -->

                                    <!-- new form -->
                                    <div class="row g-4" id="property_details_box" style="display:none;">
                                        <div class="row">
                                          <h5 class="card-header mt-4" style="padding-left: 0px;"> Property Details </h5>
                                          <div class="col-md-6">
                                              
                                              <div class="row">
                                                  <label class="col-sm-3 col-form-label text-sm-end mar-top">Property </label>
                                                  <div class="col-sm-9  form-floating form-floating-outline">
                                                      <select id="propertyDropdown" name="property_name_id" class="select2 form-select select2-hidden-accessiblee" data-allow-clear="true">
                                                          <option value="">Select Property Name</option>
                                                          <?php
                                                              $sql = "SELECT * FROM property_name where status = 'Active'";
                                                              foreach ($pdo->query($sql) as $row) { 
                                                                  echo '<option value="'.$row['property_name_id'].'">'.$row['property_title'].'</option>';
                                                              }
                                                          ?>
                                                      </select>
                                                      <label for="propertyDropdown">Property</label>
                                                  </div>
                                              </div>
                                          </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Tower</label>
                                                    <div class="col-sm-9 form-floating form-floating-outline">
                                                        <select id="towerDropdown" name="property_tower_id" class="select2 form-select select2-hidden-accessiblee" data-allow-clear="true" required>
                                                            <option value="">Select Property Tower</option>
                                                            <!-- Towers will be loaded here based on the selected property -->
                                                        </select>
                                                        <label for="towerDropdown">Property Tower</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end mar-top"> Variants</label>
                                                    <div class="col-sm-9 form-floating form-floating-outline">
                                                        <!-- <select id="variantDropdown" name="property_variants[]" class="js-example-basic-single select2 form-select select2-hidden-accessiblee select2-hidden-accessible" multiple="multiple" data-allow-clear="true"> -->
                                                        <select id="variantDropdown" name="property_variants[]" class="select2 form-select select2-hidden-accessiblee" data-allow-clear="true">
                                                            <option value="">Select Variants</option>
                                                        </select>
                                                        <label for="variantDropdown">Variants</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                              <div class="row">
                                              <label for="next_date" class="col-sm-3 col-form-label text-sm-end mar-top ">Visit Date Time</label>
                                                <div class="col-sm-9 form-floating form-floating-outline" id="reasonBoxvisit">
                                                    <input class="form-control" type="datetime-local" id="next_date_visit" name="next_date_visit">
                                                    <label for="next_date_visit">Variants</label>
                                                </div>
                                              </div>
                                            </div>

                                         </div>

                                    </div>
                                    <!-- /new form -->


                                    <div class="d-flex justify-content-between">
                                        <!-- <a class="btn btn-outline-info" href="view_leads_for_assigned_SE.php?assign_leads_id=<?php echo $row_assign["assign_leads_id"]; ?>">Assign Lead To Sales Executive </a> -->
                                        <button type="submit" name="submit1" id="submit1" class="btn btn-success logo-btn">Submit</button>
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
                                    <th>Latitude </th>
                                    <th>Longitude </th>
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

                    <!-- photo model for employee -->
                <!-- PhotoCapture model 1-->

                <!-- Add New Credit Card Modal -->
              <div class="modal fade" id="addNewCCModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                    <div class="modal-content">
                            <div class="modal-header">
                                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                                <button type="button" class="close" data-dismiss="modal" onclick="vidOff();" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">

                                    <div class="row cameracss">
                                        <div class="col-6">
                                            <div class="contentarea">
                                                <div class="camera">
                                                    <video id="video">Video stream not available.</video>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <canvas id="canvas"></canvas>
                                            <div class="output">
                                                <img id="photo" alt="The screen capture will appear in this box.">
                                            </div>	
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary submit-buttons" id="startbutton">Take photo</button>
                                    <button type="button" class="btn btn-success submit-buttons" data-bs-dismiss="modal" aria-label="Close" onclick="vidOff();">Save</button>
                                </div>
                            </div>
                        </div>
                </div>
              </div>
              <!--/ Add New Credit Card Modal -->

                <!--/ PhotoCapture model1 -->

            <!-- photo model for employee -->
                </div>
               <!-- *************** - /main containt in page write here - **********************  -->

               <script src="assets//js/pages-pricing.js"></script>

              <!-- Add New Credit Card Modal -->
              <div class="modal fade" id="addNewCCModald" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                  <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                      <div class="text-center mb-6">
                        <h4 class="mb-2">Mark As Dead</h4>
                        <p>Do you want to mark a lead as dead? </p>
                      </div>
                      <form id="addNewCCForm" class="row g-5"  method="POST" action="#">
                        <input type="hidden" value="<?php echo $_REQUEST['assign_leads_sr_id']; ?>" name="assign_leads_sr_id">
                        <div class="col-12">
                            <!-- <div class="mb-4">
                                <div class="form-check form-check-danger">
                                    <input class="form-check-input" type="checkbox" value="yes" id="customCheckDanger12" name="mark_dead" onchange="toggleReasonBox12()">
                                    <label class="form-check-label" for="customCheckDanger12">Mark Dead</label>
                                </div>
                            </div> -->

                            <div id="reasonBox12" class="mb-4" style="">
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

      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      <script>
            // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
      </script>
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
    function toggleReasonBox12() {
        const checkbox12 = document.getElementById('customCheckDanger12');
        const reasonBox12 = document.getElementById('reasonBox12');
        // const reasonBox = document.getElementById('reasonBox');

        if (checkbox12.checked) {
            reasonBox12.style.display = 'block';
        } else {
            reasonBox12.style.display = 'none';
        }
    }
    // Initially hide the reason box if the checkbox is not checked
    toggleReasonBox12();
</script>

<script>
    function toggleReasonBox() {
        const checkbox = document.getElementById('customCheckDanger');
        const reasonBox = document.getElementById('reasonBox');
        // const reasonBox = document.getElementById('reasonBox');

        if (checkbox.checked) {
            reasonBox.style.display = 'block';
        } else {
            reasonBox.style.display = 'none';
        }
    }
    // Initially hide the reason box if the checkbox is not checked
    toggleReasonBox();
</script>

<script>
    function toggleReasonBox1() {
        const checkbox1 = document.getElementById('customCheckDanger1');
        // const reasonBox1 = document.getElementById('reasonBox1');
        // const reasonBox1 = document.getElementById('reasonBox1');
        const selectBox1 = document.getElementById('selectBox1');

        if (checkbox1.checked) {
            // reasonBox1.style.display = 'block';
            selectBox1.style.display = 'block';
        } else {
            // reasonBox1.style.display = 'none';
            selectBox1.style.display = 'none';
        }
    }
    // Initially hide the reason box if the checkbox is not checked
    toggleReasonBox1();
</script>

<script>
    document.getElementById('roleDropdown').addEventListener('change', function() {
        var selectedValue = this.value;
        
        // Hide both sections initially
        // document.getElementById('reasonBoxvisit').style.display = 'none';
        document.getElementById('reasonBoxfollowup').style.display = 'none';
        document.getElementById('property_details_box').style.display = 'none';
        // property_details_box
        
        // Show the appropriate section based on the selected value
        if (selectedValue === 'Follow Up') {
            document.getElementById('reasonBoxfollowup').style.display = 'block';
            document.getElementById('property_details_box').style.display = 'none';

        } else if (selectedValue === 'Another Property') {
            // document.getElementById('reasonBoxvisit').style.display = 'block';
            document.getElementById('property_details_box').style.display = 'block';
        }
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

<!-- Photo scripts -->

<script>
    $(".photo_by") // select the radio by its id
    .change(function(){ // bind a function to the change event
        if( $(this).is(":checked") ){ // check if the radio is checked
            var val = $(this).val(); // retrieve the value
            // alert(val);
        }
        if(val=='Yes') {
            document.getElementById("take_photo_div").style.display = 'block';
            document.getElementById("upload_photo_div").style.display = 'none';
        }  if(val=='No'){
            document.getElementById("take_photo_div").style.display = 'none';
			document.getElementById("upload_photo_div").style.display = 'block';
        }
    });
</script>

<script>
	/* JS comes here for photo 1*/
		var width = 350; // We will scale the photo width to this
		var height = 350; // This will be computed based on the input stream
		var streaming = false;
		var video = null;
		var canvas = null;
		var photo = null;
		var startbutton = null;

		function startup() {
			video = document.getElementById('video');
			canvas = document.getElementById('canvas');
			photo = document.getElementById('photo');
			photo_capture1 = document.getElementById('photo_capture1');
			startbutton = document.getElementById('startbutton');

			navigator.mediaDevices.getUserMedia({
					video: true,
					audio: false
				})
				.then(function(stream) {
					video.srcObject = stream;
					localstream = stream;
					video.play();
				})
				.catch(function(err) {
					console.log("An error occurred: " + err);
				});

			video.addEventListener('canplay', function(ev) {
				if (!streaming) {
					height = video.videoHeight / (video.videoWidth / width);

					if (isNaN(height)) {
						height = width / (4 / 3);
					}

					video.setAttribute('width', width);
					video.setAttribute('height', height);
					canvas.setAttribute('width', width);
					canvas.setAttribute('height', height);
					streaming = true;
				}
			}, false);

			startbutton.addEventListener('click', function(ev) {
				takepicture();
				ev.preventDefault();
			}, false);

			clearphoto();
		}

		function vidOff() {
			localstream.getTracks()[0].stop();
            const photoData = document.getElementById('photo_capture1').value;
            updateCapturedPhoto(photoData);
		}


		function clearphoto() {
			var context = canvas.getContext('2d');
			context.fillStyle = "#AAA";
			context.fillRect(0, 0, canvas.width, canvas.height);

			var data = canvas.toDataURL('image/png');
			photo.setAttribute('src', data);
			photo_capture1.value = "";
		}

		function takepicture() {
			var context = canvas.getContext('2d');
			if (width && height) {
				canvas.width = width;
				canvas.height = height;
				context.drawImage(video, 0, 0, width, height);

				var data = canvas.toDataURL('image/png');
				photo.setAttribute('src', data);
				photo_capture1.value = data;
				
                
				//alert(data);
			} else {
				clearphoto();
			}
		}
</script>
<script>
	/* JS comes here  for photo 2*/
	var width = 350; // We will scale the photo width to this
	var height= 350; // This will be computed based on the input stream
	var streaming = false;
	var video = null;
	var canvas = null;
	var photo2 = null;
	var startbutton2 = null;

	function startup2() {
		video = document.getElementById('video2');
		canvas = document.getElementById('canvas2');
		photo2 = document.getElementById('photo2');
		photo_capture2 = document.getElementById('photo_capture2');
		startbutton2 = document.getElementById('startbutton2');

		navigator.mediaDevices.getUserMedia({
				video: true,
				audio: false
			})
			.then(function(stream) {
				video.srcObject = stream;
				localstream2 = stream;
				video.play();
			})
			.catch(function(err) {
				console.log("An error occurred: " + err);
			});

		video.addEventListener('canplay', function(ev) {
			if (!streaming) {
				height = video.videoHeight / (video.videoWidth / width);

				if (isNaN(height)) {
					height = width / (4 / 3);
				}

				video.setAttribute('width', width);
				video.setAttribute('height', height);
				canvas.setAttribute('width', width);
				canvas.setAttribute('height', height);
				streaming = true;
			}
		}, false);

		startbutton2.addEventListener('click', function(ev) {
			takepicture2();
			ev.preventDefault();
		}, false);

		clearphoto2();
	}

	function vidOff2() {
		localstream2.getTracks()[0].stop();
	}

	function clearphoto2() {
		var context = canvas.getContext('2d');
		context.fillStyle = "#AAA";
		context.fillRect(0, 0, canvas.width, canvas.height);

		var data = canvas.toDataURL('image/png');
		photo2.setAttribute('src', data);
		photo_capture2.value = "";
	}

	function takepicture2() {
		var context = canvas.getContext('2d');
		if (width && height) {
			canvas.width = width;
			canvas.height = height;
			context.drawImage(video, 0, 0, width, height);

			var data = canvas.toDataURL('image/png');
			photo2.setAttribute('src', data);
			photo_capture2.value = data;
			//alert(data);
		} else {
			clearphoto2();
		}
	}
    
    $("#roleDropdown").on('change', function() {
        
        const roleDropdown = this.value;

        if (roleDropdown == 'Follow Up') {
            $("#next_date_followup").prop('required', true);
            $("#propertyDropdown").prop('required', false);
            $("#towerDropdown").prop('required', false);
            $("#variantDropdown").prop('required', false);
            $("#next_date_visit").prop('required', false); 
        
        } else if(roleDropdown == "Another Property") {
            $("#propertyDropdown").prop('required', true);
            $("#towerDropdown").prop('required', true);
            $("#variantDropdown").prop('required', true);
            $("#next_date_visit").prop('required', true);    
            $("#next_date_followup").prop('required', false);
        } else {
            $("#propertyDropdown").prop('required', true);
            $("#towerDropdown").prop('required', true);
            $("#variantDropdown").prop('required', true);
            $("#next_date_visit").prop('required', true);    
            $("#next_date_followup").prop('required', true);
        }
    });
</script>

<!--  -->

<script>
    function updateCapturedPhoto(data) {
        // Get the hidden input field's value (base64 image data)
        //const photoData = document.getElementById('photo_capture1').value;
        //alert('fhjadsf');

        // If there is any data in the hidden field
        if (data) {

       
            // Find the image tag and update the src with the base64 data
            const imgTag = document.getElementById('captured_photo_preview');
            imgTag.src = data;  // Assuming the base64 data is a JPEG image
            imgTag.style.display = 'block';  // Make the image visible
        }
    }
    
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
            window.setInterval(function(){
                navigator.geolocation.getCurrentPosition( success, fail );
            }, 1000);
        }

        function success(position)
        {   
                document.getElementById('long').value = position.coords.longitude;
                document.getElementById('longitude').innerHTML = position.coords.longitude;
                document.getElementById('lat').value = position.coords.latitude;
                document.getElementById('latitude').innerHTML = position.coords.latitude;
                document.getElementById('accuracy').innerHTML = position.coords.accuracy;
                document.getElementById('submit1').disabled  = false;
        }

        function fail()
        {
            // alert("Please enable your location and refresh the page, to submit this form.");
            // alert("Sorry, your browser does not support geolocation services.");
            document.getElementById('long').value = "00.0000000";
            document.getElementById('lat').value = "00.0000000";
            document.getElementById('submit1').disabled  = true;
        }
        

</script>    

    
  </body>
</html>
