<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  if(isSet($_POST["suspend"]))
  { 
    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $assign_leads_id = $_POST['id'];
    $old_assign_leads_id = $_POST['oldid'];

    $added_on = date('Y-m-d H-i-s');
    $t_status = "Available";


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `assign_leads` SET  
          `edited_on` = ?, 
          `transfer_status` = ?,
          `admin_aproved_date` = ?,
          `request_for_admin` = 'yes'
          WHERE `assign_leads_id` = ?";

    $q = $pdo->prepare($sql);
    $q->execute(array($added_on, $t_status, $added_on, $assign_leads_id));


    // echo "<pre>";
    // print_r($sql);
    // exit();
    
    header('location:admin_request_leads_by_CE');
     
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

    <title>View Transfer Permission Leads |  Guru Properties</title>

    <meta name="description" content="" />

    <!-- *********** header******************  -->
    <?php include 'layout/header_js.php'; ?>
     <!-- *********** /header******************  -->

     <style>
        .mar-top {
            margin-top: -12px;
        }
        thead, tbody, tfoot, tr, td, th {
            text-align: left !important;
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
              <h5 class="card-header mar-bot-10">Transfer Permission Management</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All transfer permission are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of Transfer Permission</caption>
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Lead Name</th>
                            <th>Transferred By</th>
                            <th>Transferred To</th>
                            <th>Reason</th>
                            <th>Transferred Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                // $sql = "SELECT * FROM location ";
                                // $sql = "SELECT * FROM assign_leads where transfer_status = 'Admin Pending' and request_for_admin ='Yes' ";
                                $sql = "SELECT * FROM assign_leads where status = 'Transferred' and transfer_status = 'Admin Pending' and request_for_admin ='no' ";
                                $q = $pdo->query($sql);
                                foreach ($pdo->query($sql) as $row1) 
                                { 
                                    // echo "<pre>";
                                    // print_r($row1);
                                    // exit(); 

                                    $assign_leads_id = $row1['assign_leads_id'];
                                    $leads_id = $row1['leads_id'];
                                    $admin_id = $row1['admin_id'];
                                    $employee_id = $row1['employee_id'];

                                    $sqlex = "select * from assign_leads where leads_id = $leads_id and transfer_employee_id = $employee_id";
                                    $q = $pdo->prepare($sqlex);
                                    $q->execute(array());      
                                    $row_ex = $q->fetch(PDO::FETCH_ASSOC);
                                    $emp_name_row_ex = $row_ex["employee_name"];

                                    $sqlempaaw = "select * from employee where employee_name = '$emp_name_row_ex' ";
                                    $q = $pdo->prepare($sqlempaaw);
                                    $q->execute(array());      
                                    $row_emp_assign_ex = $q->fetch(PDO::FETCH_ASSOC);






                                    // echo "<pre>";
                                    // print_r($row_ex);
                                    // print_r($row_emp_assign_ex);
                                    // exit();  

                                    // $sqlemp = "select * from employee where admin_id = $admin_id ";
                                    // $q = $pdo->prepare($sqlemp);
                                    // $q->execute(array());      
                                    // $row_emp = $q->fetch(PDO::FETCH_ASSOC);

                                    $emp_name = $row1["employee_name"];
                                    $sqlempaa = "select * from employee where employee_name = '$emp_name' ";
                                    $q = $pdo->prepare($sqlempaa);
                                    $q->execute(array());      
                                    $row_emp_assign = $q->fetch(PDO::FETCH_ASSOC);

                                    $sqlleads = "select * from leads where id = $leads_id ";
                                    $q = $pdo->prepare($sqlleads);
                                    $q->execute(array());      
                                    $row_leads = $q->fetch(PDO::FETCH_ASSOC);
                          
                            ?>
                            <tr>
                                    <td><span class="fw-medium"><?php echo $i; ?></span></td>
                                    <td><?php echo $row_leads["lead_name"]; ?></td>
                                    <!-- <td><?php echo $row_ex["employee_name"]; ?></td> -->
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                          <div class="avatar avatar-sm me-3">
                                            <!-- <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"> -->
                                            <img src="assets/img/avatars/<?php echo $row_emp_assign_ex["login_photo"];?>" alt="Avatar" class="rounded-circle">
                                          </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                          <span class="name text-truncate h6 mb-0"><?php echo $row_ex["employee_name"]; ?></span>
                                          <small class="user_name text-truncate"><?php echo $row_emp_assign_ex["user_id"]; ?>
                                          </small>
                                        </div>
                                      </div>
                                    </td>
                                    <!-- <td><?php echo $row1["employee_name"]; ?></td> -->
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                          <div class="avatar avatar-sm me-3">
                                            <img src="assets/img/avatars/<?php echo $row_emp_assign["login_photo"];?>" alt="Avatar" class="rounded-circle">
                                          </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                          <span class="name text-truncate h6 mb-0"><?php echo $row1["employee_name"]; ?></span>
                                          <small class="user_name text-truncate"><?php echo $row_emp_assign["user_id"]; ?></small>
                                        </div>
                                      </div>
                                    </td>
                                    <td style="text-wrap: wrap;"><?php echo $row_ex["transfer_reason"]; ?></td>
                                    <td><?php echo date('d-m-Y H:i A', strtotime($row1["admin_request_date"])); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <!-- <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                            <div class="dropdown-menu"> -->
                                                <!-- <a class="dropdown-item waves-effect" href="edit_location?id=<?php echo $row["id"]; ?>"><i class="ri-pencil-line me-1"></i> Edit</a> -->
                                                <a class="btn btn-success btn-fab demo waves-effect waves-light open-myModal" style="color:#fff;" data-bs-toggle="modal" data-bs-target="#enableOTP" 
                                                data-id="<?php echo $row1["assign_leads_id"]; ?>"
                                                data-oldid="<?php echo $row_ex["assign_leads_id"]; ?>"
                                                ><i class="ri-check-double-line me-1 "></i> Approve</a>
                                            <!-- </div> -->
                                        </div>
                                    </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
                <!-- Enable OTP Modal -->
              <div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
                  <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                      <div class="text-center mb-6">
                        <h4 class="mb-2">Check Permission!</h4>
                        <p>Are you sure you want to give permission to transfer this lead?</p>
                      </div>
                      <!-- <p class="mb-5">
                        Enter your mobile phone number with country code and we will send you a verification code.
                      </p> -->
                      <form id="enableOTPForm" action="#" method="POST">
                        <input type="hidden" name="id" id="id"  value=""/>
                        <input type="hidden" name="oldid" id="oldid"  value=""/>
                      
                        <!-- <div class="col-12 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                          <button
                            type="reset"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                          </button>

                          <button type="submit" name ="suspend" class="btn btn-success">Yes</button>
                        </div> -->

                        <div class="row mt-10">
                            <div class="col-md-12">
                                  <button type="submit"  data-bs-toggle="tooltip" data-bs-placement="left"  class="btn btn-success waves-effect waves-light d-flex float-right" name="suspend">Yes</button>
                                  <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">No</button>
                            </div>
                        </div>
                      
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Enable OTP Modal -->
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
    
      <script>
            $(document).on("click", ".open-myModal", function (e) 
            {
                e.preventDefault();
                var _self = $(this);
                var id = _self.data('id');
                var oldid = _self.data('oldid');
                $("#id").val(id);
                $("#oldid").val(oldid);
                $(_self.attr('href')).modal('show');
            }); 
        </script>
  </body>
</html>
