<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

    $from_date_submit = "";
    $to_date_submit = "";
    $sr_id_submit = "";

		$sql_query = "SELECT * from property_name WHERE status='abc'";
    // $sql_query = "SELECT * FROM property_name ";
    $pdata = $pdo->prepare($sql_query);
    $pdata->execute();
    $results = $pdata->fetchAll(PDO::FETCH_ASSOC);

		if(isSet($_POST["submit"])) 
		{
        // echo "<pre>";
        // print_r($_POST);
        // exit();

		    $varients = $_POST["varients"];
        $location = $_POST["location"];
        $builder_possession = $_POST['builder_possession'];

	    	// $sql_query = "SELECT * from property_name pn, property_tower pt, property_varient pv WHERE pv.varients = $varients and  pt.builder_possession = $builder_possession and pn.location = $location order by pn.property_title where pn.property_name_id = pt.property_name_id =pv.property_name_id is same";
        
        // Prepare the SQL query using placeholders
        $sql_query = "SELECT * 
                  FROM property_name pn
                  JOIN property_tower pt ON pn.property_name_id = pt.property_name_id
                  JOIN property_varients pv ON pn.property_name_id = pv.property_name_id
                  WHERE pv.varients = :varients 
                  AND pt.builder_possession = :builder_possession 
                  AND pn.location = :location 
                  ORDER BY pn.property_title";

          // Prepare and execute the query
          $stmt = $pdo->prepare($sql_query);
          $stmt->execute([
              ':varients' => $varients,
              ':builder_possession' => $builder_possession,
              ':location' => $location
          ]);

          // Fetch the results (if needed)
          $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // -------------------------------------------------

		}

  if(isSet($_POST["suspend"]))
  { 
    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $property_name_id = $_POST['employee_id'];
    $client_name = $_POST['client_name'];
    $added_on = date('Y-m-d H-i-s');
    // $status = "Suspended";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "UPDATE property_name set status = 'Suspended', edited_on = '$added_on' WHERE property_name_id = ?";  
    $q = $pdo->prepare($sql1);
    $q->execute(array($property_name_id));
    
    header('location:view_properties_name');
     
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

    <title>View Property Name |  Guru Properties</title>

    <meta name="description" content="" />

    <!-- *********** header******************  -->
    <?php include 'layout/header_js.php'; ?>
     <!-- *********** /header******************  -->

     <style>
        .mar-top {
            margin-top: -12px;
        }
     </style>
    
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
              <h5 class="card-header mar-bot-10">Property Management</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                  <div class="card-body">
                    <!-- <div class="d-flex align-items-center justify-content-center h-px-200"> -->
                      <form class="my-10 pb-5" action="#" method="post" enctype="multipart/form-data">
                          <div class="row justify-content-center align-items-center">
                              
                              <div class="col-md-3">
                                <!-- <div class="row"> -->
                                  <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Varient</label> -->
                                  <!-- <div class="col-sm-9 form-floating form-floating-outline"> -->
                                  <div class="form-floating form-floating-outline">
                                      <select id="formtabs-country"  name="varients" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                        <option value="" data-select2-id="18">Select Variants</option>
                                        <option value="1BHK">1 BHK</option>
                                        <option value="1.5BHK">1.5 BHK</option>
                                        <option value="2BHK">2 BHK</option>
                                        <option value="2.5BHK">2.5 BHK</option>
                                        <option value="3BHK">3 BHK</option>
                                        <option value="3.5BHK">3.5 BHK</option>
                                        <option value="4BHK">4 BHK</option>
                                        <option value="4.5BHK">4.5 BHK</option>
                                        <option value="5BHK">5 BHK</option>
                                      </select>
                                      <label for="formtabs-country">Variant</label>
                                  </div>
                                <!-- </div> -->
                              </div>

                              <div class="col-md-3">
                                <!-- <div class="row"> -->
                                  <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Location </label> -->
                                  <!-- <div class="col-sm-9 form-floating form-floating-outline"> -->
                                  <div class="form-floating form-floating-outline">
                                      <select id="roleDropdown" name="location" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                          <option value="" data-select2-id="18">Select Location</option>
                                          <?php
                                              $sql = "SELECT * FROM  property_name where status = 'Active'";
                                              foreach ($pdo->query($sql) as $row) 
                                              { 
                                              ?>
                                                  <option value="<?php echo $row['location']?>"><?php echo $row['location']?></option> 
                                              <?php } ?>
                                      </select>
                                      <label for="roleDropdown">Location</label>
                                  </div>
                                <!-- </div> -->
                              </div>

                              <div class="col-md-3">
                                <!-- <div class="row"> -->
                                  <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Builder Possession</label> -->
                                  <!-- <div class="col-sm-9 form-floating form-floating-outline"> -->
                                  <div class="form-floating form-floating-outline">
                                      <select id="roleDropdown" name="builder_possession" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                          <option value="" data-select2-id="18">Select Builder Possession</option>
                                          <?php
                                              $sql = "SELECT * FROM  property_tower where status = 'Active'";
                                              foreach ($pdo->query($sql) as $row) 
                                              { 
                                              ?>
                                                  <option value="<?php echo $row['builder_possession']?>"><?php echo $row['builder_possession']?></option> 
                                              <?php } ?>
                                      </select>
                                      <label for="roleDropdown">Builder Possession</label>
                                  </div>
                                <!-- </div> -->
                              </div>

                              <div class="col-md-1">
                                <button type="submit" name="submit" class="btn btn-info">Search</button>
                                <?php if(isSet($_POST["submit"])) { ?>
                                  <!-- <button target="_blank" class="btn btn-danger" name="pdf" onclick="javascript: form.action='pdf_export_fromto_report';"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                  <button type="" name="xlsx" class="btn btn-warning" onclick="javascript: form.action='xlsx_export_fromto_report';"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button> -->
                                <?php } ?>
                              </div>
                            
                          </div>
                      </form>
                      <hr>
                    <!-- </div> -->
                      <h5 class="card-header"> All property are listed below</h5>
                      <div class="table-responsive text-nowrap">
                          <table class="table">
                          <caption class="ms-6">List of property</caption>
                          <thead>
                              <tr>
                              <th>#</th>
                              <th>Property Name</th>
                              <th>Location</th>
                              <th>Variant</th>
                              <!-- <th>Latitude</th>
                              <th>Longitude</th> -->
                              <th>Builder Possession</th>
                              <th>Builder Name</th>
                              <!-- <th>Status</th> -->
                              <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php 
                                  $i = 1;
                                  // $sql = "SELECT * FROM property_name ";
                                  // $q = $pdo->query($sql);
                                  // foreach ($pdo->query($sql) as $row) 
                                  // { 

                                  // $sql_query = "SELECT * FROM property_name ";
                                  // $pdata = $pdo->prepare($sql_query);
                                  // $pdata->execute();
                                  // $results = $pdata->fetchAll(PDO::FETCH_ASSOC);
                                  // echo "<pre>";
                                  // print_r($sql_query);
                                  // exit();
                                  foreach($results as $row)
                                  {
                                    // echo "<pre>";
                                    // print_r($row);
                                    // exit();
                              ?>
                              <tr>
                                  <td><i class="ri-home-smile-line ri-22px text-primary me-4"></i><span class="fw-medium"><?php echo $i; ?></span></td>
                                      <!-- <td><?php echo $i; ?></td> -->
                                      <td><?php echo $row["property_title"]; ?></td>
                                      <td><?php echo $row["location"]; ?></td>
                                      <td><?php echo $row["varients"]; ?></td>
                                      <!-- <td><?php echo $row["google_location_lat"]; ?></td>
                                      <td><?php echo $row["google_location_long"]; ?></td> -->
                                      <td><?php echo $row["builder_name"]; ?></td>
                                      <td><?php echo $row["builder_possession"]; ?></td>
                                      <!-- <td><?php //echo $row["status"]; ?></td> -->
                                      <td>
                                          <!-- <div class="dropdown">
                                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                              <div class="dropdown-menu"> -->
                                                  <!-- <a class="dropdown-item waves-effect open-myModal" data-bs-toggle="modal" data-bs-target="#enableOTP" data-employee_id="<?php echo $row["property_name_id"]; ?>"><i class="ri-delete-bin-7-line me-1"></i> </a> -->
                                                  <a class="dropdown-item waves-effect open-myModal" data-bs-toggle="modal" data-bs-target="#enableOTP" data-employee_id="<?php echo $row["property_name_id"]; ?>"><i class="ri-file-pdf-2-line me-1"></i> </a>
                                              <!-- </div>
                                          </div> -->
                                      </td>
                              </tr>
                              <?php $i++; } ?> 
                          </tbody>
                          </table>
                      </div>
                  </div>
                </div>
                <!-- Enable OTP Modal -->
              <div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
                  <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                      <div class="text-center mb-6">
                        <h4 class="mb-2">Export!..</h4>
                        <p>Add Client Name</p>
                      </div>
                      <!-- <p class="mb-5">
                        Enter your mobile phone number with country code and we will send you a verification code.
                      </p> -->
                      <form id="enableOTPForm" class="row g-5"  action="export_pdf_property_details.php" method="POST">
                        <input type="hidden" name="employee_id" id="employee_id"  value=""/>

                          <div id="reasonBox" class="mb-4" style="">
                              <label for="client_name" class="form-label">Client Name</label>
                              <input type="text" name="client_name" id="formtabs-username" class="form-control" placeholder=" Client Name" required>
                          </div>
                      
                        <div class="col-12 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                          <button
                            type="reset"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                          </button>

                          <button type="submit" name ="suspend" class="btn btn-success">Export</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Enable OTP Modal -->
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
            $(document).on("click", ".open-myModal", function (e) 
            {
                e.preventDefault();
                var _self = $(this);
                var employee_id = _self.data('employee_id');
                $("#employee_id").val(employee_id);
                $(_self.attr('href')).modal('show');
            }); 
        </script>
  </body>
</html>
