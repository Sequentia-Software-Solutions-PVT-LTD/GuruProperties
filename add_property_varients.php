<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  if(isSet($_POST["submit"]))
  { 
    $property_name_id = $_POST['property_name_id'];
    $property_tower_id = $_POST['property_tower_id'];
    // $builder_name = $_POST['builder_name'];
    // $builder_possession = $_POST['builder_possession'];
    // $rera_possession = $_POST['rera_possession'];
    $added_on = date('Y-m-d H-i-s');
    $status = "Active";

    // $property_name_id = $row['property_name_id'];
    $sqlemp = "SELECT * FROM property_name where property_name_id = $property_name_id ";
    $q = $pdo->prepare($sqlemp);
    $q->execute(array());      
    $row_p = $q->fetch(PDO::FETCH_ASSOC);
    $property_title = $row_p['property_title'];

    // $property_name_id = $row['property_name_id'];
    $sqltov = "SELECT * FROM property_tower where property_tower_id = $property_tower_id ";
    $q = $pdo->prepare($sqltov);
    $q->execute(array());      
    $row_t = $q->fetch(PDO::FETCH_ASSOC);
    $property_tower_name = $row_t['property_tower_name'];


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($_POST['varients'] as $index => $variant) {
        // $location = $_POST['location'][$index];
        $area = $_POST['area'][$index];
        $price = $_POST['price'][$index];

        $sql = "INSERT INTO property_varients(property_name_id, property_tower_id, property_title, property_tower_name, varients, area, price, status, added_on) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($property_name_id, $property_tower_id, $property_title, $property_tower_name, $variant, $area, $price, 'Active', $added_on));
    }

    header('location:view_property_varients');
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

    <title>Add Property Variants |  Guru Properties</title>

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
              <h5 class="card-header mar-bot-10">Property Variants Management</h5>
                <div class="card">
                    <h5 class="card-header"> Add Property Variants </h5><hr class="m-0">
                    <div class="card-body demo-vertical-spacing demo-only-element">
                      <form action="#" method="post">
                        <div class="row my-9">

                          <!-- <div class="col-md-6">
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Title</label>
                              <div class="col-sm-9">
                                  <select id="roleDropdown" name="property_name_id" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                        <option value="" data-select2-id="18">Select Property Name</option>
                                        <?php
                                            $sql = "SELECT * FROM  property_name ";
                                            foreach ($pdo->query($sql) as $row) 
                                            { 
                                            ?>
                                                <option value="<?php echo $row['property_name_id']?>"><?php echo $row['property_title']?></option> 
                                            <?php } ?>
                                    </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Tower</label>
                              <div class="col-sm-9">
                                  <select id="roleDropdown" name="property_tower_id" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                                        <option value="" data-select2-id="18">Select Property Tower</option>
                                        <?php
                                            $sql = "SELECT * FROM  property_tower ";
                                            foreach ($pdo->query($sql) as $row) 
                                            { 
                                        ?>
                                              <option value="<?php echo $row['property_tower_id']?>"><?php echo $row['property_tower_name']?></option> 
                                            <?php } ?>
                                    </select>
                              </div>
                            </div>
                          </div> -->

                          <!--  -->

                          <div class="col-md-6">
                              <div class="row align-items-center justify-content-center">
                                  <!-- <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Title</label> -->
                                  <!-- <label class="text-sm-end">Property Title</label> -->
                                  <div class="col-sm-12 form-floating form-floating-outline">
                                      <select id="propertyDropdown" name="property_name_id" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" onchange="getTowersInfo(this.value)" required>
                                          <option value="">Select Property Name</option>
                                          <?php
                                              $sql = "SELECT * FROM property_name  where status = 'Active'";
                                              foreach ($pdo->query($sql) as $row) { 
                                                  echo '<option value="'.$row['property_name_id'].'">'.$row['property_title'].'</option>';
                                              }
                                          ?>
                                      </select>
                                      <label for="propertyDropdown"> Property Title</label>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="row align-items-center justify-content-center">
                                  <!-- <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Tower</label> -->
                                  <div class="col-sm-12 form-floating form-floating-outline">
                                      <select id="towerDropdown" name="property_tower_id" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" required>
                                          <option value="">Select Property Tower</option>
                                          <!-- Towers will be loaded here based on the selected property -->
                                      </select>
                                      <label for="towerDropdown"> Property Title</label>
                                  </div>
                              </div>
                          </div>

                          

                        </div>

                        
                        <div class="divider pt-8">
                          <div class="divider-text">Available Variants</div>
                        </div>
                        <div class="mb-5">

                            <div id="variants-container">
                              <div class="row align-items-center justify-content-center g-4 variant-item" style="margin-top:10px;">
                                
                                <div class="col-md-4 form-floating form-floating-outline">
                                  <!-- <label>Variants</label> -->
                                  <!-- <input type="text" name="varients[]" class="form-control" placeholder="Variant" required> -->
                                  <!--<select id="formtabs-country"  name="varients[]" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>-->
                                  <select id="formtabs-country1"  name="varients[]" class="form-select" required>
                                    <option value="" data-select2-id="18">Select Variants</option>
                                    <option value="1BHK">1 BHK</option>
                                    <option value="1.5BHK">1.5 BHK</option>
                                    <option value="2BHK">2 BHK</option>
                                    <option value="2.5BHK">2.5 BHK</option>
                                    <option value="3BHK">3 BHK</option>
                                    <option value="3.5BHK">3.5 BHK</option>
                                    <option value="4BHK">4 BHK</option>
                                    <option value="4.5BHK">4.5 BHK</option>
                                    <option value="5BHK">5 BHK</option>
                                  </select>
                                  
                                  <label for="formtabs-country1">Select Variants</label>
                                </div>

                                <div class="col-md-4 form-floating form-floating-outline">
                                  <!-- <label>Area in sq ft</label> -->
                                  <input type="text" name="area[]" id="area" class="form-control" placeholder="Area in sq ft" required>
                                  
                                  <label for="area">Area in sq ft</label>
                                </div>

                                <div class="col-md-4 form-floating form-floating-outline">
                                  <!-- <label>Price quoted by builder</label> -->
                                  <input type="text" name="price[]" id="price" class="form-control" placeholder="Price" required>
                                  
                                  <label for="price">Price quoted by builder</label>
                                </div>
                                
                              </div>
                            </div>

                        </div>
                        
                        <!-- <div class="row mt-4 border-top pt-5">
                          <div class="col-md-12">
                            <div class="text-right">
                                <button type="submit" data-bs-toggle="tooltip" data-bs-placement="left"  title="Click here to add above information" class="btn btn-primary me-4 waves-effect waves-light" name="submit">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary waves-effect float-left">Cancel</button>
                            </div>
                          </div>
                        </div> -->
                        <div class="row justify-content-start">
                            <div class="col-4">
                              <!-- <button type="button" class="btn btn-primary mt-4" onclick="addVariant()">+ Add</button> -->
                              <button type="button" onclick="addVariant();" class="btn btn-primary waves-effect waves-light repeater-add-btn">
                                <i class="ri-add-line me-1"></i>
                                <span class="align-middle">Add</span>
                              </button>
                            </div>
                        </div>

                        <div class="row mt-10">
                            <div class="col-md-12">
                                  <button type="submit"  data-bs-toggle="tooltip" data-bs-placement="left"  class="btn btn-success me-4 waves-effect waves-light d-flex float-right" name="submit"  title="Click here to add above information">Submit</button>
                                  <button type="reset" class="btn btn-outline-secondary waves-effect  d-flex float-left">Cancel</button>
                            </div>
                        </div>

                      </form>
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
          function addVariant() {
              var container = document.getElementById('variants-container');
              var variantItem = document.querySelector('.variant-item');
              var clone = variantItem.cloneNode(true);
              container.appendChild(clone);
          }
      </script>

<script>
    // document.getElementById('propertyDropdown').addEventListener('change', function() {
    //     var propertyId = this.value;

    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', 'fetch_towers.php', true);
    //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //     xhr.onreadystatechange = function() {
    //         if (xhr.readyState === 4 && xhr.status === 200) {
    //             document.getElementById('towerDropdown').innerHTML = xhr.responseText;
    //         }
    //     };
    //     xhr.send('property_id=' + encodeURIComponent(propertyId));
    // });
    function getTowersInfo (event) {
      console.log(event);
        var propertyId = event;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch_towers.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('towerDropdown').innerHTML = xhr.responseText;
            }
        };
        xhr.send('property_id=' + encodeURIComponent(propertyId));
    }
</script>
    
  </body>
</html>
