<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  
  if(isSet($_POST["submit"]))
  { 
    
      $input1 = $_POST['input1'];
      $input2 = $_POST['input2'];
      $input3 = $_POST['input3'];
      $input4 = $_POST['input4'];
      $input5 = $_POST['input5'];
      $input6 = $_POST['input6'];

      $subCount= count($_POST['input1']);

      $insertedLeadIds = array();
      for($i=0;$i<$subCount;$i++) 
      {        
          $added_on = date('Y-m-d H-i-s');
          $status = "Active";
          $todays_date = date('Y-m-d');

          $input1Single = $input1[$i];
          $input2Single = $input2[$i];
          $input3Single = $input3[$i];
          $input4Single = $input4[$i];
          $input5Single = $input5[$i];
          $input6Single = $input6[$i];

          
          $sql = "INSERT INTO leads(lead_name, email_id, location, phone_no, budget_range, Source, status, added_on, lead_gen_date) values(?,?,?,?,?,?,?,?,?)";
          $q = $pdo->prepare($sql);
          $q->execute(array($input1Single, $input2Single, $input3Single,  $input4Single,  $input5Single, $input6Single, $status, $added_on, $todays_date));
          array_push($insertedLeadIds, ["lead_id" => $pdo->lastInsertId(), "location_id" => $input3Single]);
      }

      // $insertedLeadIds = [1,2,3,4,5,6,7,8,9,10,11,12,13,14];
      // $customerExecutiveArray = [["a", "b", "c"],["d", "e", "f"],["g", "h", "i"],["j", "k", "l"]];


      $sqlcearray = "SELECT *, a.admin_id as ADMINID, e.employee_id as EMPLOYEEID FROM admin a JOIN employee e on a.admin_id = e.admin_id where a.login_role = 'CUSTOMER EXECUTIVE' and a.status = 'Active' and e.status = 'Active'";
      $qcearray = $pdo->query($sqlcearray);
      $customerExecutiveArray = array();
      foreach ($pdo->query($sqlcearray) as $rowcearray) { 
        $admin_id = $rowcearray['ADMINID'];
        $employee_id = $rowcearray['EMPLOYEEID'];
        $employee_name = $rowcearray['employee_name'];

        array_push($customerExecutiveArray, array($admin_id, $employee_id, $employee_name));
      }
    
      $totalCustomerExuctiveCount = count($customerExecutiveArray); 
      // echo "totalCustomerExuctiveCount ----- ".$totalCustomerExuctiveCount.'<br>';
      $leadsCount = count($insertedLeadIds); 
      // echo "leadsCount ----- ".$leadsCount.'<br>';
      $leadForsingleCE = floor($leadsCount/$totalCustomerExuctiveCount); 
      // echo "leadForsingleCE ----- ".$leadForsingleCE.'<br>';
      // $employeewiseTotalLeadIds = array_chunk($insertedLeadIds, $leadForsingleCE); 
      // echo "employeewiseTotalLeadIds ----- "; var_dump('<pre>', $employeewiseTotalLeadIds, '</pre>'); echo '<br>';
      
      // var_dump($insertedLeadIds);
      // echo '<br>';
      // var_dump($customerExecutiveArray);

      // exit();
      
      if($totalCustomerExuctiveCount < $leadsCount) {
        
        $employeewiseTotalLeadIds = array_chunk($insertedLeadIds, $leadForsingleCE); 

        $i = 0;
        $leadsAssigned = 0 ;
        for ($i=0; $i < count($customerExecutiveArray); $i++) { 

            $employeewiseLeadIds = $employeewiseTotalLeadIds[$i];
              $admin_id = $customerExecutiveArray[$i][0];
              $employee_id = $customerExecutiveArray[$i][1];
              $employee_name = $customerExecutiveArray[$i][2];
              $added_on = date('Y-m-d H-i-s');
              
              foreach($employeewiseLeadIds as $employeewiseLeadId) {
                $lead_id = $employeewiseLeadId['lead_id'];
                $location_id = $employeewiseLeadId['location_id'];
                $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`, `location_id`, `employee_name`, `status`, `added_on`) VALUES (?,?,?,?,?,?,?)";
                $q = $pdo->prepare($sql);
                $q->execute(array($lead_id, $admin_id, $employee_id, $location_id, $employee_name, 'Active', $added_on));
                $leadsAssigned++;
              }
        }

        $remaining_leads = $leadsCount - $leadsAssigned;

        if($remaining_leads > 0) {
            $remainingLeadsForLoop = $remaining_leads;
            foreach($employeewiseTotalLeadIds as $employeewiseLeadIds) {
              while( $remainingLeadsForLoop != 0 ) {
                $i1 = 0;

                $employeewiseLeadIds = $employeewiseTotalLeadIds[$i];
                foreach($employeewiseLeadIds as $employeewiseLeadId) {
                  $admin_id = $customerExecutiveArray[$i1][0];
                  $employee_id = $customerExecutiveArray[$i1][1];
                  $employee_name = $customerExecutiveArray[$i1][2];
                  $added_on = date('Y-m-d H-i-s');
                                    
                  $lead_id = $employeewiseLeadId['lead_id'];
                  $location_id = $employeewiseLeadId['location_id'];
                  $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`, `location_id`, `employee_name`, `status`, `added_on`) VALUES (?,?,?,?,?,?,?)";
                  $q = $pdo->prepare($sql);
                  $q->execute(array($lead_id, $admin_id, $employee_id,  $location_id, $employee_name, 'Active', $added_on));
                  $i1++;
                  $leadsAssigned++;
                  $remainingLeadsForLoop--;
                }
              }
            }
        }

        if(($leadsCount - $leadsAssigned) == 0) {
          echo "Links Are Assigned Properly";
        }

      } else {
        $i = 0;
        $leadsAssigned = 0 ;
        $remaining_leads = $leadsCount;
        $employeewiseTotalLeadIds = array($insertedLeadIds);
        
        if($remaining_leads > 0) {
            $remainingLeadsForLoop = $remaining_leads;
            foreach($employeewiseTotalLeadIds as $employeewiseLeadIds) {
              while( $remainingLeadsForLoop != 0 ) {
                $i1 = 0;

                $employeewiseLeadIds = $employeewiseTotalLeadIds[$i];
                foreach($employeewiseLeadIds as $employeewiseLeadId) {
                  $admin_id = $customerExecutiveArray[$i1][0];
                  $employee_id = $customerExecutiveArray[$i1][1];
                  $employee_name = $customerExecutiveArray[$i1][2];
                  $added_on = date('Y-m-d H-i-s');
                  
                  $lead_id = $employeewiseLeadId['lead_id'];
                  $location_id = $employeewiseLeadId['location_id'];
                  $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`, `location_id`, `employee_name`, `status`, `added_on`) VALUES (?,?,?,?,?,?,?)";
                  $q = $pdo->prepare($sql);
                  $q->execute(array($lead_id, $admin_id, $employee_id, $location_id, $employee_name, 'Active', $added_on));
                  $i1++;
                  $leadsAssigned++;
                  $remainingLeadsForLoop--;
                }
              }
            }
        }

        if(($leadsCount - $leadsAssigned) == 0) {
          echo "Links Are Assigned Properly";
        }
      }
      
        
      // header('location:view-leads');
    
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
                    <form action="#" class="form-repeater" method="POST" enctype="multipart/form-data">
                      <div data-repeater-list="group-a">
                      <div data-repeater-item="" style=""  class="items" data-group="test">
                          <div class="box-body" id="lead_addmore_div">
                            <?php require_once('lead_addmore.php'); ?>
                          </div>
                      </div>

                      <!-- <div class="mb-0">
                        <button type="button" onClick="addMore();"  class="btn btn-primary waves-effect waves-light repeater-add-btn">
                          <i class="ri-add-line me-1"></i>
                          <span class="align-middle">Add</span>
                        </button>
                        <button type="submit" name="submit" class="btn btn-success waves-effect waves-light" style="float: right;">
                          <span class="align-middle">Submit</span>
                        </button>
                      </div> -->

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
