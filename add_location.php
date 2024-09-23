<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  if(isSet($_POST["submit"]))
  { 
    
    $location = $_POST['location'];
    $subCount= count($_POST['location']);

    for($i=0;$i<$subCount;$i++) 
    {        
        $added_on = date('Y-m-d H-i-s');
        $locationSingle = $location[$i];

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO `location`(`name`) VALUES (?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($locationSingle));
    }

    header('location:view_locations');

    // $location = $_POST['location'];

    // $added_on = date('Y-m-d H-i-s');
    // // $status = "Active";

    // // echo "<pre>";
    // // print_r($_POST);
    // // exit();
    
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $sql = "INSERT INTO `location`(`name`) VALUES (?)";
    // $q = $pdo->prepare($sql);
    // $q->execute(array($location));
    // // $lastInsertedId = $pdo->lastInsertId();    
     
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

    <title> Add Property Location  |  Guru Properties</title>

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
              <h5 class="card-header mar-bot-10">Add Property Location Form</h5>
                <div class="card">
                    <h5 class="card-header">Add Property Location </h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="d-flexz align-items-center1 justify-content-center1">
                        <!-- <form action="#" method="post"> -->
                          <!-- <div class="row mt-2"> -->
                            <!-- <div class="col-md-12"> -->
                            <!-- <div class="row">
                                <label class="col-sm-2 col-form-label text-sm-end" for="formtabs-username">Property Location</label>
                                <div class="col-sm-6">
                                  <input type="text" name="location" id="formtabs-username" class="form-control" placeholder="Property Location" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required>
                                </div>
                              </div>
                            </div> -->
                            <!-- <div class="form-floating form-floating-outline mb-6">
                              <input type="text" name="location" id="formtabs-username" class="form-control" placeholder="Property Location" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required />
                              <label for="formtabs-username"> Property Location</label>
                            </div> -->
                          <!-- </div> -->
                          <!-- </div> -->

                          <!-- <div class="row">
                            <div class="col-md-11">
                              <div class="row justify-content-end" style="float: right;">
                                <div class="col-sm-4">
                                  <button type="submit" class="btn btn-primary me-4 waves-effect waves-light" name="submit">Submit</button>
                                </div>
                              </div>
                            </div>
                          </div> -->
                          <!-- <div class="row mt-10">
                            <div class="col-md-12 justify-content-end text-end">
                                  <button type="submit" class="btn btn-success me-4 waves-effect waves-light d-flex float-right" name="submit">Submit</button>
                                  <button type="reset" class="btn btn-outline-secondary waves-effect  d-flex float-left">Cancel</button>
                            </div>
                          </div> -->

                        <!-- </form> -->
                        <form action="#" class="form-repeater" method="POST" enctype="multipart/form-data">
                            <div data-repeater-list="group-a">
                            <div data-repeater-item="" style=""  class="items" data-group="test">
                                <div class="box-body" id="lead_addmore_div">
                                <div class="row">

                                    <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                                      <div class="form-floating form-floating-outline">
                                        <input type="text" name="location[]" id="form-repeater-3-5" class="form-control" placeholder="Property Location" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required>
                                        <label for="form-repeater-1-1">Property Location</label>
                                      </div>
                                    </div>
                                    
                                  </div>
                                  <hr class="mt-0">
                                </div>
                            </div>

                            <div class="row justify-content-start">
                                  <div class="col-4">
                                    <!-- <button type="button" class="btn btn-primary mt-4" onclick="addVariant()">+ Add</button> -->
                                    <button type="button" onclick="addMore();" class="btn btn-primary waves-effect waves-light repeater-add-btn">
                                      <i class="ri-add-line me-1"></i>
                                      <span class="align-middle">Add</span>
                                    </button>
                                  </div>
                            </div>

                            <div class="row mt-10">
                                  <div class="col-md-12">
                                        <button type="submit"  data-bs-toggle="tooltip" data-bs-placement="left"  class="btn btn-success me-4 waves-effect waves-light d-flex float-right" name="submit"  title="Click here to add above information">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary waves-effect  d-flex float-left">Cancel</button>
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
          function addMore() {
            // $("<DIV>").load("lead_addmore.php?exist", function() {
                $("#lead_addmore_div").append('<div class="row"><div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0"><div class="form-floating form-floating-outline"><input type="text" name="location[]" id="form-repeater-3-5" class="form-control" placeholder="Property Location" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, \'\')" required><label for="form-repeater-1-1">Property Location</label></div></div></div><hr class="mt-0">');
            // }); 
          }
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
    
  </body>
</html>
