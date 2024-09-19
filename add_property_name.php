<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();


if (isset($_POST["submit"])) { 

    // echo "<pre>";
    // print_r($_POST);
    // exit();

    // Collect other form data
    $property_title = $_POST['property_title'];
    $builder_name = $_POST['builder_name'];
    $property_location_id = $_POST['property_location_id'];
    $google_location_lat = $_POST['google_location_lat'];
    $google_location_long = $_POST['google_location_long'];
    
    $car_parking = $_POST['car_parking'];
    $furnishing = $_POST['furnishing'];
    $amenities = $_POST['amenities'];
    $USP = $_POST['USP'];

    // `car_parking` , `furnishing` ,  `amenities` , `USP`
    // $car_parking , $furnishing ,  $amenities , $USP

    // Get location name based on location_id
    $sql = "SELECT * FROM location WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($property_location_id));
    $row_loc = $q->fetch(PDO::FETCH_ASSOC);
    $location_name = $row_loc['name'];

    $added_on = date('Y-m-d H:i:s');

    // Initialize variables to store file paths
    $pdf1 = $pdf2 = $pdf3 = $pdf4 = $pdf5 = $pdf6 = null;
    $video1 = $video2 = $video3 = $video4 = null;

    // Process PDF uploads
    for ($i = 1; $i <= 6; $i++) {
        if (isset($_FILES["property_pdf_$i"]) && $_FILES["property_pdf_$i"]['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["property_pdf_$i"]["tmp_name"];
            $name = basename($_FILES["property_pdf_$i"]["name"]);
            $upload_dir = "uploads/pdfs/"; // Ensure this directory exists and is writable
            $pdf_path = $upload_dir . $name;

            if (move_uploaded_file($tmp_name, $pdf_path)) {
                ${"pdf$i"} = $pdf_path; // Dynamically set the variable pdf1, pdf2, ..., pdf6
            } else {
                echo "Failed to upload Property PDF $i";
            }
        }
    }

    // Process video uploads
    for ($i = 1; $i <= 4; $i++) {
        if (isset($_FILES["property_video_$i"]) && $_FILES["property_video_$i"]['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["property_video_$i"]["tmp_name"];
            $name = basename($_FILES["property_video_$i"]["name"]);
            $upload_dir = "uploads/videos/"; // Ensure this directory exists and is writable
            $video_path = $upload_dir . $name;

            if (move_uploaded_file($tmp_name, $video_path)) {
                ${"video$i"} = $video_path; // Dynamically set the variable video1, video2, ..., video4
            } else {
                echo "Failed to upload Property Video $i";
            }
        }
    }

    // Insert into the database
    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO `property_name`(`property_title`, `location`, `builder_name`,`status`, `added_on`, `location_id`, `google_location_lat`, `google_location_long`, `pdf1`, `pdf2`, `pdf3`, `pdf4`, `pdf5`, `pdf6`, `video1`, `video2`, `video3`, `video4`,`car_parking` , `furnishing` ,  `amenities` , `USP`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute([
            $property_title, $location_name, $builder_name, 'Active', $added_on, $property_location_id, 
            $google_location_lat, $google_location_long, $pdf1, $pdf2, $pdf3, $pdf4, $pdf5, $pdf6,
            $video1, $video2, $video3, $video4, $car_parking , $furnishing ,  $amenities , $USP
        ]);

        header('location:view_properties_name');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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

    <title> Add Property Name  |  Guru Properties</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
  rel="stylesheet" />

<!-- Icons -->
<link rel="stylesheet" href="assets/vendor/fonts/remixicon/remixicon.css" />
<link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />

<!-- Menu waves for no-customizer fix -->
<link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />

<!-- Core CSS -->
<link rel="stylesheet" href="assets/vendor/css/rtl/core.css" />
<link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" />
<link rel="stylesheet" href="assets/css/demo.css" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="assets/vendor/libs/bs-stepper/bs-stepper.css" />
<link rel="stylesheet" href="assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
<link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />

<!-- Page CSS -->

<!-- Helpers -->
<script src="assets/vendor/js/helpers.js"></script>
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="assets/js/config.js"></script>
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
    <style>
      .bs-stepper .step.active .bs-stepper-icon svg,
      .bs-stepper .step.crossed .step-trigger .bs-stepper-icon svg {
        fill: red !important;
      }
      .bs-stepper.wizard-icons .step.crossed .bs-stepper-label, .bs-stepper.wizard-icons .step.active .bs-stepper-label,
      .bs-stepper .step.crossed + .line i {
        color: red !important;
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
              <div class="row">
                <div class="col-12 mb-6">
                <h5 class="card-header mar-bot-10">Property Name Details Form</h5>
                  <div class="bs-stepper wizard-icons wizard-icons-example mt-2">
                    <div class="bs-stepper-header">
                      <div class="step" data-target="#account-details">
                        <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                            <svg viewBox="0 0 54 54">
                              <use xlink:href="assets/svg/icons/form-wizard-account.svg#wizardAccount"></use>
                            </svg>
                          </span>
                          <span class="bs-stepper-label">Property Information</span>
                        </button>
                      </div>
                      <div class="line">
                        <i class="ri-arrow-right-s-line"></i>
                      </div>
                      <div class="step" data-target="#personal-info">
                        <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                            <svg viewBox="0 0 58 54">
                              <use xlink:href="assets/svg/icons/form-wizard-personal.svg#wizardPersonal"></use>
                            </svg>
                          </span>
                          <span class="bs-stepper-label">Other Details</span>
                        </button>
                      </div>
                      <div class="line">
                        <i class="ri-arrow-right-s-line"></i>
                      </div>
                      <div class="step" data-target="#address">
                        <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                            <svg viewBox="0 0 54 54">
                              <use xlink:href="assets/svg/icons/form-wizard-address.svg#wizardAddress"></use>
                            </svg>
                          </span>
                          <span class="bs-stepper-label">Property PDF Files</span>
                        </button>
                      </div>
                      <div class="line">
                        <i class="ri-arrow-right-s-line"></i>
                      </div>
                      <div class="step" data-target="#social-links">
                        <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                            <svg viewBox="0 0 54 54">
                              <use
                                xlink:href="assets/svg/icons/form-wizard-social-link.svg#wizardSocialLink"></use>
                            </svg>
                          </span>
                          <span class="bs-stepper-label">Property Videos</span>
                        </button>
                      </div>
                      <div class="line">
                        <i class="ri-arrow-right-s-line"></i>
                      </div>
                      <div class="step" data-target="#review-submit">
                        <button type="button" class="step-trigger">
                          <span class="bs-stepper-icon">
                            <svg viewBox="0 0 54 54">
                              <use xlink:href="assets/svg/icons/form-wizard-submit.svg#wizardSubmit"></use>
                            </svg>
                          </span>
                          <span class="bs-stepper-label">Review & Submit</span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      <form  action="#" method="post" enctype="multipart/form-data">
                        <!-- Account Details -->
                        <div id="account-details" class="content">
                          <div class="content-header mb-4">
                            <h6 class="mb-6">Property Information</h6>
                            <!-- <small>Enter Your Property Information.</small> -->
                          </div>
                          <div class="row g-5">
                          <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Property Title</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                    <input type="text" name="property_title" id="formtabs-username" class="form-control" placeholder="Property Title" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required>
                                    <label for="formtabs-username"> Property Title* </label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Builder Name</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <input type="text" name="builder_name" id="formtabs-username" class="form-control" placeholder=" Builder Name" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required>
                                  <label for="formtabs-username"> Builder Name* </label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Property Location</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                    <!-- <input type="text" name="location" id="formtabs-username" class="form-control" placeholder="Location" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required> -->
                                    <select id="formtabs-location" name="property_location_id" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                        <option value="" data-select2-id="18">Select Property Location</option>
                                        <?php
                                            $sqlLocation = "SELECT * FROM location ORDER BY name";
                                            foreach ($pdo->query($sqlLocation) as $row) {
                                                $selected = ($row['id'] == $row_d['location_id']) ? 'selected' : '';
                                                ?>
                                                <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['name']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <label class="" for="formtabs-username"> Property Location* </label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <!-- <label class="col-sm-3 col-form-label text-sm-end" for="google-location-lat">Google Location</label> -->
                                    <div class="col-sm-6 form-floating form-floating-outline">
                                        <!-- Latitude Input Field -->
                                        <input type="text" name="google_location_lat" id="google-location-lat" class="form-control" placeholder="Latitude" 
                                            pattern="^(\+|-)?(?:90(?:\.0+)?|\d{1,2}(?:\.\d+)?)$" 
                                            title="Please enter a valid latitude (-90 to 90)" 
                                            required>
                                            <label for="google-location-lat"> Latitude* </label>
                                    </div>
                                    <div class="col-sm-6 form-floating form-floating-outline">
                                        <!-- Longitude Input Field -->
                                        <input type="text" name="google_location_long" id="google-location-long" class="form-control" placeholder="Longitude" 
                                            pattern="^(\+|-)?(?:180(?:\.0+)?|(?:1[0-7]\d|\d{1,2})(?:\.\d+)?)$" 
                                            title="Please enter a valid longitude (-180 to 180)" 
                                            required>
                                        <label for="google-location-long"> Longitude* </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                              <button class="btn btn-outline-secondary btn-prev" disabled>
                                <i class="ri-arrow-left-line me-sm-1"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                              <button class="btn btn-success btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ri-arrow-right-line"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- Personal Info -->
                        <div id="personal-info" class="content">
                          <div class="content-header mb-4">
                            <h6 class="mb-6">Other Details</h6>
                            <!-- <small>Enter Other Details.</small> -->
                          </div>
                          <div class="row g-5">
                          <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Car Parking</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <select id="defaultSelect" class="form-select" name="car_parking">
                                    <option>Select Parking Type</option>
                                    <option value="Open">Open</option>
                                    <option value="Covered">Covered</option>
                                    <option value="Semi-covered">Semi-covered</option>
                                  </select>
                                  <label for="formtabs-username"> Car Parking</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Furnishing </label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <select id="defaultSelect" class="form-select" name="furnishing">
                                    <option>Select Furnishing Type</option>
                                    <option value="Furnished">Furnished</option>
                                    <option value="Semi-Furnished">Semi-Furnished</option>
                                    <option value="Non-Furnished">Non-Furnished</option>
                                  </select>
                                  <label for="formtabs-username"> Furnishing </label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Amenities  </label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <textarea class="form-control h-px-100" name="amenities" id="exampleFormControlTextarea1" placeholder="Write amenities here..."></textarea>
                                  <label for="formtabs-username"> Amenities  </label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> USP  </label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <textarea class="form-control h-px-100" name="USP" id="exampleFormControlTextarea1" placeholder="Write USP here..."></textarea>
                                  <label for="formtabs-username"> USP  </label>
                                </div>
                              </div>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                              <button class="btn btn-outline-secondary btn-prev">
                                <i class="ri-arrow-left-line me-sm-1"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                              <button class="btn btn-success btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ri-arrow-right-line"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- Address -->
                        <div id="address" class="content">
                          <div class="content-header mb-4">
                            <h6 class="mb-6">Property PDF Files</h6>
                            <!-- <small>Enter Property PDF Files.</small> -->
                          </div>
                          <div class="row g-5">
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                      <div class="col-md-6">
                                          <div class="row">
                                              <!-- <label class="col-sm-3 col-form-label text-sm-end" for="property-pdf-<?php echo $i; ?>"> PDF <?php echo $i; ?></label> -->
                                              <div class="col-sm-12">
                                                  <!-- <label for="property-pdf-<?php echo $i; ?>" class="form-label">Property PDF <?php echo $i; ?></label> -->
                                                  <input type="file" name="property_pdf_<?php echo $i; ?>" id="property-pdf-<?php echo $i; ?>" class="form-control" accept="application/pdf" >
                                              </div>
                                          </div>
                                      </div>
                                  <?php endfor; ?>
                            <div class="col-12 d-flex justify-content-between">
                              <button class="btn btn-outline-secondary btn-prev">
                                <i class="ri-arrow-left-line me-sm-1"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                              <button class="btn btn-success btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ri-arrow-right-line"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- Social Links -->
                        <div id="social-links" class="content">
                          <div class="content-header mb-4">
                            <h6 class="mb-6">Property Videos</h6>
                            <!-- <small>Enter Property Videos.</small> -->
                          </div>
                          <div class="row g-5">
                            <!-- Video 1 to 4 Fields -->
                                  <?php for ($i = 1; $i <= 4; $i++): ?>
                                      <div class="col-md-6">
                                          <div class="row">
                                              <!-- <label class="col-sm-3 col-form-label text-sm-end" for="property-video-<?php echo $i; ?>"> Video <?php echo $i; ?></label> -->
                                              <div class="col-sm-12">
                                              <!-- <label for="property-video-<?php echo $i; ?>" class="form-label">Property Video <?php echo $i; ?></label> -->
                                                  <input type="file" name="property_video_<?php echo $i; ?>" id="property-video-<?php echo $i; ?>" class="form-control" accept="video/*" >
                                              </div>
                                          </div>
                                      </div>
                                  <?php endfor; ?>
                            <div class="col-12 d-flex justify-content-between">
                              <button class="btn btn-outline-secondary btn-prev">
                                <i class="ri-arrow-left-line me-sm-1"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                              <button class="btn btn-success btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ri-arrow-right-line"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- Review -->
                        <div id="review-submit" class="content">
                          <p class="fw-medium mb-2">Property Information</p>
                          <ul class="list-unstyled">
                            <li>Property Title:- <span id="show_property_title"></span> </li>
                            <li>Builder Name:- <span id="show_builder_name"></span></li>
                            <li>Property Location:- <span id="show_property_location_id"></span></li>
                            <!-- <li>Google Location:- <b>Latitude</b>-<span id="show_google_location_lat"></span> <b>Longitude</b>-<span id="show_google_location_long"></span></li> -->
                          </ul>
                          <hr />
                          <p class="fw-medium mb-2">Other Details</p>
                          <ul class="list-unstyled">
                            <li>Car Parking:- <span id="show_car_parking"></span> </li>
                            <li>Furnishing:- <span id="show_furnishing"></span></li>
                            <li>Amenities:- <span id="show_amenities"></span></li>
                            <li>USP:- <span id="show_USP"></span></li>
                          </ul>
                          <hr />
                          <p class="fw-medium mb-2">Property PDF Files</p>
                          <ul class="list-unstyled">
                          </ul>
                          <hr />
                          <p class="fw-medium mb-2">Property Videos</p>
                          <ul class="list-unstyled">
                          </ul>
                          <div class="col-12 d-flex justify-content-between">
                            <button class="btn btn-outline-secondary btn-prev">
                              <i class="ri-arrow-left-line me-sm-1"></i>
                              <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <!-- <button class="btn btn-success btn-submit">Submit</button> -->
                            <button type="submit" class="btn btn-success me-4 waves-effect waves-light" name="submit">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>        
              </div>
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

    <!-- Core JS -->

    <!-- Vendors JS -->
    <!-- <script src="assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script> -->
    <!-- <script src="assets/vendor/libs/select2/select2.js"></script> -->

    <!-- Page JS -->

    <script src="assets/js/form-wizard-icons.js"></script>
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
    
  </body>
</html>
