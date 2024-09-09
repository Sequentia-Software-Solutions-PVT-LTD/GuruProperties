<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  
  // if((1))
  if(isSet($_POST["submit"]))
  {  
    echo "<pre>";
    $input1 = $_POST['input1'];
    $input2 = $_POST['input2'];
    $input3 = $_POST['input3'];
    $input4 = $_POST['input4'];
    $input5 = $_POST['input5'];
    $input6 = $_POST['input6'];
    $subCount= count($_POST['input1']);
    // $input1 = ["1", "2123", "Tset"];
    // $input2 = ["2", "asd", "asdasd"];
    // $input3 = ["6", "6", "7"];
    // $input4 = ["3", "asdasd", "dasdasdas"];
    // $input5 = ["16000000", "15000000", "5000000"];
    // $input6 = ["12", "asdasdasd", "test"];
    // $subCount= count($input1);
    
    $lead_date = date('Y-m-d');

    $submitedLocationList = array();
    $SubmittedLeadIdsList = array();
    // $id = 61;
    for($i=0;$i<$subCount;$i++) 
    {        
        $added_on = date('Y-m-d H-i-s');
        $status = "Active";
        $transfer_status = "Available";
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
        
        array_push($submitedLocationList, $input3Single);
        array_push($SubmittedLeadIdsList, ["lead_id" => $pdo->lastInsertId(), "location_id" => $input3Single]);
        // array_push($SubmittedLeadIdsList, ["lead_id" => $id, "location_id" => $input3Single]);
        // $id++;
    }
        //Submitted Lead Ids "LeadID", "lcoation Id"
        //   $SubmittedLeadIdsList = [
        //     ["lead_id" => 1, "location_id" => 4],
        //     ["lead_id" => 2, "location_id" => 3],
        //     ["lead_id" => 3, "location_id" => 4],
        //     ["lead_id" => 4, "location_id" => 1],
        //     ["lead_id" => 5, "location_id" => 6],
        //     ["lead_id" => 6, "location_id" => 12],
        //     ["lead_id" => 7, "location_id" => 13],
        //     ["lead_id" => 8, "location_id" => 11],
        //     ["lead_id" => 9, "location_id" => 6],
        //     ["lead_id" => 10, "location_id" => 3],
        //     ["lead_id" => 11, "location_id" => 8],
        //     ["lead_id" => 12, "location_id" => 9],
        //     ["lead_id" => 13, "location_id" => 10],
        //     ["lead_id" => 14, "location_id" => 2]
        // ];
    $submitedLocationList = array_unique($submitedLocationList);

    $LocationWiseSubmittedList = array();
    foreach($submitedLocationList as $submitedLocation) {
        $needle = $submitedLocation;
        $resultArray = array_filter($SubmittedLeadIdsList, function ($v) use ($needle) {
                return $v['location_id'] == $needle;
        });    
        $currentLeadsIds = array();
        foreach($resultArray as $result) {
          array_push($currentLeadsIds, $result["lead_id"]);
        }
        $locationLeadID = ["location_id" => $needle , "lead_ids" => $currentLeadsIds ];
        array_push($LocationWiseSubmittedList, $locationLeadID);
        // echo "<br>";
    }
    
    //Location Wise Submitted List
  //   $LocationWiseSubmittedList = [
  //     ["location_id" => 1, "lead_ids" => [4]],
  //     ["location_id" => 2, "lead_ids" => [14]],
  //     ["location_id" => 3, "lead_ids" => [2,10]],
  //     ["location_id" => 4, "lead_ids" => [1,3]],
  //     ["location_id" => 6, "lead_ids" => [5,9]],
  //     ["location_id" => 8, "lead_ids" => [11]],
  //     ["location_id" => 9, "lead_ids" => [12]],
  //     ["location_id" => 10, "lead_ids" => [13]],
  //     ["location_id" => 11, "lead_ids" => [8]],
  //     ["location_id" => 12, "lead_ids" => [6]],
  //     ["location_id" => 13, "lead_ids" => [7]],
  // ];


    $sqlcearray = "SELECT *, a.admin_id as ADMINID, e.employee_id as EMPLOYEEID FROM admin a JOIN employee e on a.admin_id = e.admin_id where a.login_role = 'CUSTOMER EXECUTIVE' and a.status = 'Active' and e.status = 'Active'";
    $qcearray = $pdo->query($sqlcearray);
    $customerExecutiveArray = array();
    foreach ($pdo->query($sqlcearray) as $rowcearray) { 
      $admin_id = $rowcearray['ADMINID'];
      $employee_id = $rowcearray['EMPLOYEEID'];
      $employee_name = $rowcearray['employee_name'];
      $location = $rowcearray['location_id'];
      $location = explode(",", $location);
      $employee_array = array("admin_id" => $admin_id, "employee_id" => $employee_id, "location_id" => $location);
      array_push($customerExecutiveArray,$employee_array);
    }
    
    $allEmployeeLocationList = $customerExecutiveArray;
    
    // $allEmployeeLocationList = [
    //     ["admin_id" => 40, "employee_id" => 10, "location_id" => "1,2,3,4,9"],
    //     ["admin_id" => 45, "employee_id" => 15, "location_id" => "9,10,11,12"],
    // ];
    // $allEmployeeLocationList = [
    //     ["admin_id" => 40, "employee_id" => 10, "location_id" => [1,2,3,4,9]],
    //     ["admin_id" => 45, "employee_id" => 15, "location_id" => [9,10,11,12]],
    // ];

    $LocationWiseEmployeeList = array();
    foreach($submitedLocationList as $submitedLocation) {
        $needle = $submitedLocation;
        // var_dump($needle);
        $resultArray = array_filter($allEmployeeLocationList, function ($v) use ($needle) {
                return in_array($needle, $v['location_id']); 
                // return $v['location_id'] == $needle; 
                
        });  

        $adminIds = array();
        $employeeIds = array();
        foreach($resultArray as $result) {
          array_push($adminIds, $result["admin_id"]);
          array_push($employeeIds, $result["employee_id"]);
        }
        // var_dump($adminIds);
        // var_dump($employeeIds);

        $LocationWiseEmployeeArray = ["location_id" => $needle, "admin_id" => $adminIds, "employee_id" => $employeeIds];
        array_push($LocationWiseEmployeeList, $LocationWiseEmployeeArray);
      }
      
    

    //LocationWise Employee List
    // $LocationWiseEmployeeList = [
    //     ["location_id" =>1, "admin_id" => [40], "employee_id" => [10]],
    //     ["location_id" =>2, "admin_id" => [40], "employee_id" => [10]],
    //     ["location_id" =>3, "admin_id" => [40], "employee_id" => [10]],
    //     ["location_id" =>4, "admin_id" => [40], "employee_id" => [10]],
    //     ["location_id" =>9, "admin_id" => [40, 45], "employee_id" => [10, 15]],
    //     ["location_id" =>10, "admin_id" => [45], "employee_id" => [15]],
    //     ["location_id" =>11, "admin_id" => [45], "employee_id" => [15]],
    //     ["location_id" =>12, "admin_id" => [45], "employee_id" => [15]]
    // ];

    $locationWiseEmployeeCount = array();
    foreach($LocationWiseEmployeeList as $LocationWiseEmployee) {
      $location_id = $LocationWiseEmployee["location_id"];
      $employee_count = count($LocationWiseEmployee["employee_id"]);

      $employeecountarray = ["location_id" => $location_id, "employee_count" => $employee_count];

      array_push($locationWiseEmployeeCount, $employeecountarray);
    }

    // var_dump($locationWiseEmployeeCount);
    // $locationWiseEmployeeCount = [
    //     ["location_id" =>1, "employee_count" => 1],
    //     ["location_id" =>2, "employee_count" => 1],
    //     ["location_id" =>3, "employee_count" => 1],
    //     ["location_id" =>4, "employee_count" => 1],
    //     ["location_id" =>9, "employee_count" => 2],
    //     ["location_id" =>10, "employee_count" => 1],
    //     ["location_id" =>11, "employee_count" => 1],
    //     ["location_id" =>12, "employee_count" => 1]
    // ];

    foreach($LocationWiseSubmittedList as $LocationWiseSubmittedElement) {
        $submittedLeadidsCount = count($LocationWiseSubmittedElement["lead_ids"]);
        $key = "location_id";
        $value = $LocationWiseSubmittedElement["location_id"];
        $employeeCount  = 0;
        $result = array_filter($locationWiseEmployeeCount, function($subarray) use ($key, $value) {
            return isset($subarray[$key]) && $subarray[$key] == $value;
        });
        
        if (!empty($result)) {
            $foundEmployeeCount = array_shift($result);
            $employeeCount = $foundEmployeeCount['employee_count'];
        }
        
        // $employeeCount = array_search($LocationWiseSubmittedElement["location_id"], array_column($locationWiseEmployeeCount, 'location_id'));
        // echo "lead_ids:-";   
        // var_dump(implode(",", $LocationWiseSubmittedElement["lead_ids"]));   
        // echo "location id:-";   
        // var_dump($LocationWiseSubmittedElement["location_id"]);   
        // var_dump($submittedLeadidsCount);   
        // var_dump($employeeCount);
        // echo "<br>";
        
        $insertedLeadIds = $LocationWiseSubmittedElement["lead_ids"];
        $totalCustomerExuctiveCount = $employeeCount;
      

        if($totalCustomerExuctiveCount > 0) {
          
            $leadsCount = count($insertedLeadIds); 
            $leadForsingleCE = floor($leadsCount/$totalCustomerExuctiveCount); 
            
            $customerExecutiveArray = array();
                
            $key = "location_id";
            $value = $LocationWiseSubmittedElement["location_id"];
            
            $resultEmployee = array_filter($LocationWiseEmployeeList, function($subarray) use ($key, $value) {
                return isset($subarray[$key]) && $subarray[$key] == $value;
            });
            
            if (!empty($resultEmployee)) {
                $foundEmployeeArray = array_shift($resultEmployee);
                array_push($customerExecutiveArray, $foundEmployeeArray); 
            }
            if($totalCustomerExuctiveCount < $leadsCount) {

                $employeewiseTotalLeadIds = array_chunk($insertedLeadIds, $leadForsingleCE); 

                $i = 0;
                $leadsAssigned = 0 ;

            
                for ($i=0; $i < count($customerExecutiveArray); $i++) { 

                      $employeewiseLeadIds = $employeewiseTotalLeadIds[$i];
                      $admin_id = implode(",", $customerExecutiveArray[$i]["admin_id"]);
                      $employee_id = implode(",", $customerExecutiveArray[$i]["employee_id"]);
                      $location_id = $customerExecutiveArray[$i]["location_id"];                 
                      //   $employee_name = $customerExecutiveArray[$i][2];
                      $employee_name = "test";
                      $added_on = date('Y-m-d H-i-s');
                      $lead_date = date('Y-m-d');

                      
                      foreach($employeewiseLeadIds as $employeewiseLeadId) {
                          $lead_id = $employeewiseLeadId;
                        $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`, `location_id`, `employee_name`, `status`,`transfer_status`,`lead_date`, `added_on`,`fresh_lead`) VALUES (?,?,?,?,?,?,?,?,?,?)";
                        $q = $pdo->prepare($sql);
                        $q->execute(array($lead_id, $admin_id, $employee_id, $location_id, $employee_name, 'Active', "Available", $lead_date, $added_on, 1));

                        $assign_lead = $pdo->lastInsertId();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "UPDATE leads set status='Assigned', assign_lead_id = ? WHERE id = ?";
                        $q = $pdo->prepare($sql);
                        $q->execute(array($assign_lead, $lead_id));

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
                          $lead_id = $employeewiseLeadId;
                        
                            $admin_id = implode(",", $customerExecutiveArray[$i]["admin_id"]);
                            $employee_id = implode(",", $customerExecutiveArray[$i]["employee_id"]);
                            $location_id = $customerExecutiveArray[$i]["location_id"];                 
                            //   $employee_name = $customerExecutiveArray[$i][2];
                            $employee_name = "test";
                            $added_on = date('Y-m-d H-i-s');
                            $lead_date = date('Y-m-d');

                            $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`,  `location_id`, `employee_name`, `status`,`transfer_status`,`lead_date`, `added_on`,`fresh_lead`) VALUES (?,?,?,?,?,?,?,?,?)";
                            $q = $pdo->prepare($sql);
                            $q->execute(array($lead_id, $admin_id, $employee_id, $location_id, $employee_name, 'Active', $transfer_status, $lead_date, $added_on));
                            
                            $assign_lead = $pdo->lastInsertId();
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "UPDATE leads set status='Assigned', assign_lead_id = ? WHERE id = ?";
                            $q = $pdo->prepare($sql);
                            $q->execute(array($assign_lead, $lead_id));

                            $i1++;
                            $leadsAssigned++;
                            $remainingLeadsForLoop--;
                        }
                      }
                    }
                }
      
                if(($leadsCount - $leadsAssigned) == 0) {
                  echo "Links Are Assigned Properly for location -".$value."<br>";
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
                        $lead_id = $employeewiseLeadId;
                        $admin_id = implode(",", $customerExecutiveArray[$i]["admin_id"]);
                        $employee_id = implode(",", $customerExecutiveArray[$i]["employee_id"]);
                        $location_id = $customerExecutiveArray[$i]["location_id"];                 
                        //   $employee_name = $customerExecutiveArray[$i][2];
                        $employee_name = "test";
                        $added_on = date('Y-m-d H-i-s');
                        $lead_date = date('Y-m-d');

                        $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`,  `location_id`, `employee_name`, `status`,`transfer_status`, `lead_date`, `added_on`,`fresh_lead`) VALUES (?,?,?,?,?,?,?,?,?,?)";
                        $q = $pdo->prepare($sql);
                        $q->execute(array($lead_id, $admin_id, $employee_id, $location_id, $employee_name, 'Active', 'Available', $lead_date, $added_on,1));
                        $assign_lead = $pdo->lastInsertId();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "UPDATE leads set status='Assigned', assign_lead_id = ? WHERE id = ?";
                        $q = $pdo->prepare($sql);
                        $q->execute(array($assign_lead, $lead_id));

                        $i1++;
                        $leadsAssigned++;
                        $remainingLeadsForLoop--;
                      }
                    }
                  }
              }

              if(($leadsCount - $leadsAssigned) == 0) {
                echo "Links Are Assigned Properly for location -".$customerExecutiveArray[$i]["location_id"]."<br>";
              }
            }
        }
    }
    echo "</pre>";
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
          $("<DIV>").load("lead_addmore.php", function() {
              $("#lead_addmore_div").append($(this).html());
          }); 
        }
    </script>
    
  </body>
</html>
