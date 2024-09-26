<?php
include ('dist/conf/db.php');
$pdo = Database::connect();

// start session
session_start();

// if login id in session is set either admin or super admin
if(isset($_SESSION['login_id']))
{
  header("Location: dashboard" );
}

$idAddress = $_SERVER['REMOTE_ADDR'];
// Niranjan, localhost, Amol, Amol, Amol, Amol, Gayatri
$allowedIps = array("223.185.41.36", "::1", "223.185.38.187", "150.129.168.103", "157.119.204.227", "157.119.204.196", "106.213.81.204");

// Temp removing the this IP check
// if(!in_array($idAddress, $allowedIps)) {
//   exit();
// }

// on login form submit 
if(isset($_POST["submit"]))
{ 
  $login_id = $_POST['login_id'];
  $password = $_POST['password'];
  $valid = true;

  $latitude = $_POST['latitude'];
  $longitude = $_POST['longitude'];
  $accuracy = $_POST['accuracy'];
  // print_r($_POST);
  // exit();

  if($valid)
  {
      $sql = "select * from admin where login_id=?";
      $q = $pdo->prepare($sql);
      $q->execute(array($login_id));      
      $data = $q->fetch(PDO::FETCH_ASSOC);
      if ($data)
      {
        $valid = true;
      }
      else 
      {
        $loginError = "Please enter correct login_id !";
        $warning ="";
        $valid = false;
      }

  }

  if ($valid)
  { 
    $sql = "select * from admin where login_id=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($login_id));      
    $data = $q->fetch(PDO::FETCH_ASSOC);
    if($data)
    {
      if($data['status'] != 'Active') {
        $loginError = "";
        $warning ="Your account is suspended";
      } else {
        if (password_verify($_POST['password'], $data['login_password']))
        {
            //if($data['login_role'] == 'ADMIN')
            //{
            
            if(1) {

              $_SESSION['login_user_id'] = $data['admin_id'];
              $_SESSION['login_name'] = $data['login_name'];
              $_SESSION['login_id'] = $data['login_id'];
              $_SESSION['login_status'] = $data['status'];
              $_SESSION['login_photo'] = $data['login_photo'];
              $_SESSION['login_role'] = $data['login_role'];
              $_SESSION['login_type'] = $data['type'];
            }
                
            //}
            $_SESSION['login_time'] = time();

            // ------------- add atendence ----------------------

            
                  $login_name = $_SESSION['login_name'];
                  $login_role = $_SESSION['login_role'];
                  $login_user_id = $_SESSION['login_user_id'];
                  $date = date('Y-m-d');
                  $time = date('H:i:s');
                  $added_on = date('Y-m-d H-i-s'); 
                  // $status = "Logged OUT";
                  $status="Logged In";
                  if($login_role == 'CUSTOMER EXECUTIVE' || $login_role == 'SALES EXECUTIVE')
                  {

                      //  print_r($_SESSION);
                      //  exit();

                      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $sql = "INSERT INTO `attendance`(`login_id`,`login_name`,`date`,`time`,`status`, `added_on`, `latitude`, `longitude`, `accuracy`) VALUES (?,?,?,?,?,?,?,?,?)";
                      $q = $pdo->prepare($sql);
                      $q->execute(array($login_user_id, $login_name, $date, $time, $status, $added_on, $latitude, $longitude, $accuracy));
              
                  }
              // ------------- add atendence ----------------------

            // echo "<pre>";
            // // print_r($_SESSION);
            // print_r($data);
            // exit();

            if($data['login_role'] == "LEAD GENERATOR") {
              header("Location:add-leads");
            }
            else if($data['type'] == "SUPERADMIN") {
              header("Location:dashboard_superadmin");
            }
            else if($data['login_role'] == "CUSTOMER EXECUTIVE") {
              header("Location:dashboard_CE");
            }
            else if($data['login_role'] == "SALES EXECUTIVE") {
              header("Location:dashboard_SE");
            }
            else {
              header("Location:dashboard");                    
            }
            // header("Location:index.php");                    
        }
        else
        {
            $loginError = "Please enter correct password !";
        }
      }
    }
    else 
    {
      $loginError = "Userid not found !";
    }
  } else {
    $loginError = "User ID not found !";
  }
}
?>

<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
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

    <title>Login | Guru Properties</title>

    <meta name="description" content="" />

    <?php //include ('layout/header_css.php');  ?>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>

    <style>
        .login-btn {
          background: #004040;
          border: 1px solid #004040;
        }
        .login-btn:hover {
            color: #b0810d !important;
            /* background-color: #5c61e6 !important; */
            /* border-color: #5c61e6 !important; */
            background: transparent !important;
            border: 1px solid #b0810d !important;
        }
    </style>
  </head>

  <body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
      <!-- Logo -->
      <!-- <a href="login" class="auth-cover-brand d-flex align-items-center gap-2">
        <span class="app-brand-logo demo">
          <span style="color: var(--bs-primary)">
            <img src="guru-logo-short.jpg" alt class="rounded-circle" style="height: 40px;width: 40px;"/>
          </span>
        </span>
        <span class="app-brand-text demo text-heading fw-semibold">Guru Properties</span>
      </a> -->
      <!-- /Logo -->
      <div class="authentication-inner row m-0">
        <!-- /Left Section -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-12 pb-2" style="background: #004040;">
          <!-- <img src="building.png" class="auth-cover-illustration w-100" alt="auth-illustration" style="height: 450px;" /> -->
          <img src="guru-logo-full.jpg" class="auth-cover-illustration w-100" alt="auth-illustration" style="height: 450px;" />
          
        </div>
        <!-- /Left Section -->

        <!-- Login -->
        <div
          class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-12 px-12 py-6">
          <div class="w-px-400 mx-auto pt-5 pt-lg-0">
            <h4 class="mb-1">Welcome to <br> <span style="color: #b68705;">Guru Properties!</span></h4>
            <p class="mb-5">Please sign-in to your account</p>

            <form  class="mb-5" action="login.php" method="post">
              <div class="form-floating form-floating-outline mb-5">
                <input type="text" class="form-control" id="email" name="login_id" placeholder="Enter your email or username" autofocus value="<?php if(isset ($_POST['login_id'])){ echo $_POST['login_id'];} ?>" required/>
                <!-- <input type="text" name="login_id" class="form-control" placeholder="User ID" value="<?php if(isset ($_POST['login_id'])){ echo $_POST['login_id'];} ?>" required style="padding-right: 12px;"> -->
                <label for="email">User ID</label>
              </div>
              <div class="mb-5">
                <div class="form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" value="<?php if(isset ($_POST['password'])){ echo $_POST['password'];} ?>" required />
                      <!-- <input type="password" name="password" class="form-control" placeholder="Password" value="<?php if(isset ($_POST['password'])){ echo $_POST['password'];} ?>" required style="padding-right: 12px;"> -->
                      <label for="password">Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                    <input type="hidden" id="long" name="longitude" />
                    <input type="hidden" id="lat" name="latitude" />
                    <input type="hidden" id="accuracy" name="accuracy" />
                  </div>
                </div>
              </div>
              
              <button class="btn btn-primary d-grid w-100 login-btn" type="submit" name="submit">Sign in</button>
            </form>

            <?php if((isset($loginError)) && $loginError != "") { ?>
            <div class="alert alert-solid-danger" role="alert">
              <?php echo $loginError; ?>
            </div>
            <?php } else if((isset($warning)) && $warning != "") { ?>
              <div class="alert alert-solid-warning" role="alert">
                  <?php echo $warning; ?>
              </div>
              <?php } ?>
          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
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
    <script src="assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/pages-auth.js"></script>
    <script type="text/javascript">
        initGeolocation();
        function initGeolocation()
        {
            window.setInterval(function(){
                navigator.geolocation.getCurrentPosition( success, fail );
            }, 1000);
        }

        function success(position)
        {   
                document.getElementById('long').value = position.coords.longitude;
                document.getElementById('lat').value = position.coords.latitude;
                document.getElementById('accuracy').value = position.coords.accuracy;
                document.getElementById('submit1').disabled  = false;
        }

        function fail()
        {
            // alert("Please enable your location and refresh the page, to login.");
            // alert("Sorry, your browser does not support geolocation services.");
            document.getElementById('long').value = "00.0000000";
            document.getElementById('lat').value = "00.0000000";
            document.getElementById('submit1').disabled  = true;
        }
        

</script>  
  </body>
</html>
