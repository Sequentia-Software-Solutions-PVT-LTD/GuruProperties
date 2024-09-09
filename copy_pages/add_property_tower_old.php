<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  if(isSet($_POST["subimt"]))
  { 
   

    $property_name_id = $_POST['property_name_id'];
    $property_tower = $_POST['property_tower'];
    $builder_possession = $_POST['builder_possession'];
    $rera_possession = $_POST['rera_possession'];

    $added_on = date('Y-m-d H-i-s');
    // $status = "Active";


    // echo "<pre>";
    // print_r($_POST);
    // exit();
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `property_tower`(`property_name_id`, `property_tower_name`, `builder_possession`,`rera_possession`, `added_on`, `status`) VALUES (?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($property_name_id, $property_tower, $builder_possession, $rera_possession, $added_on, 'Active'));
    // $lastInsertedId = $pdo->lastInsertId();
    
    header('location:view_properties_tower');
     
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

    <title> Add Property Tower  |  Guru Properties</title>

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
              <h5 class="card-header mar-bot-10">Property Tower Details Form</h5>
                <div class="card">
                    <h5 class="card-header">Add Property Tower</h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="d-flex align-items-center1 justify-content-center h-px-300">
                        <form action="#" method="post">
                          <div class="row g-4">

                            <div class="col-md-6">
                              <div class="row">
                              <label for="notes" class="col-sm-3 col-form-label text-sm-end">Property Name</label>
                              <div class="col-sm-9">
                                <select id="roleDropdown" name="property_name_id" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                    <option value="" data-select2-id="18">Select Property Name</option>
                                    <?php
                                        $sql = "SELECT * FROM  property_name where status = 'Active'";
                                        foreach ($pdo->query($sql) as $row) 
                                        { 
                                        ?>
                                            <option value="<?php echo $row['property_name_id']?>"><?php echo $row['property_title']?></option> 
                                        <?php } ?>
                                </select>
                              </div>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Property Tower</label>
                                <div class="col-sm-9">
                                  <input type="text" name="property_tower" id="formtabs-username" class="form-control" placeholder="Property Tower"  required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username">Builder Possession</label>
                                <div class="col-sm-9">
                                  <input type="text" name="builder_possession" id="formtabs-username" class="form-control" placeholder="Builder Possession" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> RERA Possession</label>
                                <div class="col-sm-9">
                                  <input type="text" name="rera_possession" id="formtabs-username" class="form-control" placeholder=" RERA Possession" required>
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="row mt-12">
                            <div class="col-md-12">
                              <div class="row justify-content-end">
                                <div class="col-sm-4">
                                  <button type="submit" class="btn btn-primary me-4 waves-effect waves-light" name="subimt">Submit</button>
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
