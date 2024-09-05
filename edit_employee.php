<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  $employee_id = $_REQUEST['employee_id'];
  $sql = "select * from employee where employee_id= $employee_id ";
  $q = $pdo->prepare($sql);
  $q->execute(array());      
  $row_d = $q->fetch(PDO::FETCH_ASSOC);

//   print_R($employee_id);
//   exit();

  if(isSet($_POST["subimt"]))
  { 
    // echo "<pre>";
    // print_R($_POST);
    //   exit();

    $employee_name = $_POST['employee_name'];
    // $user_id = $_POST['user_id'];
    // $password_post = $_POST['password'];
    // $password = password_hash($password_post, PASSWORD_BCRYPT);
    // $assistant_login_id = $_POST['assistant_login_id'];
    $added_on = date('Y-m-d H-i-s');
    $status = "Active";
    $login_role = $_POST['login_role'];
    $login_photo = "default.png";
    $email_id = $_POST['email_id'];
    $cell_no = $_POST['cell_no'];

    $employee_id = $_POST['employee_id'];

    $_employeelocation_id = $_POST['_employeelocation'];

    $sql = "select * from location where id = $_employeelocation_id ";
    $q = $pdo->prepare($sql);
    $q->execute(array());      
    $row_loc = $q->fetch(PDO::FETCH_ASSOC);

    $location_name = $row_loc['name'];

    $sql = "select * from employee where employee_id = $employee_id ";
    $q = $pdo->prepare($sql);
    $q->execute(array());      
    $row_d13 = $q->fetch(PDO::FETCH_ASSOC);

    $admin_id = $row_d13['admin_id'];

    $sql = "select * from admin where admin_id = $admin_id ";
    $q = $pdo->prepare($sql);
    $q->execute(array());      
    $row_d1 = $q->fetch(PDO::FETCH_ASSOC);
    // $admin_id = $row_d1['admin_id'];

    if(isset($_POST['password']) && $_POST['password'] != "") 
    { 
         $password = $_POST['password'];
         $password = password_hash("$password", PASSWORD_BCRYPT);
    }
    else
    {
        $password = $row_d1['login_password'];
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE  admin set login_name=?, login_password=?, login_role=?, type=?, location=?, location_id=? WHERE admin_id =?";
    $q = $pdo->prepare($sql);
    $q->execute(array($employee_name, $password, $login_role, $login_role, $location_name, $_employeelocation_id, $admin_id));

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE employee set employee_name=?, password=?, login_role=?, cell_no=?, email_id=?, location=?, location_id=?, edited_on=? WHERE admin_id =?";
    $q = $pdo->prepare($sql);
    $q->execute(array($employee_name, $password, $login_role, $cell_no, $email_id, $location_name, $_employeelocation_id, $added_on, $admin_id));
    // echo "<pre>";
    // print_r($sql);
    // exit();
    
    header('location:view-employees');
     
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

    <title>Edit Employee |  Guru Properties</title>

    <meta name="description" content="" />

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
              <h5 class="card-header mar-bot-10">Employee Details Form</h5>
                <div class="card">
                    <h5 class="card-header">Edit Employee</h5>
                    <div class="card-body">
                        <div class="d-flex align-items-center1 justify-content-center h-px-300">
                        <form action="#" method="post">
                          <input type="hidden" value="<?php echo $row_d['employee_id']; ?>" name="employee_id">
                          <div class="row g-4">
                          <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-country">Role</label>
                                <div class="col-sm-9">
                                  <div class="position-relative">
                                    <select id="formtabs-country"  name="login_role" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true">
                                      <option value="" data-select2-id="18">Select Employee Role</option>
                                      <option value="CUSTOMER EXECUTIVE" <?php if($row_d['login_role']=="CUSTOMER EXECUTIVE"){echo"Selected = 'selected'";}?>>Customer Executive</option>
                                      <option value="SALES EXECUTIVE" <?php if($row_d['login_role']=="SALES EXECUTIVE"){echo"Selected = 'selected'";}?>>Sales Executive</option>
                                      <option value="LEADS GENERATOR" <?php if($row_d['login_role']=="LEADS GENERATOR"){echo"Selected = 'selected'";}?>>Leads Generator</option>
                                    </select>
                                  <!-- <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="17" style="width: 383.9px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-formtabs-country-container"><span class="select2-selection__rendered" id="select2-formtabs-country-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select value</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
                                </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Name</label>
                                <div class="col-sm-9">
                                  <input type="text" name="employee_name" id="formtabs-username" class="form-control" value="<?php echo $row_d['employee_name']; ?>">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-email">Email</label>
                                <div class="col-sm-9">
                                  <div class="input-group input-group-merge">
                                    <input type="text"  name="email_id"  id="formtabs-email" class="form-control" value="<?php echo $row_d['email_id']; ?>" aria-label="john.doe" aria-describedby="formtabs-email2">
                                    <!-- <span class="input-group-text" id="formtabs-email2">@example.com</span> -->
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-phone">Phone No</label>
                                <div class="col-sm-9">
                                  <input type="text" name="cell_no"  id="formtabs-phone" class="form-control phone-mask" value="<?php echo $row_d['cell_no']; ?>" aria-label="658 799 8941">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6" style="display:none;">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username">User ID</label>
                                <div class="col-sm-9">
                                  <input type="text" name="user_id"  id="formtabs-username" class="form-control" value="<?php echo $row_d['user_id']; ?>">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row form-password-toggle">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-password">Password</label>
                                <div class="col-sm-9">
                                  <div class="input-group input-group-merge">
                                    <input type="password" name="password"  id="formtabs-password" class="form-control" placeholder="*********" aria-describedby="formtabs-password2">
                                    <span class="input-group-text cursor-pointer" id="formtabs-password2"><i class="ri-eye-off-line"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row form-password-toggle">
                                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-password">Property Location</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <select id="formtabs-location" name="_employeelocation" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                                <option value="" data-select2-id="18">Select Property Location</option>
                                                <?php
                                                    $sqlLocation = "SELECT * FROM location ORDER BY name";
                                                    foreach ($pdo->query($sqlLocation) as $row) {
                                                        $selected = ($row['id'] == $row_d['location_id']) ? 'selected' : '';
                                                        ?>
                                                        <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['name']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          

                          </div>
                          <div class="row mt-12">
                            <div class="col-md-12" style="justify-content: flex-end;display: flex;">
                              <!-- <div class="row justify-content-end"> -->
                                <!-- <div class="col-sm-4"> -->
                                  <button type="submit" class="btn btn-success me-4 waves-effect waves-light" name="subimt">Submit</button>
                                  <button type="reset" class="btn btn-outline-secondary waves-effect">Cancel</button>
                                <!-- </div> -->
                              <!-- </div> -->
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
    
  </body>
</html>
