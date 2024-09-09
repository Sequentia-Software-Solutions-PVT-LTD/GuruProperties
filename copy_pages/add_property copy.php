<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  if(isSet($_POST["subimt"]))
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

    <title>Add Property |  Guru Properties</title>

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
              <div class="col-xl-12 col-lg-12 col-md-12">
                <!-- Activity Timeline -->
                <div class="card card-action mb-6">
                  <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0"><i class="ri-survey-line ri-24px text-body me-4"></i>Add Property</h5>
                  </div>
                  <form action="#" method="post">
                    <div class="card-body demo-vertical-spacing demo-only-element pt-5x" style="padding-top: 0rem !important;">
                      <div class="row g-4">
                        <!-- Existing fields here -->
                        
                        <h5 class="card-header">Available Variants</h5>
                        
                        <div id="variantsWrapper">
                          <div class="variant-item">
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="variant_1">Variant</label>
                                <div class="col-sm-9">
                                  <input type="text" name="variants[]" id="variant_1" class="form-control" placeholder="Variant" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="area_1">Area in sq ft</label>
                                <div class="col-sm-9">
                                  <input type="text" name="area[]" id="area_1" class="form-control" placeholder="Area in sq ft" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row mt-3">
                          <div class="col-md-12">
                            <button type="button" id="addMore" class="btn btn-outline-primary">Add More</button>
                          </div>
                        </div>
                        
                        <!-- Other fields like location, price, etc. -->
                        
                        <div class="row mt-12">
                          <div class="col-md-12">
                            <div class="row justify-content-end">
                              <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary me-4 waves-effect waves-light" name="submit">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary waves-effect">Cancel</button>
                              </div>
                            </div>
                          </div>
                        </div>
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
  let variantCount = 1;
  
  document.getElementById('addMore').addEventListener('click', function() {
    variantCount++;
    const variantsWrapper = document.getElementById('variantsWrapper');
    
    const newVariant = document.createElement('div');
    newVariant.classList.add('variant-item');
    
    newVariant.innerHTML = `
      <div class="col-md-6">
        <div class="row">
          <label class="col-sm-3 col-form-label text-sm-end" for="variant_${variantCount}">Variant</label>
          <div class="col-sm-9">
            <input type="text" name="variants[]" id="variant_${variantCount}" class="form-control" placeholder="Variant" required>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <label class="col-sm-3 col-form-label text-sm-end" for="area_${variantCount}">Area in sq ft</label>
          <div class="col-sm-9">
            <input type="text" name="area[]" id="area_${variantCount}" class="form-control" placeholder="Area in sq ft" required>
          </div>
        </div>
      </div>
    `;
    
    variantsWrapper.appendChild(newVariant);
  });
</script>

    
  </body>
</html>
