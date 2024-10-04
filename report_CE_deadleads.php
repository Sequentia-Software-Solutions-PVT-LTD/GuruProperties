<?php
  include_once ('dist/conf/checklogin.php'); 
  include ('dist/conf/db.php');
  $pdo = Database::connect();
  Global  $reuestObejct;
  $excelData = array();

  $sql = "SELECT 
        COUNT(*) AS C_count, 
        MONTH(`added_on`) AS Month, 
        YEAR(`added_on`) AS Year,

      -- Count for dead leads
        COUNT(CASE WHEN status = 'Dead' THEN 1 END) AS dead_count

    FROM assign_leads 
    WHERE 1
    GROUP BY YEAR(`added_on`), MONTH(`added_on`)
    ORDER BY YEAR(`added_on`), MONTH(`added_on`)";


if (isset($_POST['submit'])) {
    $fromMonth = explode('-', $_POST['fromMonth'])[1];
    $fromYear = explode('-', $_POST['fromMonth'])[0];
    $toMonth = explode('-', $_POST['toMonth'])[1];
    $toYear = explode('-', $_POST['toMonth'])[0];

    $sql = "
    SELECT 
        COUNT(*) AS C_count, 
        MONTH(`added_on`) AS Month, 
        YEAR(`added_on`) AS Year,

      -- Count for dead leads
        COUNT(CASE WHEN status = 'Dead' THEN 1 END) AS dead_count

    FROM assign_leads 
    WHERE 
        MONTH(`added_on`) >= '$fromMonth' 
        AND MONTH(`added_on`) <= '$toMonth' 
        AND YEAR(`added_on`) >= '$fromYear' 
        AND YEAR(`added_on`) <= '$toYear'
    GROUP BY YEAR(`added_on`), MONTH(`added_on`)
    ORDER BY YEAR(`added_on`), MONTH(`added_on`)
    ";

    // Prepare and execute the statement
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute();
    // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($results);
    // exit();
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

    <title> Dead Leads Report - CE  |  Guru Properties</title>

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
                        <div class="col-md-5 user_role mb-6">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="month" name="fromMonth" id="html5-month-input" value="September 2024" />
                                <label for="html5-month-input">From Month/Year</label>
                            </div>
                        </div>
                        <div class="col-md-5 user_plan mb-6">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="month" name="toMonth" id="html5-month-input" />
                                <label for="html5-month-input">To Month/Year</label>
                            </div>
                        </div>
                        <div class="col-md-2 user_plan mb-6 text-center">
                                <button type="submit" class="btn btn-success me-4 waves-effect waves-light" name="submit">Submit</button>
                                </form>  
                                 <?php if(isSet($_POST["submit"])) { ?>
                                <form style="display: inline;" method="POST" name="formID" id="formID" action="xlsx_export" enctype="multipart/form-data">
                                <input type="hidden" id="postData" name="postData" value='<?php echo $reuestObejct; ?>' />
                                <button type="submit" target="_blank" class="btn btn-success" style="padding: 7px;" name="xlsx"  onclick="javascript: exportXLSX(); form.action='xlsx_export'; "><i class="ri-file-excel-line" aria-hidden="true"></i></button>                              
                                <?php } ?> 
                              </form> 
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
                            <!-- <th>Received Leads</th> -->
                            <!-- <th>Assigned Leads</th> -->
                            <!-- <th>Followup Leads</th> -->
                            <!-- <th>Transferred Leads</th> -->
                            <th>Dead Leads</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            foreach($pdo->query($sql) as $convertedLeads) 
                            {
                                $excelDataRow = array();
                                $cMonth = $convertedLeads['Month'];
                                $cYear = $convertedLeads['Year'];

                                // $sqlALCount = "SELECT count(leads_id) as TotalLeads FROM assign_leads WHERE fresh_lead = 1 and month(`added_on`) = '$cMonth' and YEAR(`added_on`) = '$cYear' GROUP BY month(`added_on`)";
                                // $qALCount = $pdo->prepare($sqlALCount);
                                // $qALCount->execute(array());
                                // $TotalLeads = $qALCount->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <tr class="even">
                            <td><?php array_push($excelDataRow, $cYear); echo $cYear; ?></td>
                            <td><?php array_push($excelDataRow, date("F", mktime(0, 0, 0, $cMonth, 10))); echo date("F", mktime(0, 0, 0, $cMonth, 10)); ?></td>
                            <td><?php array_push($excelDataRow, $convertedLeads['dead_count']); echo $convertedLeads['dead_count']; ?></td>
                        </tr>                        
                        <?php array_push($excelData, $excelDataRow); } ?>
                        <?php
                            $columns = "Year,Month,Received Leads,Transferred To CE,Transferred To SE,Converted Leads,Visited Leads,Dead Leads";
                            $filename = "Report_Dead_Leads_CE_";
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
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/libs/hammer/hammer.js"></script>
    <script src="assets/vendor/libs/i18n/i18n.js"></script>
    <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/moment/moment.js"></script>
    <script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="assets/vendor/libs/select2/select2.js"></script>
    <script src="assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="assets/vendor/libs/@form-validation/auto-focus.js"></script>
    <script src="assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="assets/vendor/libs/cleavejs/cleave-phone.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <!-- <script src="assets/js/report.js"></script> -->
  </body>
</html>
