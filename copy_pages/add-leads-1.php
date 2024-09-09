<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  if(isSet($_POST["subimt"]))
  { 
   

    $lead_name = $_POST['lead_name'];
    $email_id = $_POST['email_id'];
    $location = $_POST['location'];
    $phone_no = $_POST['phone_no'];
    $budget_range = $_POST['budget_range'];
    $Source = $_POST['Source'];
    $added_on = date('Y-m-d H-i-s');
    $status = "Active";

    // [lead_name] => dsfdfa
    // [email_id] => seqtest@demo.com
    // [location] => pune
    // [phone_no] => 9898989898
    // [budget_range] => 40-50 Lacs

    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO leads(lead_name, email_id, location, phone_no, budget_range, status,Source, added_on) values(?,?,?,?,?, ?, ?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($lead_name, $email_id, $location,  $phone_no,  $budget_range, 'Active',$Source, $added_on));

    // echo "<pre>";
    // print_r($sql);
    // exit();
    
    header('location:view-leads');
     
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
                  <div class="card-body demo-vertical-spacing demo-only-element">
                    <form class="form-repeater">
                      <div data-repeater-list="group-a">
                        
                      <div data-repeater-item="" style=""  class="items" data-group="test">
                          <div class="row">
                            <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="form-repeater-3-5" class="form-control" placeholder="">
                                <label for="form-repeater-1-1">Lead Name</label>
                              </div>
                            </div>
                            <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="form-repeater-3-6" class="form-control" placeholder="">
                                <label for="form-repeater-1-2">Email ID</label>
                              </div>
                            </div>
                            <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="form-repeater-3-7" class="form-control" placeholder="">
                                <label for="form-repeater-1-3">Location</label>
                              </div>
                            </div>
                            <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="form-repeater-3-8" class="form-control" placeholder="">
                                <label for="form-repeater-1-4">Contact</label>
                              </div>
                            </div>

                            <div class="mb-6 col-lg-6 col-xl-2 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="form-repeater-3-9" class="form-control" placeholder="">
                                <label for="form-repeater-1-5">Budget</label>
                              </div>
                            </div>

                            <div class="mb-6 col-lg-6 col-xl-1 col-12 mb-0">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="form-repeater-3-10" class="form-control" placeholder="">
                                <label for="form-repeater-1-6">Source</label>
                              </div>
                            </div>

                            <div class="mb-6 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                              <button class="btn btn-outline-danger btn-xl waves-effect" data-repeater-delete="">
                                <i class="ri-close-line ri-24px me-1"></i>
                                <span class="align-middle"></span>
                              </button>
                            </div>

                          </div>
                          <hr class="mt-0">
                        </div>
                      </div>
                      <div id="repeater">

                      </div>

                      <div class="mb-0">
                        <button type="button" class="btn btn-primary waves-effect waves-light repeater-add-btn">
                          <i class="ri-add-line me-1"></i>
                          <span class="align-middle">Add</span>
                        </button>
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

      <script src="js/repeater.js"></script>
      <script>
      $(function(){ 
        $("#repeater").createRepeater();

      });
    </script>
    
  </body>
</html>
