<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  if(isSet($_POST["subimt"]))
  { 
   

    $employee_name = $_POST['employee_name'];
    $user_id1 = $_POST['user_id'];
    $prefix = $_POST['prefix'];
    $_employeelocation = $_POST['_employeelocation'];
    $user_id = $prefix.$user_id1;

    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $password_post = $_POST['password'];
    $password = password_hash($password_post, PASSWORD_BCRYPT);
    // $assistant_login_id = $_POST['assistant_login_id'];
    $added_on = date('Y-m-d H-i-s');
    $status = "Active";
    $login_role = $_POST['login_role'];
    $login_photo = "default.png";
    $email_id = $_POST['email_id'];
    $cell_no = $_POST['cell_no'];

    $_employeelocation_id = $_POST['_employeelocation'];

    $sql = "select * from location where id = $_employeelocation_id ";
    $q = $pdo->prepare($sql);
    $q->execute(array());      
    $row_loc = $q->fetch(PDO::FETCH_ASSOC);

    $location_name = $row_loc['name'];
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `admin`(`login_name`, `login_password`, `login_role`, `login_id`, `status`,`type`, `login_photo`, `location`) VALUES (?,?,?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($employee_name, $password, $login_role, $user_id, $status, $login_role, $login_photo, $location_name));
    $lastInsertedId = $pdo->lastInsertId();

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO employee(admin_id, employee_name, password, added_on, status, login_role,  cell_no, user_id, email_id, designation, `location`, location_id) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($lastInsertedId, $employee_name, $password, $added_on, 'Active', $login_role,  $cell_no, $user_id,$email_id,'Employee', $location_name, $_employeelocation_id));

    // echo "<pre>";
    // print_r($sql);
    // exit();
    
    header('location:add_employee');
     
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

    <title> Add Employee  |  Guru Properties</title>

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
                    <h5 class="card-header">Add Employee</h5>
                    <div class="card-body">
                        <div class="d-flex align-items-center1 justify-content-center h-px-260">
                        <form class="card-body demo-vertical-spacing demo-only-element" action="#" method="post">
                          <div class="row g-4">
                            
                            <div class="col-md-6">
                                <div class="row align-items-center justify-content-center mb-6">
                                    <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-country">Role</label> -->
                                    <div class="col-sm-12 form-floating form-floating-outline">
                                        <!-- <div class="position-relative"> -->
                                            <select id="roleDropdown" name="login_role" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                                <option selected hidden disable>Select Employee Role</option>
                                                <option value="CUSTOMER EXECUTIVE">Customer Executive</option>
                                                <option value="SALES EXECUTIVE">Sales Executive</option>
                                            </select>
                                            <label for="roleDropdown">Role</label>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            <!-- </div>
                           
                            <div class="col-md-6"> -->
                              <div class="row align-items-center justify-content-center mb-6">
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <input type="text" name="employee_name" id="formtabs-username" class="form-control" placeholder="john doe" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required />
                                  <label for="formtabs-username"> Name</label>
                                </div>
                              </div>
                            <!-- </div>
                            <div class="col-md-6"> -->
                              <div class="row align-items-center justify-content-center mb-6">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-email">Email</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <!-- <div class="input-group input-group-merge"> -->
                                    <input type="email"  name="email_id"  id="formtabs-email" class="form-control" placeholder="@example.com">
                                    <label for="formtabs-email"> Email</label>
                                  <!-- </div> -->
                                </div>
                              </div>
                            <!-- </div>
                            <div class="col-md-6"> -->
                              <div class="row align-items-center justify-content-center mb-6">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-phone">Phone No</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <input type="text"  name="cell_no"  id="formtabs-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);">
                                  <label for="formtabs-phone"> Phone No</label>
                                </div>
                              </div>
                            <!-- </div>
                            <div class="col-md-6" > -->
                              <div class="row align-items-center justify-content-center mb-6">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username">User ID</label> -->
                              
                                <div class="col-sm-12 form-floating form-floating-outline" >
                                  <!-- <input type="text" name="prefix" id="prefixInput" class="prefix-class form-control" readonly style="width: 42px; border-right: none; border-top-right-radius: 0;border-bottom-right-radius: 0;padding-right: 0;"> -->
                                  <input type="text"  name="user_id"  id="formtabs-username" class="form-control" placeholder="" required>
                                  <label for="formtabs-username">User ID</label>
                                </div>
                              </div>
                            <!-- </div>
                            <div class="col-md-6"> -->
                              <div class="row align-items-center justify-content-center  mb-6 form-password-toggle">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-password">Password</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <!-- <div class="input-group input-group-merge"> -->
                                    <input type="password"  name="password"  id="formtabs-password" class="form-control" placeholder="*********" aria-describedby="formtabs-password2" required>
                                    <!-- <span class="input-group-text cursor-pointer" id="formtabs-password2"><i class="ri-eye-off-line"></i></span> -->
                                    <label for="formtabs-password">Password</label>
                                  <!-- </div> -->
                                </div>
                              </div>
                            </div>

                            <!-- <div class="col-md-6">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-sm-12 form-floating form-floating-outline">
                                        <select id="formtabs-location" name="_employeelocation[]" class="form-select" style="height: 400px;" data-allow-clear="true" data-select2-id="formtabs-location" tabindex="-1" aria-hidden="true" Multiple required>
                                                <option selected hidden disable>Select Location</option>
                                                <?php
                                                    $sqlLocation = "SELECT * FROM location order by name";
                                                    foreach($pdo->query($sqlLocation) as $LocationList) {
                                                      echo "<option style='margin-bottom: 8px;' value='".$LocationList["id"]."'>".$LocationList["name"]."</option>";
                                                    }
                                                ?>
                                                
                                            </select>
                                            <label for="formtabs-location">Location</label>
                                    </div>
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-sm-12 form-floating form-floating-outline">
                                        
                                            <select id="formtabs-location" name="_employeelocation" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                                <option value="" data-select2-id="18">Select Property Location Name</option>
                                                <?php
                                                    $sqlLocation = "SELECT * FROM  location order by name";
                                                    foreach ($pdo->query($sqlLocation) as $row) 
                                                    { 
                                                    ?>
                                                        <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option> 
                                                    <?php } ?>
                                            </select>
                                            <label for="formtabs-location">Location</label>
                                    </div>
                                </div>
                            </div>

                          </div>
                          <div class="row mt-10">
                            <div class="col-md-12 justify-content-end text-end">
                              <!-- <div class="row justify-content-end"> -->
                                <!-- <div class="col-sm-4"> -->
                                  <button type="submit" class="btn btn-primary me-4 waves-effect waves-light" name="subimt">Submit</button>
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
    
  </body>
</html>
