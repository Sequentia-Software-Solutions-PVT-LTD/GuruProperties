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
              <h5 class="card-header mar-bot-10">Property Management</h5>
                <div class="card">
                    <h5 class="card-header"> Add Property </h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="d-flex align-items-center1 justify-content-center h-px-500">
                        <form action="#" method="post">
                          <div class="row g-4">
                            
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end mar-top" for="formtabs-username"> Property Title</label>
                                <div class="col-sm-9">
                                  <input type="text" name="property_title" id="formtabs-username" class="form-control" placeholder="Property Title" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end mar-top" for="formtabs-username">Builder Name</label>
                                <div class="col-sm-9">
                                  <input type="text" name="builder_name" id="formtabs-username" class="form-control" placeholder="Builder Name" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                </div>
                              </div>
                            </div>

                            <h5 class="card-header"> Available Variants </h5>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-country">Variants</label>
                                <div class="col-sm-9">
                                  <div class="position-relative">
                                    <select id="formtabs-country"  name="varients" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true" required>
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
                                  <!-- <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="17" style="width: 383.9px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-formtabs-country-container"><span class="select2-selection__rendered" id="select2-formtabs-country-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select value</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
                                </div>
                                </div>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username">Location</label>
                                <div class="col-sm-9">
                                  <input type="text"  name="location"  id="formtabs-username" class="form-control" placeholder="Location">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username">Area in sq ft</label>
                                <div class="col-sm-9">
                                  <input type="text"  name="area"  id="formtabs-username" class="form-control" placeholder="Ex. 650 sq.ft">
                                </div>
                              </div>
                            </div>
                            

                            <div class="col-md-6">
                              <div class="row">
                                <label class="col-sm-3 col-form-label text-sm-end mar-top" for="formtabs-username">Price quoted by builder</label>
                                <div class="col-sm-9">
                                  <input type="text"  name="price"  id="formtabs-username" class="form-control" placeholder="Price quoted by builder">
                                </div>
                              </div>
                            </div>
                            
                          </div>
                          <div class="row mt-12">
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
