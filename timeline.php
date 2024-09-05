<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

    $i = 1;
    // $leads_id = $_REQUEST['leads_id'];
    $leads_id = 5;
    
    
    $sqlleads = "select * from leads where id = $leads_id ";
    $qleads = $pdo->prepare($sqlleads);
    $qleads->execute(array());      
    $leadsArray = $qleads->fetchAll(PDO::FETCH_ASSOC);
    
    $sqlCE = "SELECT * FROM assign_leads where leads_id= $leads_id ";
    $qCE = $pdo->prepare($sqlCE);
    $qCE->execute(array());      
    $CE_Leads_Array = $qCE->fetchAll(PDO::FETCH_ASSOC);

    $sqlSE = "SELECT * FROM assign_leads_sr where leads_id= $leads_id ";
    $qSE = $pdo->prepare($sqlSE);
    $qSE->execute(array());      
    $SE_Leads_Array = $qSE->fetchAll(PDO::FETCH_ASSOC);

    $sqlconv = "SELECT * FROM converted_leads where leads_id= $leads_id ";
    $qconv = $pdo->prepare($sqlconv);
    $qconv->execute(array());      
    $Converted_Leads_Array = $qconv->fetchAll(PDO::FETCH_ASSOC);

    $admin_id = 0;
    if($CE_Leads_Array != null) {
        $admin_id = $CE_Leads_Array['admin_id'];
    }

    $sqlemp = "select * from employee where admin_id = ? ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array( $admin_id));      
    $Emp_Array = $q->fetch(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // var_dump($leadsArray);
    // echo "<br>";
    // var_dump($CE_Leads_Array);
    // echo "<br>";
    // var_dump($SE_Leads_Array);
    // echo "<br>";
    // var_dump($Converted_Leads_Array);
    // echo "<br>";
    // var_dump($Emp_Array);
    // echo "<br>";
    // echo "</pre>";

    // $date = "2024-08-24 16:40:59";
    // var_dump($date);
    // $timeline_date = date("Y-m-d H:i:s", strtotime($date));
    // var_dump($timeline_date);

    $AllData = array();
    foreach($leadsArray as $leadsSingle) {
        // var_dump($leadsSingle['leads']);
        // var_dump($leadsSingle['id']);
        // var_dump($leadsSingle['status']);
        // var_dump($leadsSingle['status']);
        // var_dump($leadsSingle['added_on']);
        // var_dump($leadsSingle['edited_on']);
        $timeline_date = null;
        $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['added_on']));
        
            array_push($AllData, array(
                "table_name" => 'leads',
                "id" => $leadsSingle['id'],
                "status" => $leadsSingle['status'],
                "transfer_status" => $leadsSingle['status'],
                "timlinedate" => $timeline_date,
                "added_on" => $leadsSingle['added_on'],
                "edited_on" => $leadsSingle['edited_on'],
            ));
    }
    foreach($CE_Leads_Array as $CE_Leads_Single) {
        // var_dump($CE_Leads_Single['assign_leads']);
        // var_dump($CE_Leads_Single['assign_leads_id']);
        // var_dump($CE_Leads_Single['status']);
        // var_dump($CE_Leads_Single['transfer_status']);
        // var_dump($CE_Leads_Single['added_on']);
        // var_dump($CE_Leads_Single['edited_on']);
        // $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['added_on']));
        
        // if($CE_Leads_Single['status'] == "Active" && $CE_Leads_Single['transfer_status']== "Available"){
        //     $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['added_on']));
        // }
        // if($CE_Leads_Single['status'] == "Active" && $CE_Leads_Single['transfer_status']== "Transfered"){
        //     $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['edited_on']));
        // }
        // if($CE_Leads_Single['status'] == "Transfered" && $CE_Leads_Single['transfer_status']== "Available"){
        //     $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['added_on']));
        // }
        // if($CE_Leads_Single['status'] == "Assigned" && $CE_Leads_Single['transfer_status']== "Transfered"){
        //     $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['edited_on']));
        // }
        // if($CE_Leads_Single['status'] == "From SE" && $CE_Leads_Single['transfer_status']== "Available"){
        //     $timeline_date = date("Y-m-d H:i:s", strtotime($leadsSingle['added_on']));
        // }
        $timeline_date_ce = null;
        if($CE_Leads_Single['status'] == "Active" && $CE_Leads_Single['transfer_status']== "Available"){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['added_on']));
        }
        if($CE_Leads_Single['status'] == "Followup" && $CE_Leads_Single['transfer_status']== "Not Available"){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['edited_on']));
        }
        if($CE_Leads_Single['status'] == "Followup" && $CE_Leads_Single['transfer_status']== "Available"){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['added_on']));
        }
        if($CE_Leads_Single['status'] == "Active" && $CE_Leads_Single['transfer_status']== "Transferred"){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['edited_on']));
        }
        if($CE_Leads_Single['status'] == "Transferred" && $CE_Leads_Single['transfer_status']== "Admin pending" && $CE_Leads_Single['request_for_admin']== "Admin pending" ){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['admin_request_date']));
        }
        if($CE_Leads_Single['status'] == "Transferred" && $CE_Leads_Single['transfer_status']== "Available" && strtolower($CE_Leads_Single['request_for_admin']) == "yes" ){
          $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['admin_aproved_date']));
        }
        if($CE_Leads_Single['status'] == "From SE" && $CE_Leads_Single['transfer_status']== "Admin pending" && $CE_Leads_Single['request_for_admin']== "Admin pending" ){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['admin_request_date']));
        }
        if($CE_Leads_Single['status'] == "From SE" && $CE_Leads_Single['transfer_status']== "Available" && $CE_Leads_Single['request_for_admin']== "" ){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['admin_aproved_date']));
        }
        if($CE_Leads_Single['status'] == "Dead"){
            $timeline_date_ce = date("Y-m-d H:i:s", strtotime($CE_Leads_Single['edited_on']));
        }
        

            array_push($AllData, array(
                "table_name" => 'assign_leads',
                "id" => $CE_Leads_Single['assign_leads_id'],
                "status" => $CE_Leads_Single['status'],
                "transfer_status" => $CE_Leads_Single['transfer_status'],
                "timlinedate" => $timeline_date_ce,
                "added_on" => $CE_Leads_Single['added_on'],
                "edited_on" => $CE_Leads_Single['edited_on'],
            ));
    }
    foreach($SE_Leads_Array as $SE_Leads_Single) {
        $timeline_date_se = null;

        if($SE_Leads_Single['status'] == "Active" && $SE_Leads_Single['transfer_status']== "Available"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['added_on']));
        }
        if($SE_Leads_Single['status'] == "Followup" && $SE_Leads_Single['transfer_status']== "Not Available"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }
        if($SE_Leads_Single['status'] == "Followup" && $SE_Leads_Single['transfer_status']== "Available"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }
        // if($SE_Leads_Single['status'] == "Active" && $SE_Leads_Single['transfer_status']== "Transferred" && strtoupper($SE_Leads_Single['transfer_employee_type']) == "SALES EXECUTIVE"){
        //   $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        // }
        if($SE_Leads_Single['status'] == "Active" && $SE_Leads_Single['transfer_status']== "Transferred" && strtoupper($SE_Leads_Single['transfer_employee_type']) == "SALES EXECUTIVE" && strtolower($SE_Leads_Single['request_for_admin']) == ""){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['admin_request_date']));
        }
        if($SE_Leads_Single['status'] == "Active" && $SE_Leads_Single['transfer_status'] == "Transferred" && strtoupper($SE_Leads_Single['transfer_employee_type']) == "CUSTOMER EXECUTIVE" && strtolower($SE_Leads_Single['request_for_admin']) == ""){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['admin_request_date']));
        }     

        if($SE_Leads_Single['status'] == "Transferred" && $SE_Leads_Single['transfer_status']== "Admin pending" && strtoupper($SE_Leads_Single['transfer_employee_type']) == "SALES EXECUTIVE" && strtolower($SE_Leads_Single['request_for_admin']) == ""){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['admin_request_date']));
        }
        if($SE_Leads_Single['status'] == "Transferred" && $SE_Leads_Single['transfer_status']== "Available" && strtoupper($SE_Leads_Single['transfer_employee_type']) == "SALES EXECUTIVE" && strtolower($SE_Leads_Single['request_for_admin']) == "yes"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['admin_aproved_date']));
        }

        if($SE_Leads_Single['status'] == "Converted" && $SE_Leads_Single['transfer_status']== "Converted"){
          $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }
        if($SE_Leads_Single['status'] == "Dead"){
            $timeline_date_se = date("Y-m-d H:i:s", strtotime($SE_Leads_Single['edited_on']));
        }
        
        // var_dump($SE_Leads_Single['assign_leads_sr']);
        // var_dump($SE_Leads_Single['assign_leads_sr_id']);
        // var_dump($SE_Leads_Single['status']);
        // var_dump($SE_Leads_Single['transfer_status']);
        // var_dump($SE_Leads_Single['added_on']);
        // var_dump($SE_Leads_Single['edited_on']);
            array_push($AllData, array(
                "table_name" => 'assign_leads_sr',
                "id" => $SE_Leads_Single['assign_leads_sr_id'],
                "status" => $SE_Leads_Single['status'],
                "transfer_status" => $SE_Leads_Single['transfer_status'],
                "timlinedate" => $timeline_date_se,
                "added_on" => $SE_Leads_Single['added_on'],
                "edited_on" => $SE_Leads_Single['edited_on'],
            ));
    }
    foreach($Converted_Leads_Array as $Converted_Leads_Single) {
        $timeline_date_con = null;
        $timeline_date_con = date("Y-m-d H:i:s", strtotime($Converted_Leads_Single['added_on']));
        // var_dump($Converted_Leads_Single['converted_leads']);
        // var_dump($Converted_Leads_Single['converted_leads_id']);
        // var_dump($Converted_Leads_Single['status']);
        // var_dump($Converted_Leads_Single['status']);
        // var_dump($Converted_Leads_Single['added_on']);
        // var_dump($Converted_Leads_Single['edited_on']);
            array_push($AllData, array(
                "table_name" => 'converted_leads',
                "id" => $Converted_Leads_Single['converted_leads_id'],
                "status" => $Converted_Leads_Single['status'],
                "transfer_status" => $Converted_Leads_Single['status'],
                "timlinedate" => $timeline_date_con,
                "added_on" => $Converted_Leads_Single['added_on'],
                "edited_on" => $Converted_Leads_Single['edited_on'],
            ));
    }
    
    // var_dump(count($AllData));
    echo '<pre>';
    // var_dump(array_multisort(
    //                 array_column($AllData, 'edited_on'), 
    //                 array_column($AllData, 'added_on'), 
    //                 SORT_DESC, 
    //                 $AllData
    //             )
    //         );
     array_multisort(
                    array_column($AllData, 'timlinedate'), 
                    SORT_DESC, 
                    $AllData
                );
    // var_dump($AllData);
    echo '</pre>';
    // exit();

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

    <title> Timeline  |  Guru Properties</title>

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
    e<?php include 'layout/header_js.php'; ?>
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
              
              <div class="row overflow-hidden">
                <div class="col-12">
                  <ul class="timeline timeline-center mt-12">
                    <?php
                        foreach ($AllData as $variant) {
                            if($variant['table_name'] == "assign_leads_sr" || $variant['table_name'] == "converted_leads") {
                                $showside = "fade-right";
                                $roleName = "SALES EXECUTIVE";
                            } else if($variant['table_name'] == "assign_leads" || $variant['table_name'] == "leads") {
                                $roleName = "CUSTOMER EXECUTIVE";
                                $showside = "fade-left";
                            } 

                            $id=0;
                            if(isset($variant['id']) && $variant['id'] != 0) {
                                $id = $variant['id'];
                            }
                            
                            if($variant['table_name'] == "leads") {
                                $sqlSE = "select * from leads where id = $id ";
                                $qSE = $pdo->prepare($sqlSE);
                                $qSE->execute(array());      
                                $SEArray = $qSE->fetchAll(PDO::FETCH_ASSOC);
                                $data = $SEArray;
                            }
                            if($variant['table_name'] == "assign_leads") {
                                $sqlSE = "select * from assign_leads where assign_leads_id = $id ";
                                $qSE = $pdo->prepare($sqlSE);
                                $qSE->execute(array());      
                                $SEArray = $qSE->fetchAll(PDO::FETCH_ASSOC);
                                $data = $SEArray;
                            }
                            if($variant['table_name'] == "assign_leads_sr") {
                                $sqlSE = "select * from assign_leads_sr where assign_leads_sr_id = $id ";
                                $qSE = $pdo->prepare($sqlSE);
                                $qSE->execute(array());      
                                $SEArray = $qSE->fetchAll(PDO::FETCH_ASSOC);
                                $data = $SEArray;
                            }
                            if($variant['table_name'] == "converted_leads") {
                                $sqlCON = "select * from converted_leads where converted_leads_id = $id ";
                                $qCON = $pdo->prepare($sqlCON);
                                $qCON->execute(array());      
                                $CONArray = $qCON->fetchAll(PDO::FETCH_ASSOC);
                                $data = $CONArray;
                            }
                    ?>
                    <li class="timeline-item">
                      <span
                        class="timeline-indicator timeline-indicator-primary"
                        data-aos="zoom-in"
                        data-aos-delay="200">
                        <i class="ri-brush-line ri-20px"></i>
                      </span>
                      <div class="timeline-event card p-0" data-aos="<?php echo $showside; ?>">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                          <h6 class="card-title mb-0"><?php echo $roleName; ?></h6>
                          <div class="meta">
                            <span class="badge rounded-pill bg-label-primary"><?php echo $variant['status']; ?></span>
                            <span class="badge rounded-pill bg-label-success"><?php echo $variant['transfer_status']; ?></span>
                          </div>
                        </div>
                        <div class="card-body">
                          <p class="mb-2">
                            <?php var_dump($data); ?>
                          </p>
                          <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>

                            </div>
                          </div>
                        </div>
                        <div class="timeline-event-time"><?php 
                        echo date("d-m-Y" , strtotime($variant['timlinedate']));
                        echo "<br>";
                        echo date("H:i:s" , strtotime($variant['timlinedate']));
                        ?></div>
                      </div>
                    </li>
                    <?php } ?>
                    <!-- <li class="timeline-item">
                      <span
                        class="timeline-indicator timeline-indicator-success"
                        data-aos="zoom-in"
                        data-aos-delay="200">
                        <i class="ri-question-mark ri-20px"></i>
                      </span>
                      <div class="timeline-event card p-0" data-aos="fade-left">
                        <h6 class="card-header">Survey Report</h6>
                        <div class="card-body">
                          <div class="d-flex flex-wrap mb-6">
                            <div>
                              <div class="avatar avatar-xs me-4">
                                <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                              </div>
                            </div>
                            <span>assigned this task to <span class="fw-medium">Sarah</span></span>
                          </div>
                          <ul class="list-unstyled">
                            <li class="d-flex">
                              <div>
                                <div class="avatar avatar-xs me-4">
                                  <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                                </div>
                              </div>
                              <div class="mb-4 w-100">
                                <div class="progress bg-label-danger" style="height: 6px">
                                  <div
                                    class="progress-bar bg-danger"
                                    role="progressbar"
                                    style="width: 48.7%"
                                    aria-valuenow="25"
                                    aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                                <small>Jquery</small>
                              </div>
                            </li>
                            <li class="d-flex">
                              <div>
                                <div class="avatar avatar-xs me-4">
                                  <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                                </div>
                              </div>
                              <div class="mb-4 w-100">
                                <div class="progress" style="height: 6px">
                                  <div
                                    class="progress-bar bg-primary"
                                    role="progressbar"
                                    style="width: 31.3%"
                                    aria-valuenow="25"
                                    aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                                <small>React</small>
                                <small>React</small>
                                <small>React</small>
                                <small>React</small>
                              </div>
                            </li>
                            <li class="d-flex">
                              <div>
                                <div class="avatar avatar-xs me-4">
                                  <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                                </div>
                              </div>
                              <div class="mb-4 w-100">
                                <div class="progress bg-label-warning" style="height: 6px">
                                  <div
                                    class="progress-bar bg-warning"
                                    role="progressbar"
                                    style="width: 30%"
                                    aria-valuenow="25"
                                    aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                                <small>Angular</small>
                              </div>
                            </li>
                            <li class="d-flex">
                              <div>
                                <div class="avatar avatar-xs me-4">
                                  <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                </div>
                              </div>
                              <div class="mb-4 w-100">
                                <div class="progress bg-label-info" style="height: 6px">
                                  <div
                                    class="progress-bar bg-info"
                                    role="progressbar"
                                    style="width: 15%"
                                    aria-valuenow="25"
                                    aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                                <small>VUE</small>
                              </div>
                            </li>
                            <li class="d-flex">
                              <div>
                                <div class="avatar avatar-xs me-4">
                                  <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                </div>
                              </div>
                              <div class="w-100">
                                <div class="progress bg-label-success" style="height: 6px">
                                  <div
                                    class="progress-bar bg-success"
                                    role="progressbar"
                                    style="width: 10%"
                                    aria-valuenow="25"
                                    aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                                <small>Laravel</small>
                              </div>
                            </li>
                          </ul>
                        </div>
                        <div class="timeline-event-time">2nd January</div>
                      </div>
                    </li> -->
                  </ul>
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

<script>
function toggleReasonBox() {
    const checkbox = document.getElementById('customCheckDanger');
    const reasonBox = document.getElementById('reasonBox');

    if (checkbox.checked) {
        reasonBox.style.display = 'block';
    } else {
        reasonBox.style.display = 'none';
    }
}

// Initially hide the reason box if the checkbox is not checked
toggleReasonBox();
</script>
    
  </body>
</html>
