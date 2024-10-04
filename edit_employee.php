<?php
  include_once ('dist/conf/checklogin.php'); 
  
  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  $locationNameArray = array();
//   $locationIDArray = array();
  
  $employee_id = $_REQUEST['employee_id'];
  $sql = "select * from employee where employee_id= $employee_id ";
  $q = $pdo->prepare($sql);
  $q->execute(array());      
  $row_d = $q->fetch(PDO::FETCH_ASSOC);

  if($row_d['login_role'] == "SALES EXECUTIVE"){
    
    $locationsIdString = $row_d['location_id'];
    $locationsIdArray = explode( ',', $locationsIdString);

    $locationCount = count($locationsIdArray);
    for ($i=0; $i < $locationCount; $i++) { 
      $locationId = $locationsIdArray[$i];
      
      $sql = "SELECT name,id FROM location WHERE id = '$locationId'";
      $q = $pdo->prepare($sql);
      $q->execute(array());
      $location_name = $q->fetch(PDO::FETCH_ASSOC);
      if($location_name != false ){
        $location_name  = $location_name['name'];
        // $location_id  = $location_name['id'];
        array_push($locationNameArray, $location_name);
        // array_push($locationIDArray, $location_id);
      }      
    }

    // $locationName = implode(",", $locationNameArray);
}

//   print_R($employee_id);
//   exit();

  if(isSet($_POST["submit"]))
  { 
    // echo "<pre>";
    // print_R($_POST);
    //   exit();

    $employee_name = $_POST['employee_name'];
    $added_on = date('Y-m-d H-i-s');
    $status = "Active";
    $login_role = $_POST['login_role'];
    // $login_photo = "default.png";
    $email_id = $_POST['email_id'];
    $cell_no = $_POST['cell_no'];
    $login_photo = $_POST['avatar'];
    $employee_id = $_POST['employee_id'];

    if(isset($_POST['_employeelocation'])) {
        $location_ids = implode(",", $_POST['_employeelocation']);
    } else {
        $location_ids ="";
    }
    // $location_ids = implode(",", $_POST['_employeelocation']);
    
    // $_employeelocation = $_POST['_employeelocation'];
    // $value = $_employeelocation[0];
    // $value = str_replace("{", "", $value);
    // $value = str_replace("}", "", $value);
    // $value = str_replace("[", "", $value);
    // $value = str_replace("]", "", $value);
    // $value = str_replace("\"", "", $value);
    // $locationNameArray = explode(",", $value);
    
    
    // $location_ids = "";
    // $locationIds = array();
    // if($login_role == "SALES EXECUTIVE"){
    //       $locationCount = count($locationNameArray);
    //       for ($i=0; $i < $locationCount; $i++) { 
    //         $value = explode(":", $locationNameArray[$i])[1];
            
    //         $location_id = 0;
    //         $locationId = $value;
    //         $sql = "SELECT id FROM location WHERE name  = '$locationId'";
    //         $q = $pdo->prepare($sql);
    //         $q->execute(array());
    //         $location_id = $q->fetch(PDO::FETCH_ASSOC);
    //         if($location_id != false ){
    //           $location_id  = $location_id['id'];
    //           array_push($locationIds, $location_id);
    //         }      
    //       }

    //       $location_ids = implode(",", $locationIds);
    // }


    // $sql = "select * from location where id = $_employeelocation_id ";
    // $q = $pdo->prepare($sql);
    // $q->execute(array());      
    // $row_loc = $q->fetch(PDO::FETCH_ASSOC);

    // $location_name = $row_loc['name'];
    $location_name = "";

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
    $sql = "UPDATE  admin set login_name=?, login_password=?,type=?, location=?, location_id=?, login_photo =? WHERE admin_id =?";
    $q = $pdo->prepare($sql);
    $q->execute(array($employee_name, $password, $login_role, $location_name, $location_ids, $login_photo, $admin_id));

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE employee set employee_name=?, password=?,cell_no=?, email_id=?, location=?, location_id=?, edited_on=?, login_photo = ? WHERE admin_id =?";
    $q = $pdo->prepare($sql);
    $q->execute(array($employee_name, $password, $cell_no, $email_id, $location_name, $location_ids, $added_on, $login_photo, $admin_id));
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
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="align-items-center1 justify-content-center h-px-260">
                        <form action="#" method="post" enctype="multipart/form-data">
                          <input type="hidden" value="<?php echo $row_d['employee_id']; ?>" name="employee_id">
                          <div class="row g-4">
                            
                            <div class="col-md-6">

                                    <div class="form-floating form-floating-outline mb-6">
                                        <select id="roleDropdown" name="login_role" data-minimum-results-for-search="Infinity" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" aria-hidden="true" required>
                                            <!-- <option selected hidden disable>Select Employee Role</option> -->
                                            <option value="CUSTOMER EXECUTIVE" <?php if($row_d['login_role']=="CUSTOMER EXECUTIVE"){echo"Selected = 'selected'";} ?>
                                             >Customer Executive</option>
                                            <option value="SALES EXECUTIVE" <?php if($row_d['login_role']=="SALES EXECUTIVE"){echo"Selected = 'selected'";} ?>
                                             >Sales Executive</option>
                                        </select>
                                        <label for="roleDropdown">Role</label>
                                    </div>

                                    <div class="form-floating form-floating-outline mb-6">
                                      <input type="text" value="<?php echo $row_d['employee_name']; ?>" name="employee_name" id="formtabs-username" class="form-control" placeholder="john doe" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required />
                                      <label for="formtabs-username"> Name</label>
                                    </div>
                                   
                                    <div class="form-floating form-floating-outline mb-6">
                                      <input type="text" value="<?php echo $row_d['user_id']; ?>" name="user_id"  id="prefixInput" class="form-control" placeholder="" required>
                                      <label for="prefixInput">User ID</label>
                                    </div>

                                    <div class="form-floating form-floating-outline mb-6">
                                      <input type="text"  name="password"  id="password" class="form-control" aria-describedby="formtabs-password2">
                                      <label for="formtabs-password">Password</label>
                                      <span id='message'></span>
                                    </div>
                            </div>

                            <div class="col-md-6">

                                      <div class="form-floating form-floating-outline mb-6">
                                        <input type="email"  value="<?php echo $row_d['email_id']; ?>" name="email_id"  id="formtabs-email" class="form-control" placeholder="@example.com"  required>
                                        <label for="formtabs-email"> Email</label>
                                      </div>
                                     
                                      <div class="form-floating form-floating-outline mb-6">
                                        <input type="text" value="<?php echo $row_d['cell_no']; ?>"  name="cell_no"  id="formtabs-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);">
                                        <label for="formtabs-phone"> Phone No</label>
                                      </div>
                                      
                                      <div class="form-floating form-floating-outline mb-6" id="se_locations" <?php echo $row_d['login_role'] != "SALES EXECUTIVE" ?  'style="display:none;"' : ""; ?> >
                                                  <!--<input-->
                                                  <!--    id="multipleLocations"-->
                                                  <!--    name="_employeelocation[]"-->
                                                  <!--    class="form-control h-auto"-->
                                                  <!--    placeholder="Select Locations"-->
                                                  <!--    value="<?php //echo implode(",", $locationNameArray) ?>" -->
                                                  <!--/>-->
                                               <select id="formtabs-locationse" name="_employeelocation[]" <?php echo $row_d['login_role'] == "SALES EXECUTIVE" ?  'required' : ""; ?>  class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" multiple="multiple"> 
                                                    <?php
                                                       $sqlLocation = "SELECT * FROM  location order by name";
                                                       foreach ($pdo->query($sqlLocation) as $row) 
                                                       { $selected ="";  if(in_array($row['name'], $locationNameArray)) $selected = "selected";
                                                      ?>
                                                           <option <?php echo $selected; ?> value="<?php echo $row['id']?>"><?php echo $row['name']?></option>  
                                                      <?php } ?>
                                               </select> 
                                              <label for="formtabs-locationse">Location</label>
                                      </div>
                                      <div class="form-floating form-floating-outline mb-6" id="ce_locations" style="display:none;">
                                                <select id="formtabs-locationce" name="_employeelocationce[]" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country-ce" tabindex="-1" aria-hidden="true">
                                                    <option value="" data-select2-id="18">Select Property Location</option>
                                                    <?php
                                                        $sqlLocation = "SELECT * FROM  location order by name";
                                                        foreach ($pdo->query($sqlLocation) as $row) 
                                                        { 
                                                        ?>
                                                            <option <?php echo $selected; ?> value="<?php echo $row['id']?>"><?php echo $row['name']; ?></option> 
                                                        <?php } ?>
                                                </select>
                                                <label for="formtabs-locationce">Location</label>
                                      </div>

                                        <div class="form-floating form-floating-outline mb-6">
                                            <?php                                     
                                            if(isset($isError) && $isError != "") { ?>                                       
                                              <span class="col-sm-12 text-center"><?php echo $error; ?></span>
                                            <?php } ?>
                                        </div>
                                </div>

                                <div class="col-md-1 col-sm-6 align-self-center">
                                  <small class="text-light fw-medium">Select Avatar</small>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="d-flex avatar-group my-4">
                                    <!-- Avatar 1 -->
                                    <div class="avatar d-flex" style="width: 100px;">
                                      <input type="radio" name="avatar" id="avatar1" <?php echo $row_d['login_photo'] == "5.png" ? 'checked' : ''; ?> value="5.png" required>
                                      <label for="avatar1" style="margin-left: 10px;">
                                        <img src="assets/img/avatars/5.png" alt="Avatar 1" class="rounded-circle pull-up" style="cursor:pointer;">
                                      </label>
                                    </div>
                                    <!-- Avatar 2 -->
                                    <div class="avatar d-flex" style="width: 100px;">
                                      <input type="radio" name="avatar" id="avatar2" <?php echo $row_d['login_photo'] == "12.png" ? 'checked' : ''; ?> value="12.png" required>
                                      <label for="avatar2" style="margin-left: 10px;">
                                        <img src="assets/img/avatars/12.png" alt="Avatar 2" class="rounded-circle pull-up" style="cursor:pointer;">
                                      </label>
                                    </div>
                                    <!-- Avatar 3 -->
                                    <div class="avatar d-flex" style="width: 100px;">
                                      <input type="radio" name="avatar" id="avatar3" <?php echo $row_d['login_photo'] == "6.png" ? 'checked' : ''; ?> value="6.png" required>
                                      <label for="avatar3" style="margin-left: 10px;">
                                        <img src="assets/img/avatars/6.png" alt="Avatar 3" class="rounded-circle pull-up" style="cursor:pointer;">
                                      </label>
                                    </div>
                                    <!-- Avatar 4 -->
                                    <div class="avatar d-flex" style="width: 100px;">
                                      <input type="radio" name="avatar" id="avatar4" <?php echo $row_d['login_photo'] == "10.png" ? 'checked' : ''; ?> value="10.png" required>
                                      <label for="avatar4" style="margin-left: 10px;">
                                        <img src="assets/img/avatars/10.png" alt="Avatar 4" class="rounded-circle pull-up" style="cursor:pointer;">
                                      </label>
                                    </div>
                                  </div>
                                </div>
                            
                          </div>
                          <div class="row mt-10">
                            <div class="col-md-12 justify-content-end text-end">
                                  <button type="submit" class="btn btn-success me-4 waves-effect waves-light d-flex float-right" name="submit">Submit</button>
                                  <button type="button" onlclick="" class="btn btn-outline-secondary waves-effect  d-flex float-left">Cancel</button>
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
                selocations = document.getElementById("se_locations");
                celocations = document.getElementById("ce_locations");
                
                locationse = document.getElementById("formtabs-locationse");
                locationce = document.getElementById("formtabs-locationce");
                
                if (selectedRole === 'CUSTOMER EXECUTIVE') {
                    prefix = 'CE';
                    selocations.style.display = "none";
                    celocations.style.display = "none";
                    locationce.required = false;
                    locationse.required = false;
                } else if (selectedRole === 'SALES EXECUTIVE') {
                    prefix = 'SE';
                    selocations.style.display = "block";
                    celocations.style.display = "none";
                    locationce.required = false;
                    locationse.required = true;
                }

                // Set the prefix in the input field
                $('#prefixInput').val(prefix + '-');
            });
        });
        
        var locationList = ["Aundh","Baner","Bavdhan","Hadapsar","Hinjewadi","Kalyani Nagar","Kharadi","Koregaon Park","Magarpatta City","Model Colony","NIBM Road","Shivaji Nagar","Viman Nagar","Wagholi","Wakad"];
        $.ajax({
            type: "POST",
            url: 'locations.php',
            data: ({ issession : 1}),
            dataType: "html",
            success: function(data) {
              locationList = data;
            },
            error: function() {
                alert('Error occured');
            }
        });

        // setTimeout(
          // function test() {

            const multipleLocationsElement = document.querySelector('#multipleLocations');
            // console.log(locationList);
            const whitelist = locationList;
            // Inline
            let TagifyCustomInlineSuggestionLocations = new Tagify(multipleLocationsElement, {
              whitelist: whitelist,
              maxTags: 10,
              dropdown: {
                maxItems: 20,
                classname: 'tags-inline',
                enabled: 0,
                closeOnSelect: false
              }
            });
          // }
        // , 2000);
      </script>
  </body>
</html>
