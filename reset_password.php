<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  $isError = false;

//   echo "<pre>";
//   print_R($_SESSION);
//   exit();

  $login_user_id = $_SESSION['login_user_id'];

//   $employee_id = $_REQUEST['employee_id'];
  $sql = "select * from employee where admin_id= $login_user_id ";
  $q = $pdo->prepare($sql);
  $q->execute(array());      
  $row_d = $q->fetch(PDO::FETCH_ASSOC);

//   print_R($row_d);
//   exit();

  if(isSet($_POST["subimt"]))
  { 
    // echo "<pre>";
    // print_R($_POST);
    // exit();

    $employee_name = $_POST['employee_name'];
    $added_on = date('Y-m-d H-i-s');
    

    $employee_id = $_POST['employee_id'];


    // $sql = "select * from location where id = $_employeelocation_id ";
    // $q = $pdo->prepare($sql);
    // $q->execute(array());      
    // $row_loc = $q->fetch(PDO::FETCH_ASSOC);

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

    $password = $_POST['password'];
    $password = password_hash("$password", PASSWORD_BCRYPT);

    // if (!$row_d1)
    // {
      if ($_POST['password'] == $_POST['confirm_password'])
      {
    
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE  admin set login_password=?  WHERE admin_id =? ";
        $q = $pdo->prepare($sql);
        $q->execute(array($password, $admin_id));

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE employee set  password=?, edited_on=? WHERE admin_id =?";
        $q = $pdo->prepare($sql);
        $q->execute(array( $password, $added_on, $admin_id));
        // echo "<pre>";
        // print_r($sql);
        // exit();
        $isError = true;
            $error = "<span  style='color:green;'><b>Congrats:</b> New Password added successfully!</span>";
        }
        else {
            $isError = true;
            $error = "<span  style='color:red;'><b>ERROR:</b> Password doesn't matched with confirm password, please try again with the correct password..!!</span>";
            
            // print_r($error);
            // exit();
        }
        // } 
        // else {
        // $isError = true;
        //     $error = "<span  style='color:red;'><b>ERROR:</b> User ID already exist..!!</span>";
        //     // print_r($error);
        //     // exit();
        // }
    
    // header('location:view-employees');
     
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
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="d-flex align-items-center1 justify-content-center h-px-250">
                        <form action="#" method="post">
                          <input type="hidden" value="<?php echo $row_d['employee_id']; ?>" name="employee_id">
                          <div class="row g-4">
                            <div class="col-md-6" style="display:none;">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-country">Role</label>
                                <div class="col-sm-9 form-floating form-floating-outline">
                                  <select id="formtabs-country"  name="login_role" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true">
                                      <option value="" data-select2-id="18">Select Employee Role</option>
                                      <option value="CUSTOMER EXECUTIVE" <?php if($row_d['login_role']=="CUSTOMER EXECUTIVE"){echo"Selected = 'selected'";}?>>Customer Executive</option>
                                      <option value="SALES EXECUTIVE" <?php if($row_d['login_role']=="SALES EXECUTIVE"){echo"Selected = 'selected'";}?>>Sales Executive</option>
                                      <option value="LEADS GENERATOR" <?php if($row_d['login_role']=="LEADS GENERATOR"){echo"Selected = 'selected'";}?>>Leads Generator</option>
                                  </select>
                                    <label for="formtabs-country">Role</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"> Name</label>
                                <div class="col-sm-9 form-floating form-floating-outline">
                                  <input type="text" readonly name="employee_name" id="formtabs-username" class="form-control" value="<?php echo $row_d['employee_name']; ?>">
                                  
                                  <label for="formtabs-username">Name</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6" style="">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username">User ID</label>
                                <div class="col-sm-9 form-floating form-floating-outline">
                                  <input type="text" readonly name="user_id"  id="formtabs-username" class="form-control" value="<?php echo $row_d['user_id']; ?>">
                                  
                                  <label for="formtabs-username">User ID</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row form-password-toggle">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-password">Password</label>
                                <div class="col-sm-9 form-floating form-floating-outline">
                                  <!-- <div class="input-group input-group-merge"> -->
                                    <input type="password" name="password"  id="formtabs-password" class="form-control" placeholder="" aria-describedby="formtabs-password2" required>
                                    <!-- <span class="input-group-text cursor-pointer" id="formtabs-password2"><i class="ri-eye-off-line"></i></span> -->
                                    
                                  <label for="formtabs-password">Password</label>
                                  <!-- </div> -->
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row form-password-toggle">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-password"> Confirm Password</label>
                                <div class="col-sm-9 form-floating form-floating-outline">
                                    <input type="text" onkeyup="check_pass();" name="confirm_password"  id="confirm_password" value="" class="form-control" aria-describedby="formtabs-password2" required>
                                  <label for="formtabs-password">Confirm Password</label>
                                  <!-- </div> -->
                                  <?php if($isError){ 
                                      // $error = 'fgds';?>
                                      <span class="col-sm-12 text-center"><?php echo $error; ?></span>
                                    <!-- </div> -->
                                    <?php } ?>
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

      <script type="text/javascript">
        function check_pass()
        {
          $('#confirm_password').on('keyup', function () {
            if ($(this).val() == $('#password').val()) {
                $('#message').html('Password Matched').css('color', 'green');
                $('#submit').prop('disabled', false);

            } else {
              $('#message').html('Password MissMatch').css('color', 'red');
              $('#submit').prop('disabled', true);
            }
          });
        }
      </script>
    
  </body>
</html>
