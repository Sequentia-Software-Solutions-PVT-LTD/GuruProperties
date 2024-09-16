<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  if(isSet($_POST["suspend"]))
  { 
    $id = $_POST['id'];
    $added_on = date('Y-m-d H-i-s');
    $status = "Suspended";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO property( status, edited_on) values(?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($status, $added_on));

    // echo "<pre>";
    // print_r($sql);
    // exit();
    
    header('location:view-properties');
     
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

    <title>View Properties Varients |  Guru Properties</title>

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
              <h5 class="card-header mar-bot-10">Property Management</h5>
              <!-- <hr class="my-12"> -->
                <div class="card">
                    <h5 class="card-header"> All properties are listed below</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <caption class="ms-6">List of Properies</caption>
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Property</th>
                            <th>Tower</th>
                            <th>Builder Name</th>
                            <th>Variants</th>
                            <th>Area</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Builder Possession</th>
                            <th>RERA Possession</th>
                            <!-- <th>Status</th> -->
                            <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                $sql = "SELECT * FROM property_varients ";
                                // $sql = "SELECT * FROM admin where login_role = 'ASSISTANT' OR login_role = 'RECEPTIONIST' OR login_role = 'TECHNICIAN' ";
                                $q = $pdo->query($sql);
                                foreach ($pdo->query($sql) as $row) 
                                { 
                                    $property_name_id = $row['property_name_id'];
                                    $sqlp = "SELECT * FROM property_name where property_name_id= $property_name_id ";
                                    $q = $pdo->prepare($sqlp);
                                    $q->execute(array());      
                                    $row_p = $q->fetch(PDO::FETCH_ASSOC);

                                    $property_tower_id = $row['property_tower_id'];
                                    $sqlt = "SELECT * FROM property_tower where property_tower_id= $property_tower_id ";
                                    $q = $pdo->prepare($sqlt);
                                    $q->execute(array());      
                                    $row_pt = $q->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td><i class="ri-home-smile-line ri-22px text-primary me-4"></i><span class="fw-medium"><?php echo $i; ?></span></td>
                                    <!-- <td><?php echo $i; ?></td> -->
                                    <td><?php echo $row_p["property_title"]; ?></td>
                                    <td><?php echo $row_pt["property_tower_name"]; ?></td>
                                    <td><?php echo $row_p["builder_name"]; ?></td>
                                    <td><?php echo $row["varients"]; ?></td>
                                    <td><?php echo $row["area"]; ?></td>
                                    <td><?php echo $row["price"]; ?></td>
                                    <td><?php echo $row_p["location"]; ?></td>
                                    <td><?php echo $row_pt["builder_possession"]; ?></td>
                                    <td><?php echo $row_pt["rera_possession"]; ?></td>
                                    <!-- <?php if ($row["status"] == 'Active'){ ?>
                                        <td><span class="badge rounded-pill bg-label-primary me-1"><?php echo $row["status"]; ?></span></td>
                                    <?php } if ($row["status"] == 'Suspended'){?>
                                        <td><span class="badge rounded-pill bg-label-danger me-1"><?php echo $row["status"]; ?></span></td>
                                    <?php } ?>   -->

                                    <td style="display:none;">
                                    <?php if ($row["status"] == 'Active'){ ?>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                            <div class="dropdown-menu">
                                                <!-- <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="ri-eye-line me-1"></i> View</a> -->
                                                <a class="dropdown-item waves-effect" href="edit_property?id=<?php echo $row["id"]; ?>"><i class="ri-pencil-line me-1"></i> Edit</a>
                                                <!-- <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="ri-delete-bin-7-line me-1"></i> Delete</a> -->
                                                <a class="dropdown-item waves-effect open-myModal" data-bs-toggle="modal" data-bs-target="#enableOTP" data-id="<?php echo $row["id"]; ?>"><i class="ri-delete-bin-7-line me-1"></i> Delete</a>
                                                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enableOTP">
                                                    Show
                                                </button> -->

                                            </div>
                                        </div>
                                        <?php } ?>
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
                        <h4 class="mb-2">Suspend!..</h4>
                        <p>Do you really want suspend this property?</p>
                      </div>
                      <!-- <p class="mb-5">
                        Enter your mobile phone number with country code and we will send you a verification code.
                      </p> -->
                      <form id="enableOTPForm" class="row g-5"  action="suspend_property.php" method="POST">
                        <input type="hidden" name="id" id="id" value="" />
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
                                <button type="submit"  data-bs-toggle="tooltip" data-bs-placement="left"  class="btn btn-success waves-effect waves-light d-flex float-right" name="suspend">Submit</button>
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
                var id = _self.data('id');
                $("#id").val(id);
                $(_self.attr('href')).modal('show');
            }); 
        </script>
    
  </body>
</html>
