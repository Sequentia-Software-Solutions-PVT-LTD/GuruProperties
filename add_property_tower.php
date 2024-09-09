<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  if(isSet($_POST["submit"]))
  { 
    // $property_name_id = $_POST['property_name_id'];
    // $property_tower = $_POST['property_tower'];
    // $builder_possession = $_POST['builder_possession'];
    // $rera_possession = $_POST['rera_possession'];

    // $added_on = date('Y-m-d H-i-s');
    // // $status = "Active";
    
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $sql = "INSERT INTO `property_tower`(`property_name_id`, `property_tower_name`, `builder_possession`,`rera_possession`, `added_on`, `status`) VALUES (?,?,?,?,?,?)";
    // $q = $pdo->prepare($sql);
    // $q->execute(array($property_name_id, $property_tower, $builder_possession, $rera_possession, $added_on, 'Active'));
  
    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $input1 = $_POST['property_name_id'];
    $input2 = $_POST['property_tower'];
    $input3 = $_POST['builder_possession'];
    $input4 = $_POST['rera_possession'];
    // $input5 = $_POST['input5'];
    // $input6 = $_POST['input6'];
    $subCount= count($_POST['property_name_id']);
    
    $lead_date = date('Y-m-d');

    $submitedLocationList = array();
    $SubmittedLeadIdsList = array();
    // $id = 61;
    for($i=0; $i<$subCount; $i++) 
    {        
        $added_on = date('Y-m-d H-i-s');
        $status = "Active";
        // $transfer_status = "Available";
        // $todays_date = date('Y-m-d');

        $input1Single = $input1[$i];
        $input2Single = $input2[$i];
        $input3Single = $input3[$i];
        $input4Single = $input4[$i];
        // $input5Single = $input5[$i];
        // $input6Single = $input6[$i];
        
        $sql = "INSERT INTO property_tower(property_name_id, property_tower_name, builder_possession, rera_possession, status, added_on) values(?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($input1Single, $input2Single, $input3Single,  $input4Single, $status, $added_on));
        
        // array_push($submitedLocationList, $input3Single);
        // array_push($SubmittedLeadIdsList, ["lead_id" => $pdo->lastInsertId(), "location_id" => $input3Single]);
        
    }

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
                      <form action="#" class="form-repeater" method="POST" enctype="multipart/form-data">
                        <div data-repeater-list="group-a">
                        <div data-repeater-item="" style=""  class="items" data-group="test">
                            <div class="box-body" id="lead_addmore_div1">
                              <?php require_once('property_tower_addmore.php'); ?>
                            </div>
                        </div>

                        <div class="mb-0">
                          <button type="button" onClick="addMore();"  class="btn btn-primary waves-effect waves-light repeater-add-btn">
                            <i class="ri-add-line me-1"></i>
                            <span class="align-middle">Add</span>
                          </button>
                          <button type="submit" name="submit" class="btn btn-success waves-effect waves-light" style="float: right;">
                            <!-- <i class="ri-add-line me-1"></i> -->
                            <span class="align-middle">Submit</span>
                          </button>
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
            $("<DIV>").load("property_tower_addmore.php", function() {
                $("#lead_addmore_div1").append($(this).html());
            }); 
          }
      </script>
    
  </body>
</html>
