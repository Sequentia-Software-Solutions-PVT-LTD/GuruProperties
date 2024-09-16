<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }

  include ('dist/conf/db.php');
  $pdo = Database::connect();

  $id = $_REQUEST['id'];
  $sql = "select * from property where id= $id ";
  $q = $pdo->prepare($sql);
  $q->execute(array());      
  $row_d = $q->fetch(PDO::FETCH_ASSOC);

  if(isSet($_POST["submit"]))
  { 
    $property_title = $_POST['property_title'];
    $builder_name = $_POST['builder_name'];
    $added_on = date('Y-m-d H-i-s');
    $status = "Active";
    $varients = $_POST['varients'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $id = $_POST['id'];
    $builder_possession = $_POST['builder_possession'];
    $rera_possession = $_POST['rera_possession'];

    // echo "<pre>";
    // print_r($_POST);
    // exit();

    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $sql = "INSERT INTO property(property_title, builder_name, varients, area, price, status,location, added_on) values(?,?,?,?,?, ?, ?, ?)";
    // $q = $pdo->prepare($sql);
    // $q->execute(array($property_title, $builder_name, $varients,  $area,  $price, 'Active',$location, $added_on));

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE property set property_title=?, builder_name=?, varients=?, area=?, price=?, location =?, builder_possession=?, rera_possession =? WHERE id =?";
    $q = $pdo->prepare($sql);
    $q->execute(array($property_title, $builder_name, $varients, $area, $price, $location,$builder_possession,$rera_possession, $id));

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

    <title>Edit Property |  Guru Properties</title>

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
                    <h5 class="card-header"> Edit Property </h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <!-- <div class="d-flex align-items-center1 justify-content-center h-px-500"> -->
                        <div class="d-flex align-items-center1 justify-content-center">
                        <form action="#" method="post">
                        <input type="hidden" value="<?php echo $row_d['id']; ?>" name="id">
                          <div class="row g-4">
                            
                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end mar-top" for="formtabs-username"> Property Title</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <input type="text" name="property_title" id="formtabs-username" class="form-control" placeholder="Property Title" value="<?php echo $row_d['property_title']; ?>">
                                  <label for="formtabs-username">Property Title</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end mar-top" for="formtabs-username">Builder Name</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <input type="text" name="builder_name" id="formtabs-username" class="form-control" placeholder="Builder Name"  value="<?php echo $row_d['property_title']; ?>">
                                  <label for="formtabs-username">Builder Name</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end mar-top">Possession By Builder</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <input type="text" id="builder_possession" name="builder_possession" class="form-control" placeholder="Possession By Builder" value="<?php echo $row_d['builder_possession']; ?>">
                                  <label for="builder_possession">Possession By Builder</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end mar-top">Possession By RERA </label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <input type="text" id="rera_possession1" name="rera_possession" class="form-control" placeholder="Possession By RERA" value="<?php echo $row_d['rera_possession']; ?>">
                                  <label for="rera_possession1">Possession By RERA</label>
                                </div>
                              </div>
                            </div>

                            <h5 class="card-header"> Available Variants </h5>

                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-country">Variants</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <!-- <div class="position-relative"> -->
                                    <select id="formtabs-country"  name="varients" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" data-select2-id="formtabs-country" tabindex="-1" aria-hidden="true">
                                      <option value="" data-select2-id="18">Select Variants</option>
                                      <option value="1BHK" <?php if($row_d['varients']=="1BHK"){echo"Selected = 'selected'";}?> >1 BHK</option>
                                      <option value="2BHK" <?php if($row_d['varients']=="2BHK"){echo"Selected = 'selected'";}?>>2 BHK</option>
                                      <option value="2.5BHK" <?php if($row_d['varients']=="2.5BHK"){echo"Selected = 'selected'";}?>>2.5 BHK</option>
                                      <option value="3BHK" <?php if($row_d['varients']=="3BHK"){echo"Selected = 'selected'";}?>>3 BHK</option>
                                      <option value="3.5BHK" <?php if($row_d['varients']=="3.5BHK"){echo"Selected = 'selected'";}?>>3.5 BHK</option>
                                      <option value="4BHK" <?php if($row_d['varients']=="4BHK"){echo"Selected = 'selected'";}?>>4 BHK</option>
                                      <option value="4.5BHK" <?php if($row_d['varients']=="4.5BHK"){echo"Selected = 'selected'";}?>>4.5 BHK</option>
                                      <option value="5BHK" <?php if($row_d['varients']=="5BHK"){echo"Selected = 'selected'";}?>>5 BHK</option>
                                    </select>
                                    <label for="formtabs-country">Variants</label>
                                  <!-- <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="17" style="width: 383.9px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-formtabs-country-container"><span class="select2-selection__rendered" id="select2-formtabs-country-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select value</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
                                <!-- </div> -->
                                </div>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username">country</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <input type="text"  name="location"  id="formtabs-username" class="form-control" placeholder="Location"  value="<?php echo $row_d['location']; ?>">
                                  <label for="formtabs-username">Location</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username">Area in sq ft</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <input type="text"  name="area" id="formtabs-username" class="form-control" placeholder="Ex. 650 sq.ft" value="<?php echo $row_d['area']; ?>">
                                  <label for="formtabs-username">Area in sq ft</label>
                                </div>
                              </div>
                            </div>
                            

                            <div class="col-md-6">
                              <div class="row">
                                <!-- <label class="col-sm-3 col-form-label text-sm-end mar-top" for="formtabs-username">Price quoted by builder</label> -->
                                <div class="col-sm-12 form-floating form-floating-outline">
                                  <input type="text"  name="price" id="formtabs-username" class="form-control" placeholder="Price quoted by builder"  value="<?php echo $row_d['price']; ?>">
                                  <label for="formtabs-username">Price quoted by builder</label>
                                </div>
                              </div>
                            </div>
                            
                          </div>
                          <!-- <div class="row mt-12">
                            <div class="col-md-12">
                              <div class="row justify-content-end">
                                <div class="col-sm-4">
                                  <button type="submit" class="btn btn-primary me-4 waves-effect waves-light" name="submit">Submit</button>
                                  <button type="reset" class="btn btn-outline-secondary waves-effect">Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div> -->

                          <div class="row mt-10">
                              <div class="col-md-12">
                                    <button type="submit"  data-bs-toggle="tooltip" data-bs-placement="left"  class="btn btn-success waves-effect waves-light d-flex float-right" name="submit">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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
