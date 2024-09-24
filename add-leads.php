<?php
include_once ('dist/conf/checklogin.php'); 
include ('dist/conf/db.php');

// Check if the form is submitted
// if (isset($_POST['submit'])) 
// {
//     echo "<pre>";
//     print_r($_POST);
//     exit();

//     // ---------------------------------------------------------------------------
//      // Check if the file was uploaded without errors
//      if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
//           echo "<pre>";
//           print_r($_FILES['file']); // This will show you the details of the uploaded file
//           exit();
//       } else {
//           echo "File upload error: " . $_FILES['file']['error'];
//       }
//   // -------------------------------------------------------------------------------

    
// }
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

    <title>Add Leads |  Guru Properties</title>

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
              <h5 class="card-header mar-bot-10">Leads Management</h5>
              <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Add Leads</h5>
                    <hr>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <form action="upload.php" class="form-repeater" method="POST" enctype="multipart/form-data">
                            <div data-repeater-list="group-a">
                                
                                <!-- New code for add leads by uploading excel -->
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="formFileMultiple" class="form-label">Choose CSV File</label>
                                        <input class="form-control" type="file" name="file" id="file" accept=".csv" required>
                                        <span style="color:red; float: right;">Please Upload CSV File Only..</span>
                                    </div>
                                </div>
                                <!-- /New code for add leads by uploading excel -->

                            </div>

                            <div class="row mt-10">
                                <div class="col-md-12">
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-placement="left" class="btn btn-success me-4 waves-effect waves-light d-flex float-right" name="submit" title="Click here to add above information">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary waves-effect d-flex float-left">Cancel</button>
                                </div>
                            </div>
                        </form>
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

      <script src="js/repeater.js"></script>
      <script>
      $(function(){ 
        $("#repeater").createRepeater();

      });
    </script>
    <script>
        function addMore() {
          $("<DIV>").load("lead_addmore.php?exist", function() {
              $("#lead_addmore_div").append($(this).html());
          }); 
        }
    </script>
    
  </body>
</html>
