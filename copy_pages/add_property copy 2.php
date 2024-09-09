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
    $builder_possession = $_POST['builder_possession'];
    $rera_possession = $_POST['rera_possession'];
    $added_on = date('Y-m-d H-i-s');
    $status = "Active";

    
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($_POST['varients'] as $index => $variant) {
        $location = $_POST['location'][$index];
        $area = $_POST['area'][$index];
        $price = $_POST['price'][$index];

        $sql = "INSERT INTO property(property_title, builder_name, varients, area, price, status, location,builder_possession,rera_possession, added_on) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($property_title, $builder_name, $variant, $area, $price, 'Active', $location,$builder_possession,$rera_possession, $added_on));
    }

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
              <h5 class="card-header mar-bot-10">Property Management</h5>
                <div class="card">
                    <h5 class="card-header"> Add Property </h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
              <form action="#" method="post">
                <div class="row g-4">
                  <div class="col-md-6">
                    <div class="row">
                      <label class="col-sm-3 col-form-label text-sm-end mar-top">Property Title</label>
                      <div class="col-sm-9">
                        <input type="text" name="property_title" class="form-control" placeholder="Property Title" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <label class="col-sm-3 col-form-label text-sm-end mar-top">Builder Name</label>
                      <div class="col-sm-9">
                        <input type="text" name="builder_name" class="form-control" placeholder="Builder Name" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <label class="col-sm-3 col-form-label text-sm-end mar-top">Possession By Builder</label>
                      <div class="col-sm-9">
                        <input type="text" name="builder_possession" class="form-control" placeholder="Possession By Builder" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <label class="col-sm-3 col-form-label text-sm-end mar-top">Possession By RERA </label>
                      <div class="col-sm-9">
                        <input type="text" name="rera_possession" class="form-control" placeholder="Possession By RERA" required>
                      </div>
                    </div>
                  </div>

                </div>

                <h5 class="card-header mt-4">Available Variants</h5>
                <div id="variants-container" >
                  <div class="row g-4 variant-item" style="margin-top:10px;">
                    <div class="col-md-3">
                      <label>Variants</label>
                      <!-- <input type="text" name="varients[]" class="form-control" placeholder="Variant" required> -->
                      <select id="formtabs-country"  name="varients[]" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
                        <option value="" data-select2-id="18">Select Variants</option>
                        <option value="1BHK">1 BHK</option>
                        <option value="2BHK">2 BHK</option>
                        <option value="2.5BHK">2.5 BHK</option>
                        <option value="3BHK">3 BHK</option>
                        <option value="3.5BHK">3.5 BHK</option>
                        <option value="4BHK">4 BHK</option>
                        <option value="4.5BHK">4.5 BHK</option>
                        <option value="5BHK">5 BHK</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label>Location</label>
                      <input type="text" name="location[]" class="form-control" placeholder="Location" required>
                    </div>
                    <div class="col-md-3">
                      <label>Area in sq ft</label>
                      <input type="text" name="area[]" class="form-control" placeholder="Area in sq ft" required>
                    </div>
                    <div class="col-md-3">
                      <label>Price quoted by builder</label>
                      <input type="text" name="price[]" class="form-control" placeholder="Price" required>
                    </div>
                  </div>
                </div>

                <button type="button" class="btn btn-primary mt-4" onclick="addVariant()">Add More</button>

                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="row justify-content-end">
                      <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary me-4 waves-effect waves-light" name="subimt">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary waves-effect">Cancel</button>
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
          function addVariant() {
              var container = document.getElementById('variants-container');
              var variantItem = document.querySelector('.variant-item');
              var clone = variantItem.cloneNode(true);
              container.appendChild(clone);
          }
      </script>
    
  </body>
</html>
