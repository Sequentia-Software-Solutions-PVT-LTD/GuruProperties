<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();


$admin_id = $_SESSION['login_user_id'];

$g_total = 0;
$d_percentage = 0;


// -------------------------------------*** /combine query for get total values count***--------------------------------------------------------------------------------

// $admin_id = $_SESSION['login_user_id'];

// // SQL query using conditional aggregation
// $sql_combined = "
//     SELECT 
//         COUNT(CASE WHEN fresh_lead = 1 AND YEAR(added_on) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) 
//                    AND MONTH(added_on) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) THEN 1 END) AS total_fresh_leads,
//         COUNT(CASE WHEN connection_status = 'connected' AND YEAR(added_on) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
//                    AND MONTH(added_on) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) THEN 1 END) AS total_connected_leads,
//         COUNT(CASE WHEN connection_status = 'not_connected' AND YEAR(added_on) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
//                    AND MONTH(added_on) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) THEN 1 END) AS total_notconnected_leads,
//         COUNT(CASE WHEN status = 'Transferred' AND transfer_status = 'Available' THEN 1 END) AS total_transferred_leads,
//         COUNT(CASE WHEN status = 'Assigned' AND transfer_status = 'Transferred' THEN 1 END) AS total_assigned_leads,
//         COUNT(CASE WHEN status = 'Dead' THEN 1 END) AS total_dead_leads
//     FROM assign_leads 
//     WHERE admin_id = :admin_id
// ";

// $qtotal = $pdo->prepare($sql_combined);
// $qtotal->execute([':admin_id' => $admin_id]);
// $row_totals = $qtotal->fetch(PDO::FETCH_ASSOC);

// // Assigning values to variables
// $total_fresh_leads = $row_totals['total_fresh_leads'];
// $total_connected_leads = $row_totals['total_connected_leads'];
// $total_notconnected_leads = $row_totals['total_notconnected_leads'];
// $total_transferred_leads = $row_totals['total_transferred_leads'];
// $total_assigned_leads = $row_totals['total_assigned_leads'];
// $total_dead_leads = $row_totals['total_dead_leads'];

// // Calculate the grand total
// $g_total = $total_fresh_leads + $total_connected_leads + $total_notconnected_leads + $total_transferred_leads + $total_assigned_leads + $total_dead_leads;

// -------------------------------------*** /combine query for get total values count***--------------------------------------------------------------------------------

// +++++++++++++++++++++++++++++++ COUNTS FOR LAST MONTHS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// -------------------------- Total assigned leads count(fresh leads) -----------------------------------------------------------
$sql_total = "SELECT COUNT(assign_leads_id)  AS total_count
              FROM assign_leads 
              WHERE fresh_lead = 1 
              AND admin_id = $admin_id 
              AND YEAR(added_on) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
              AND MONTH(added_on) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";

$qtotal = $pdo->prepare($sql_total);
$qtotal->execute();
$row_total = $qtotal->fetch(PDO::FETCH_ASSOC);

$total_fresh_leads = $row_total['total_count'];


// -------------------------- Total Connected leads count -----------------------------------------------------------
$sql_connected = "SELECT COUNT(assign_leads_id)  AS total_count_connected
              FROM assign_leads 
              WHERE connection_status = 'connected'
              AND admin_id = $admin_id 
              AND YEAR(added_on) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
              AND MONTH(added_on) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";

$qtotalC = $pdo->prepare($sql_connected);
$qtotalC->execute();
$row_total_connected = $qtotalC->fetch(PDO::FETCH_ASSOC);

$total_connected_leads = $row_total_connected['total_count_connected'];


// -------------------------- Total Not-Connected leads count -----------------------------------------------------------
$sql_notconnected = "SELECT COUNT(assign_leads_id)  AS total_count_notconnected
              FROM assign_leads 
              WHERE connection_status = 'not_connected'
              AND admin_id = $admin_id 
              AND YEAR(added_on) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
              AND MONTH(added_on) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";

$qtotalNC = $pdo->prepare($sql_notconnected);
$qtotalNC->execute();
$row_total_notconnected = $qtotalNC->fetch(PDO::FETCH_ASSOC);

$total_notconnected_leads = $row_total_notconnected['total_count_notconnected'];

// -------------------------- Total Transferred leads count -----------------------------------------------------------
$sql_transferred = "SELECT COUNT(assign_leads_id)  AS total_count_transferred
              FROM assign_leads 
              WHERE status = 'Transferred' And transfer_status = 'Available'
              AND admin_id = $admin_id 
              AND YEAR(added_on) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
              AND MONTH(added_on) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
            ";

$qtotalT = $pdo->prepare($sql_transferred);
$qtotalT->execute();
$row_total_transferred = $qtotalT->fetch(PDO::FETCH_ASSOC);

$total_transferred_leads = $row_total_transferred['total_count_transferred'];


// -------------------------- /Total assigned leads count -----------------------------------------------------------
$sql_assigned = "SELECT COUNT(assign_leads_id)  AS total_count_assigned
              FROM assign_leads 
              WHERE status = 'Assigned' And transfer_status = 'Transferred'
              AND admin_id = $admin_id 
              AND YEAR(added_on) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
              AND MONTH(added_on) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
            ";

$qtotalA = $pdo->prepare($sql_assigned);
$qtotalA->execute();
$row_total_assigned = $qtotalA->fetch(PDO::FETCH_ASSOC);

$total_assigned_leads = $row_total_assigned['total_count_assigned'];


// -------------------------- Total Dead leads count -----------------------------------------------------------
$sql_dead = "SELECT COUNT(assign_leads_id)  AS total_count_dead
              FROM assign_leads 
              WHERE status = 'Dead' 
              AND admin_id = $admin_id 
              AND YEAR(added_on) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
              AND MONTH(added_on) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
            ";

$qtotalD = $pdo->prepare($sql_dead);
$qtotalD->execute();
$row_total_dead = $qtotalD->fetch(PDO::FETCH_ASSOC);

$total_dead_leads = $row_total_dead['total_count_dead'];

// -------------------------- /Total Dead leads count -----------------------------------------------------------
$total_fresh_leads =20;
$total_connected_leads =10; 
$total_notconnected_leads =5; 
$total_transferred_leads =12;
$total_assigned_leads =15;
$total_dead_leads=5;

$g_total = $total_fresh_leads + $total_connected_leads + $total_notconnected_leads + $total_transferred_leads +$total_assigned_leads + $total_dead_leads;

// =================================== for yesterday's counts=================================================================================================================================

$admin_id = $_SESSION['login_user_id'];

// SQL query using conditional aggregation for yesterday's values
$sql_combined = "
    SELECT 
        COUNT(CASE WHEN fresh_lead = 1 AND DATE(added_on) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 END) AS total_fresh_leads_y,
        COUNT(CASE WHEN connection_status = 'connected' AND DATE(added_on) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 END) AS total_connected_leads_y,
        COUNT(CASE WHEN connection_status = 'not_connected' AND DATE(added_on) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 END) AS total_notconnected_leads_y,
        COUNT(CASE WHEN status = 'Transferred' AND transfer_status = 'Available' AND DATE(added_on) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 END) AS total_transferred_leads_y,
        COUNT(CASE WHEN status = 'Assigned' AND transfer_status = 'Transferred' AND DATE(added_on) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 END) AS total_assigned_leads_y,
        COUNT(CASE WHEN status = 'Dead' AND DATE(added_on) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN 1 END) AS total_dead_leads_y
    FROM assign_leads 
    WHERE admin_id = :admin_id
";

$qtotal_y = $pdo->prepare($sql_combined);
$qtotal_y->execute([':admin_id' => $admin_id]);
$row_totals_y = $qtotal_y->fetch(PDO::FETCH_ASSOC);

// Assigning values to variables
$total_fresh_leads_y = $row_totals_y['total_fresh_leads_y'];
$total_connected_leads_y = $row_totals_y['total_connected_leads_y'];
$total_notconnected_leads_y = $row_totals_y['total_notconnected_leads_y'];
$total_transferred_leads_y = $row_totals_y['total_transferred_leads_y'];
$total_assigned_leads_y = $row_totals_y['total_assigned_leads_y'];
$total_dead_leads_y = $row_totals_y['total_dead_leads_y'];


// ************************************-----------Total count for donut graph (total leads and assigned leads)--------------************************************************************************************************************

$sql_fc = "SELECT COUNT(assign_leads_id)  AS total_count_fresh
              FROM assign_leads 
              WHERE fresh_lead = 1 
              AND admin_id = $admin_id ";

$qtotafc = $pdo->prepare($sql_fc);
$qtotafc->execute();
$row_total_fc = $qtotafc->fetch(PDO::FETCH_ASSOC);

$total_fresh_c = $row_total_fc['total_count_fresh'];
// -----------------------------------------------------------
$sql_ac = "SELECT COUNT(assign_leads_id)  AS total_count_AC
              FROM assign_leads 
              WHERE status = 'Assigned' And transfer_status = 'Transferred'
              AND admin_id = $admin_id ";

$qtotaac = $pdo->prepare($sql_ac);
$qtotaac->execute();
$row_total_ac = $qtotaac->fetch(PDO::FETCH_ASSOC);

$total_assign_c = $row_total_ac['total_count_AC'];

$d_percentage = 50;
// $d_percentage = ($row_total_ac / $total_fresh_c)*100;

// echo "<pre>";
// print_r($sql_dead);
// print_r($total_dead_leads);
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

    <title> Dashboard |  Guru Properties</title>

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

            <!-- Customer Executive Performance Weekly -->
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- *************** - main containt in page write here - **********************  -->
              <h5 class="card-header mar-bot-10">Customer Executive Performance - Yesterday</h5>
              <!-- <hr class="my-12"> -->

                <!-- ----------------Total cont for yesterday---------------------------------- -->

                <div class="row g-6 mb-6">
                    


                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_fresh_leads_y; ?></h5>
                            <p>Total Leads</p>
                            <div class="badge bg-label-secondary rounded-pill">Yesterday</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-success rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_connected_leads_y; ?></h5>
                            <p> Connected </p>
                            <div class="badge bg-label-secondary rounded-pill">Yesterday</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-secondary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-secondary rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_notconnected_leads_y; ?></h5>
                            <p> Not connected </p>
                            <div class="badge bg-label-secondary rounded-pill">Yesterday</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-warning rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_transferred_leads_y; ?></h5>
                            <p> Transferred</p>
                            <div class="badge bg-label-secondary rounded-pill">Yesterday</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-info rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_assigned_leads_y; ?></h5>
                            <p> Assigned</p>
                            <div class="badge bg-label-secondary rounded-pill">Yesterday</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-danger rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_dead_leads_y; ?></h5>
                            <p> Dead</p>
                            <div class="badge bg-label-secondary rounded-pill">Yesterday</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                </div>

                <br>
                <!-- -----------------Total count for last months--------------------- -->
                <h5 class="card-header mar-bot-10">Customer Executive Performance - Monthly</h5>
                <div class="row g-6 mb-6">
                    


                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_fresh_leads; ?></h5>
                            <p>Total Leads</p>
                            <div class="badge bg-label-secondary rounded-pill">Last Month</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-success rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_connected_leads; ?></h5>
                            <p> Connected </p>
                            <div class="badge bg-label-secondary rounded-pill">Last Month</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-secondary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-secondary rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_notconnected_leads; ?></h5>
                            <p> Not connected </p>
                            <div class="badge bg-label-secondary rounded-pill">Last Month</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-warning rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_transferred_leads; ?></h5>
                            <p> Transferred</p>
                            <div class="badge bg-label-secondary rounded-pill">Last Month</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-info rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_assigned_leads; ?></h5>
                            <p> Assigned</p>
                            <div class="badge bg-label-secondary rounded-pill">Last Month</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                    <!-- Total Expenses -->
                    <div class="col-xxl-2 col-md-2 col-sm-6">
                        <div class="card h-100 card-border-shadow-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-danger rounded-3">
                                <i class="ri-phone-line ri-24px"></i>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <p class="mb-0 text-success me-1">+38%</p>
                                <i class="ri-arrow-up-s-line text-success"></i>
                            </div> -->
                            </div>
                            <div class="card-info mt-5">
                            <h5 class="mb-1"><?php echo $total_dead_leads; ?></h5>
                            <p> Dead</p>
                            <div class="badge bg-label-secondary rounded-pill">Last Month</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--/ Total Expenses -->

                </div>
                <!-- ----------------/ total count last months-------------------------------------------------- -->
                
               <!-- *************** - /main containt in page write here - **********************  -->

               <!-- Graphs -->

                <div class="row g-6">
                    <!-- Organic Sessions Chart-->
                <!-- <h5 class="card-header mar-bot-10">Customer Executive Overviews </h5> -->

                <div class="col-lg-4 col-md-6 order-1 order-lg-0">
                  <div class="card h-100">
                    <div class="card-header pb-1">
                      <div class="d-flex justify-content-between">
                        <!-- <h5 class="mb-1">Organic Sessions</h5> -->
                        <h5 class="mb-1"> Total Overview - Monthly</h5>
                        <div class="dropdown">
                          <!-- <button
                            class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                            type="button"
                            id="organicSessionsDropdown"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-more-2-line ri-20px"></i>
                          </button> -->
                          <!-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="organicSessionsDropdown">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                          </div> -->
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div id="organicSessionsChart"></div>
                    </div>
                  </div>
                </div>
                <!--/ Organic Sessions Chart-->

                     <!-- Reasons for delivery exceptions -->
                        <div class="col-md-6 col-xxl-4 order-1 order-xxl-3">
                            <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div class="card-title mb-0">
                                <!-- <h5 class="m-0 me-2">Reasons for delivery exceptions</h5> -->
                                <h5 class="m-0 me-2">Total Leads And Assigned Leads</h5>
                                </div>
                                <div class="dropdown">
                                <!-- <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-1" type="button" id="deliveryExceptionsReasons" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-more-2-line ri-20px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptionsReasons">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div> -->
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="deliveryExceptionsChart"></div>
                            </div>
                            </div>
                        </div>
                        <!--/ Reasons for delivery exceptions -->

                        <!-- Weekly Overview Chart -->
                        <div class="col-xxl-4 col-md-6">
                        <div class="card h-100">
                            <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0">Weekly Overview</h5>
                                <div class="dropdown">
                                <!-- <button
                                    class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                                    type="button"
                                    id="weeklyOverviewDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="ri-more-2-line ri-20px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklyOverviewDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div> -->
                                </div>
                            </div>
                            </div>
                            <div class="card-body">
                            <div id="weeklyOverviewChart"></div>
                            <div class="mt-6" style="display:none;">
                                <div class="d-flex align-items-center gap-4">
                                <h4 class="mb-0">62%</h4>
                                <p class="mb-0">Your sales performance is 35% 😎 better compared to last month</p>
                                </div>
                                <div class="d-grid mt-6">
                                <button class="btn btn-primary" type="button">Details</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <!--/ Weekly Overview Chart -->

                    
                </div>
                <!--  -->

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
            // METER GRAPH - Total Overviews
            // $g_total = $total_fresh_leads + $total_connected_leads + $total_notconnected_leads + $total_transferred_leads +$total_assigned_leads + $total_dead_leads;
            var g_total =  <?php echo $g_total; ?>;
            var g_series = [<?php echo $total_fresh_leads; ?>,<?php echo $total_connected_leads; ?>,<?php echo $total_notconnected_leads; ?>,<?php echo $total_transferred_leads; ?>,<?php echo $total_assigned_leads; ?>,<?php echo $total_dead_leads; ?> ];


            // DONUT GRAPH - Total Leads And Assigned Leads
            var d_percentage = <?php echo $d_percentage; ?>;
            var d_series = [<?php echo $total_fresh_c;?>, <?php echo $total_assign_c; ?>];

      </script>
      <script src="assets/js/dashboards-crm.js"></script>
      <script src="assets/js/app-logistics-dashboard.js"></script>

      <script>
        
      </script>
     
  </body>
</html>
