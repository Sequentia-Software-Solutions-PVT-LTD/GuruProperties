<?php
  include_once ('dist/conf/checklogin.php'); 
  include ('dist/conf/db.php');
  $pdo = Database::connect();
  Global  $reuestObejct;
  $excelData = array();


  $sqlemp = "select * from employee";
  $q = $pdo->prepare($sqlemp);
  $q->execute(array());      
  $row_emp = $q->fetchAll(PDO::FETCH_ASSOC);

  $sqlproperty = "select * from property_name ";
  $q = $pdo->prepare($sqlproperty);
  $q->execute(array());      
  $row_property = $q->fetchAll(PDO::FETCH_ASSOC);
  
  $sqltower = "select * from property_tower ";
  $q = $pdo->prepare($sqltower);
  $q->execute(array());      
  $row_tower = $q->fetchAll(PDO::FETCH_ASSOC);
  
  $sqlvariant = "select * from property_varients ";
  $q = $pdo->prepare($sqlvariant);
  $q->execute(array());      
  $row_variant = $q->fetchAll(PDO::FETCH_ASSOC);

  $sql = "SELECT *, month(`added_on`) as Month, YEAR(`added_on`) as Year FROM converted_leads WHERE 1 ";
  $overallCommision = 0;

  if(isset($_POST['submit']))
  {
    $fromMonth = explode('-',$_POST['fromMonth'])[1];
    $fromYear = explode('-',$_POST['fromMonth'])[0];
    $toMonth = explode('-',$_POST['toMonth'])[1];
    $toYear = explode('-',$_POST['toMonth'])[0];
    $employeeid = $_POST['employee_id'];

        $sql = "SELECT *, month(`added_on`) as Month, YEAR(`added_on`) as Year FROM converted_leads WHERE
            month(`added_on`) >= '$fromMonth' 
        and month(`added_on`) <= '$toMonth' 
        and YEAR(`added_on`) >= '$fromYear' 
        and YEAR(`added_on`) <= '$toYear' 
        and employee_id = '$employeeid'
            -- GROUP BY month(`added_on`)
        ";
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

    <title> Transfer Lead By SE  |  Guru Properties</title>

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
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- *********** header******************  -->
    <?php include 'layout/header_js.php'; ?>
     <!-- *********** /header******************  -->
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
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
              <form method="POST" action="#" enctype="multipart/form-data">
                <!-- Users List Table -->
                <div class="card">
                    <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Filters</h5>
                    <div class="d-flex justify-content-between align-items-center row gx-5 pt-4 gap-5 gap-md-0">
                        <div class="col-md-3 user_role mb-6">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="month" name="fromMonth" id="html5-month-input" value="September 2024" />
                                <label for="html5-month-input">From Month/Year</label>
                            </div>
                            <?php if(isset($_POST['fromMonth']) && $_POST['fromMonth'] != "") echo '<small style="margin-left: 15px;" class="text-danger">'.$_POST['fromMonth'].'</small>'; ?>
                        </div>
                        <div class="col-md-3 user_plan mb-6">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="month" name="toMonth" id="html5-month-input" />
                                <label for="html5-month-input">To Month/Year</label>
                            </div>
                            <?php if(isset($_POST['toMonth']) && $_POST['toMonth'] != "") echo '<small style="margin-left: 15px;" class="text-danger">'.$_POST['toMonth'].'</small>'; ?>
                        </div>
                        <div class="col-md-4 user_plan mb-6">
                            <div class="form-floating form-floating-outline">
                                <select
                                    name="employee_id"
                                    id="selectpickerSubtext"
                                    class="selectpicker w-100"
                                    data-style="btn-default"
                                    data-show-subtext="true" required>
                                        <?php
                                            $sqlemployeeArray = "SELECT * FROM employee WHERE status='Active' AND login_role IN ('CUSTOMER EXECUTIVE', 'SALES EXECUTIVE') ORDER BY login_role";
                                            $stmt = $pdo->query($sqlemployeeArray);
                                            $currentRole = '';

                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $employeeRole = $row['login_role'];

                                                // Add a header if the role changes
                                                if ($employeeRole !== $currentRole) {
                                                    if ($currentRole != '') {
                                                        // echo '<option disabled></option>'; // Add a separator
                                                    }
                                                    echo '<option disabled>' . htmlspecialchars($employeeRole) .'</option>';
                                                    $currentRole = $employeeRole;
                                                }

                                                $selected = "";
                                                if(isset($_POST['employee_id']) && $_POST['employee_id'] != 0){
                                                    if($_POST['employee_id'] == $row['employee_id']) 
                                                            $selected = "selected";
                                                }

                                                // Add the employee option
                                                echo '<option '.$selected.' data-subtext="'.htmlspecialchars($row['location']).'" value="' . htmlspecialchars($row['employee_id']) . '">' 
                                                . htmlspecialchars($row['employee_name']).'</option>';
                                            }
                                        ?>
                                </select>
                                <label for="roleDropdown">Sales Executive</label>
                            </div>
                            <?php if(isset($_POST['employee_id']) && $_POST['employee_id'] != "") echo '<small style="margin-left: 15px;" class="text-danger"></small>'; ?>
                        </div>
                        <div class="col-md-2 user_plan mb-6 text-center">
                                <button type="submit" class="btn btn-success me-4 waves-effect waves-light" name="submit">Submit</button>
                                  
                        </div>
                    </div>
                    </div>
                </form>
                <div class="card-datatable table-responsive">
                <table class="datatables-users table dataTable no-footer dtr-column">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Employee Name</th>
                            <th>Property Name</th>
                            <th>Tower</th>
                            <th>Variant</th>
                            <th>Agreement Value</th>
                            <th>Registration</th>
                            <th>GST</th>
                            <th>Stamp Duty</th>
                            <th>Commission</th>
                            <th>Quoted Price</th>
                            <th>Sale Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($pdo->query($sql) as $convertedLeads) {
                                $excelDataRow = array();
                                    $employeeName = "";
                                    $needle = $convertedLeads['employee_id'];
                                    $resultArray = array_filter($row_emp, function ($v) use ($needle) {
                                        return $needle == $v['employee_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
                                    $employeeName = $resultArray[$needle]["employee_name"]; 
                                    
                                    $propertyName = "";
                                    $needle = $convertedLeads['property_name_id'];
                                    $resultArray = array_filter($row_property, function ($v) use ($needle) {
                                        return $needle == $v['property_name_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["property_title"]) && $resultArray[$needle]["property_title"] != "") 
                                    $propertyName = $resultArray[$needle]["property_title"]; 

                                    $towerName = "";
                                    $needle = $convertedLeads['property_tower_id'];
                                    $resultArray = array_filter($row_tower, function ($v) use ($needle) {
                                        return $needle == $v['property_tower_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["property_tower_name"]) && $resultArray[$needle]["property_tower_name"] != "") 
                                    $towerName = $resultArray[$needle]["property_tower_name"]; 

                                    $variantName = "";
                                    $needle = $convertedLeads['property_variants'];
                                    $resultArray = array_filter($row_variant, function ($v) use ($needle) {
                                        return $needle == $v['property_varients_id']; 
                                    });
                                    if($needle == 1) $needle = 0;
                                    else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                                    if(isset($resultArray[$needle]["varients"]) && $resultArray[$needle]["varients"] != "") 
                                    $variantName = $resultArray[$needle]["varients"]; 

                                    $overallCommision += $convertedLeads['commission'];
                        ?>
                        <tr class="even">
                            <td><?php array_push($excelDataRow, $convertedLeads['Year']); echo $convertedLeads['Year']; ?></td>
                            <td><?php array_push($excelDataRow, date("F", mktime(0, 0, 0, $convertedLeads['Month'], 10))); echo date("F", mktime(0, 0, 0, $convertedLeads['Month'], 10)); ?></td>
                            <td><?php array_push($excelDataRow, $employeeName); echo $employeeName; ?></td>
                            <td><?php array_push($excelDataRow, $propertyName); echo $propertyName; ?></td>
                            <td><?php array_push($excelDataRow, $towerName); echo $towerName; ?></td>
                            <td><?php array_push($excelDataRow, $variantName); echo $variantName; ?></td>
                            <td><?php array_push($excelDataRow, $convertedLeads['agreement_value']); echo $convertedLeads['agreement_value']; ?></td>
                            <td><?php array_push($excelDataRow, $convertedLeads['registrantion']); echo $convertedLeads['registrantion']; ?></td>
                            <td><?php array_push($excelDataRow, $convertedLeads['gst']); echo $convertedLeads['gst']; ?></td>
                            <td><?php array_push($excelDataRow, $convertedLeads['stamp_duty']); echo $convertedLeads['stamp_duty']; ?></td>
                            <td><?php array_push($excelDataRow, $convertedLeads['commission']); echo $convertedLeads['commission']; ?></td>
                            <td><?php array_push($excelDataRow, $convertedLeads['quoted_price']); echo $convertedLeads['quoted_price']; ?></td>
                            <td><?php array_push($excelDataRow, $convertedLeads['sale_price']); echo $convertedLeads['sale_price']; ?></td>
                        </tr>                        
                        <?php array_push($excelData, $excelDataRow); } ?>
                        <?php
                            $columns = "Year,Month,Employee Name,Property Name,Tower,Variant,Agreement Value,Registration,GST,Stamp Duty,Commission,Quoted Price,Sale Price";
                            $filename = "Report_Converted_Leads_";
                            $reuestObejct = (array("excelData" => $excelData,"columns" => $columns,"filename" => $filename));
                        ?>
                        <script>
                            function exportXLSX() {
                              var data = <?php echo json_encode($reuestObejct); ?>;
                              console.log(data);
                              document.getElementById('postData').value = JSON.stringify(<?php echo json_encode($reuestObejct); ?>);
                            }
                        </script>
                    </tbody>
                    </table>
                </div>
                <!-- Offcanvas to add new user -->
                
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
     
    <!-- build:js assets/vendor/js/core.js -->
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <!-- <script src="assets/js/report.js"></script> -->
  </body>
</html>
