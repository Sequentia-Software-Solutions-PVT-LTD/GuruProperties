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
    .mar-top1{
      /* margin-top:-10px ; */
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
              <h5 class="card-header mar-bot-10">Property Name Details Form</h5>
                <div class="card">
                    <h5 class="card-header">Add Property Name</h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="d-flexz align-items-center1 justify-content-center h-px-900">
                        <form action="#" method="post" enctype="multipart/form-data">
                          <div class="row g-4">
                            
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end mar-top1" for="formtabs-username"> Property Title</label>
                                <div class="col-sm-9 form-floating form-floating-outline">
                                    <input type="text" name="property_title" id="formtabs-username" class="form-control" placeholder="Property Title" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required>
                                    <label for="formtabs-username"> Property Title</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end mar-top1" for="formtabs-username"> Builder Name</label>
                                <div class="col-sm-9 form-floating form-floating-outline">
                                  <input type="text" name="builder_name" id="formtabs-username" class="form-control" placeholder=" Builder Name" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required>
                                  <label for="formtabs-username"> Builder Name</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Property Location</label>
                                <div class="col-sm-9 form-floating form-floating-outline">
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
                                    <label class="" for="formtabs-username"> Property Location</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end" for="google-location-lat">Google Location</label>
                                    <div class="col-sm-4 form-floating form-floating-outline">
                                        <!-- Latitude Input Field -->
                                        <input type="text" name="google_location_lat" id="google-location-lat" class="form-control" placeholder="Latitude" 
                                            pattern="^(\+|-)?(?:90(?:\.0+)?|\d{1,2}(?:\.\d+)?)$" 
                                            title="Please enter a valid latitude (-90 to 90)" 
                                            required>
                                            <label for="google-location-lat">Latitude</label>
                                    </div>
                                    <div class="col-sm-5 form-floating form-floating-outline">
                                        <!-- Longitude Input Field -->
                                        <input type="text" name="google_location_long" id="google-location-long" class="form-control" placeholder="Longitude" 
                                            pattern="^(\+|-)?(?:180(?:\.0+)?|(?:1[0-7]\d|\d{1,2})(?:\.\d+)?)$" 
                                            title="Please enter a valid longitude (-180 to 180)" 
                                            required>
                                        <label for="google-location-long">Longitude</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Property form details -->

                            <hr>
                            <!-- <h5 class="card-header" style="padding-bottom: 0;">Upload Property Details</h5> -->
                            <h5 class="card-header" style="padding-top:0;"> Other Details </h5>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Car Parking</label>
                                <div class="col-sm-9 form-floating form-floating-outline">
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
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Furnishing </label>
                                <div class="col-sm-9 form-floating form-floating-outline">
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
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Amenities  </label>
                                <div class="col-sm-9 form-floating form-floating-outline">
                                  <textarea class="form-control h-px-100" name="amenities" id="exampleFormControlTextarea1" placeholder="Write amenities here..."></textarea>
                                  <label for="formtabs-username"> Amenities  </label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> USP  </label>
                                <div class="col-sm-9 form-floating form-floating-outline">
                                  <textarea class="form-control h-px-100" name="USP" id="exampleFormControlTextarea1" placeholder="Write USP here..."></textarea>
                                  <label for="formtabs-username"> USP  </label>
                                </div>
                              </div>
                            </div>

                            <h5 class="card-header">Property PDF Files </h5>
                            
                            <div class="row">
                                  <!-- Property PDF 1 to 6 Fields -->
                                  <?php for ($i = 1; $i <= 6; $i++): ?>
                                      <div class="col-md-6">
                                          <div class="row">
                                              <!-- <label class="col-sm-3 col-form-label text-sm-end" for="property-pdf-<?php echo $i; ?>"> PDF <?php echo $i; ?></label> -->
                                              <div class="col-sm-9">
                                                  <label for="property-pdf-<?php echo $i; ?>" class="form-label">Property PDF <?php echo $i; ?></label>
                                                  <input type="file" name="property_pdf_<?php echo $i; ?>" id="property-pdf-<?php echo $i; ?>" class="form-control" accept="application/pdf" >
                                                  <br></div>
                                              
                                          </div>
                                      </div>
                                  <?php endfor; ?>

                                  <h5 class="card-header">Property Videos </h5>

                                  <!-- Video 1 to 4 Fields -->
                                  <?php for ($i = 1; $i <= 4; $i++): ?>
                                      <div class="col-md-6">
                                          <div class="row">
                                              <!-- <label class="col-sm-3 col-form-label text-sm-end" for="property-video-<?php echo $i; ?>"> Video <?php echo $i; ?></label> -->
                                              <div class="col-sm-9">
                                                  <label for="property-video-<?php echo $i; ?>" class="form-label">Property Video <?php echo $i; ?></label>
                                                  <input type="file" name="property_video_<?php echo $i; ?>" id="property-video-<?php echo $i; ?>" class="form-control" accept="video/*" >
                                                  <br>
                                              </div>
                                          </div>
                                      </div>
                                  <?php endfor; ?>
                            </div>
                            <!--  -->

                          </div>
                          <div class="row mt-12">
                            <div class="col-md-12">
                              <div class="row justify-content-end">
                                <div class="col-sm-4">
                                  <button type="submit" class="btn btn-primary me-4 waves-effect waves-light" name="submit">Submit</button>
                                  <button type="reset" class="btn btn-outline-secondary waves-effect">Cancel</button>
                                </div>
                              </div>
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
