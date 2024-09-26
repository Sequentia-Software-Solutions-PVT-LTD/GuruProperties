<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();


  if(isSet($_POST["submit"]))
  {
    $property_title = $_POST['property_title'];
    $builder_name = $_POST['builder_name'];
    $added_on = date('Y-m-d H-i-s');
    $status = "Active";
    $varients = $_POST['varients'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $location = $_POST['location'];

    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO property(property_title, builder_name, varients, area, price, status,location, added_on) values(?,?,?,?,?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($property_title, $builder_name, $varients,  $area,  $price, 'Active',$location, $added_on));

    // echo "<pre>";
    // print_r($sql);
    // exit();
    
    header('location:add_property');
     
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

    <title>View Employees |  Guru Properties</title>

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
              <h5 class="card-header mar-bot-10">Employee Management</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All employees are listed below <small class="text-success">(Hover on the location to see full list of locations)</small> </h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of Employees</caption>
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Employee Name</th>
                            <th>Property Location</th>
                            <th>Phone No</th>
                            <th>Email ID</th>
                            <th>Login ID</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                $sql = "SELECT * FROM employee e INNER JOIN admin a ON e.admin_id = a.admin_id";
                                // $sql = "SELECT * FROM admin where login_role = 'ASSISTANT' OR login_role = 'RECEPTIONIST' OR login_role = 'TECHNICIAN' ";
                                $q = $pdo->query($sql);
                                foreach ($pdo->query($sql) as $row) 
                                { 
                                  $login_photo = $row['login_photo'];
                                  // echo "$login_photo";
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?php echo $i; ?></span></td>

                                <td>
                                      <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                          <div class="avatar avatar-sm me-3">
                                            <!-- <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"> -->
                                            <img src="assets/img/avatars/<?php echo $login_photo;?>" alt="Avatar" class="rounded-circle">
                                          </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                          <span class="name text-truncate h6 mb-0"><?php echo $row["employee_name"]; ?></span>
                                          <small class="user_name text-truncate"><?php echo $row["user_id"]; ?></small>
                                        </div>
                                      </div>
                                    </td>
                                <!-- <td>
                                    <i class="ri-user-line ri-22px text-primary me-4"></i>
                                    <?php //echo $row["employee_name"]; ?>
                                </td> -->
                                <td>
                                    <?php 
                                      $locationsId = $row["location_id"];
                                      if($locationsId != "")
                                      $locationsId = $row["location_id"];
                                      else
                                      $locationsId = 0;
                                      $sqlLocationName = "SELECT name FROM location WHERE id IN ($locationsId) ORDER BY name";
                                      $qLocationName = $pdo->prepare($sqlLocationName);
                                      $qLocationName->execute(array());
                                      $locationNames = $qLocationName->fetchAll(PDO::FETCH_COLUMN);
                                    ?>
                                  <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip" data-bs-original-title="<?php echo implode("\n",$locationNames); ?>" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 150px; cursor: pointer;">
                                    <?php if($locationsId != "") echo implode(", ",$locationNames); ?>
                                  </div>
                                </td>
                                <td><?php echo $row["cell_no"]; ?></td>
                                <td><?php echo $row["email_id"]; ?></td>
                                <td><?php echo $row["user_id"]; ?></td>
                                <!-- <td>
                                    <?php
                                          if($row["login_role"] == "CUSTOMER EXECUTIVE"){
                                            echo '<button type="button" class="badge rounded-pill bg-label-primary me-1" style="font-size: 12px;border: none !important;">';
                                            echo $row["login_role"]; 
                                            echo '<span class="position-absolute top-0 start-100 translate-middle badge badge-center bg-label-warning border border-warning"></span></button>';
                                          } 
                                          if($row["login_role"] == "SALES EXECUTIVE") {
                                            echo '<button type="button" class="badge rounded-pill bg-label-info me-1" style="font-size: 12px;border: none !important;;">';
                                            echo $row["login_role"]; 
                                            echo '<span class="position-absolute top-0 start-100 translate-middle badge badge-center bg-label-warning border border-warning"></span></button>';
                                          }?>
                                </td> -->

                                <td>
                                  <?php if($row["login_role"] == "CUSTOMER EXECUTIVE"){ ?>
                                      <span class="d-flex align-items-center gap-2 text-heading" style=""><i class="ri-user-voice-line ri-22px text-primary"></i><?php echo $row["login_role"] ?></span>
                                  <?php } 
                                  if($row["login_role"] == "SALES EXECUTIVE") { ?>
                                    <span class="d-flex align-items-center gap-2 text-heading" style=""><i class="ri-map-pin-user-line ri-22px text-success" style="color:#26c6f9  !important;"></i><?php echo $row["login_role"] ?></span>
                                   <?php }?>
                                </td>

                                <td>
                                    <?php
                                          if($row["status"] == "Active"){
                                            echo '<button type="button" class="badge rounded-pill bg-label-success me-1" style="font-size: 12px;border: none !important;">';
                                            echo $row["status"]; 
                                            echo '<span class="position-absolute top-0 start-100 translate-middle badge badge-center bg-label-warning border border-warning"></span></button>';
                                          } 
                                          if($row["status"] == "Suspended") {
                                            echo '<button type="button" class="badge rounded-pill bg-label-danger me-1" style="font-size: 12px;border: none !important;;">';
                                            echo $row["status"]; 
                                            echo '<span class="position-absolute top-0 start-100 translate-middle badge badge-center bg-label-warning border border-warning"></span></button>';
                                          }
                                    ?>
                                </td>


                                <!-- <td style="color: <?php echo ($row["status"] == 'Active') ? 'green' : (($row["status"] == 'Suspended') ? 'red' : 'black'); ?>">
                                    <?php echo $row["status"]; ?>
                                </td> -->
                                <!-- <td>
                                  <a type="button" class="btn btn-success btn-xs glyphicon glyphicon-eye-open" href="view_assistant?assistant_id=<?php //echo $row["assistant_id"]; ?>"></a>
                                  <?php if ($row["status"] == 'Active'){ ?>
                                  <a type="button" class="btn btn-xs btn-info glyphicon glyphicon-pencil" href="edit_employee.php?admin_id=<?php echo $row["admin_id"]; ?>"></a>
                                  <a type="button" class="open-myModal btn btn-danger btn-xs glyphicon glyphicon-trash" data-toggle="modal" data-target=".bs-modal-sm" id="open" data-admin_id="<?php echo $row["admin_id"]; ?>"></a>
                                  <?php } ?>
                                </td> -->
                                <?php if ($row["status"] == 'Active'){ ?>
                                    <td style="display:flex; padding:23px;">
                                       
                                        <!-- <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                            <div class="dropdown-menu"> -->
                                                <!-- <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="ri-eye-line me-1"></i> View</a> -->
                                                <a class="dropdown-item waves-effect" href="edit_employee?employee_id=<?php echo $row["employee_id"]; ?>"><i class="ri-pencil-line me-1" style="color:orange;"></i> </a>
                                                <!-- <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="ri-delete-bin-7-line me-1"></i> Delete</a> -->
                                                <a class="dropdown-item waves-effect open-myModal" data-bs-toggle="modal" data-bs-target="#enableOTP" data-employee_id="<?php echo $row["employee_id"]; ?>"><i class="ri-delete-bin-7-line me-1" style="color:red;"></i> </a>
                                            <!-- </div>
                                        </div> -->
                                       
                                    </td>
                                    <?php } else { ?>
                                      <td style="display:flex; padding:23px;">
                                      <a href="javascript:void(0);" class="dropdown-item waves-effect"><i class="ri-pencil-line me-1" style="color:gray;cursor:not-allowed;"></i> </a>
                                                <!-- <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="ri-delete-bin-7-line me-1"></i> Delete</a> -->
                                                <a href="javascript:void(0);" class="dropdown-item waves-effect open-myModal"><i class="ri-delete-bin-7-line me-1" style="color:gray;cursor:not-allowed;"></i> </a>
                                      </td>

                                    <?php } ?>
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
                        <h4 class="mb-2">Suspend!..</h4>
                        <p>Do you really want suspend this employee?</p>
                      </div>
                      <!-- <p class="mb-5">
                        Enter your mobile phone number with country code and we will send you a verification code.
                      </p> -->
                      <form id="enableOTPForm" class="row g-5"  action="suspend_employee.php" method="POST">
                        <input type="hidden" name="employee_id" id="employee_id"  value=""/>
                      
                        <!-- <div class="col-12 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                          <button
                            type="reset"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                          </button>

                          <button type="submit" name ="suspend" class="btn btn-danger">Suspend</button>
                        </div> -->

                        <div class="row d-flex mt-0">
                            <div class="col-md-12">
                                <button type="submit"  data-bs-toggle="tooltip" data-bs-placement="left"  class="btn btn-success waves-effect waves-light d-flex float-right" name="suspend">Suspend</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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
                var employee_id = _self.data('employee_id');
                $("#employee_id").val(employee_id);
                $(_self.attr('href')).modal('show');
            }); 
        </script>
  </body>
</html>
