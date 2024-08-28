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
    $source = $_POST['source'];
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
    $sql = "INSERT INTO leads(lead_name, email_id, location, phone_no, budget_range, status,source, added_on) values(?,?,?,?,?, ?, ?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($lead_name, $email_id, $location,  $phone_no,  $budget_range, 'Active',$source, $added_on));

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
                <div class="card">
                    <h5 class="card-header"> Add Leads </h5>
                    <div class="card-body">
                        <div class="d-flex align-items-center1 justify-content-center h-px-500">
                        <form action="#" method="post">
                          <div class="row g-4">
                            
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end mar-top1" for="formtabs-username"> Lead Name </label>
                                <div class="col-sm-9">
                                  <input type="text" name="lead_name" id="formtabs-username" class="form-control" placeholder="Lead Name"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end mar-top1" for="formtabs-username">Email ID</label>
                                <div class="col-sm-9">
                                  <input type="email" name="email_id" id="formtabs-username" class="form-control" placeholder="Email ID">
                                </div>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username">Location</label>
                                <div class="col-sm-9">
                                  <input type="text"  name="location"  id="formtabs-username" class="form-control" placeholder="Location"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username">Phone No</label>
                                <div class="col-sm-9">
                                  <input type="text"  name="phone_no"  id="formtabs-username" class="form-control" placeholder="Phone No"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);">
                                </div>
                              </div>
                            </div>
                            

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end mar-top" for="formtabs-username">Budget Range</label>
                                <div class="col-sm-9">
                                  <!-- <input type="text"  name="budget_range"  id="formtabs-username" class="form-control" placeholder="Budget Range"> -->
                                  <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ri-money-rupee-circle-line"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" name="budget_range"  id="formtabs-username" placeholder="4000-5000" aria-label="Amount (to the nearest dollar)">
                                    <!-- <label>Amount</label> -->
                                </div>
                                <span class="input-group-text">.00</span>
                                </div>
                                </div>
                               
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end mar-top" for="formtabs-username">Source</label>
                                <div class="col-sm-9">
                                  <input type="text"  name="source"  id="formtabs-username" class="form-control" placeholder="Source">
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
    
  </body>
</html>
