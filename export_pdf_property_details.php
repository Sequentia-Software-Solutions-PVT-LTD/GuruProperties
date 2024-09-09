<?php
  include_once ('dist/conf/checklogin.php'); 

  // if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
  //   header('location:dashboard');
  // }


  include ('dist/conf/db.php');
  $pdo = Database::connect();

  if(isSet($_POST["suspend"]))
  { 
    // echo "<pre>";
    // print_r($_POST);
    // exit();

    $property_name_id = $_POST['employee_id'];
    $client_name = $_POST['client_name'];

    $sql_query = "SELECT * from property_name WHERE property_name_id = $property_name_id";
    // $pdata = $pdo->prepare($sql_query);
    // $pdata->execute();
    // $results = $pdata->fetch(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($results);
    // exit();
    
    // header('location:view_properties_name');
     
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

    <title> Export PDF Property Details |  Guru Properties</title>

    <meta name="description" content="" />

    <!-- *********** header******************  -->
    <?php include 'layout/header_js.php'; ?>
     <!-- *********** /header******************  -->

    <!-- Include your CSS here -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Header Image */
        .header-img {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-img img {
            width: 100%; /* Adjust as needed */
        }

        /* Table for property details */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
          
        }

        table, th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Footer section */
        .footer-img {
            text-align: center;
            margin-top: 30px;
        }

        .footer-img img {
            width: 100%; /* Adjust as needed */
            height:20px;
        }

        /* Footer with executive details */
        .footer-details {
            margin-top: 20px;
        }

        .footer-details p {
            margin: 5px 0;
        }

        .client-info, .executive-info {
            margin-bottom: 20px;
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
              <h5 class="card-header mar-bot-10">Property Details</h5>
              <!-- <hr class="my-12"> -->
                <div class="row">
                    <?php 
                        $pdata = $pdo->prepare($sql_query);
                        $pdata->execute();
                        $row_leads = $pdata->fetch(PDO::FETCH_ASSOC);

                        $admin_id = $_SESSION['login_user_id'];
                        $sql_admin = "SELECT * from employee WHERE admin_id = $admin_id";
                        $pdata = $pdo->prepare($sql_admin);
                        $pdata->execute();
                        $results_admin = $pdata->fetch(PDO::FETCH_ASSOC);

                        $contact = $results_admin['cell_no'];

                        
                        // echo "<pre>";
                        // print_R($row_leads);
                        // print_R($_SESSION);
                        // exit();
                    ?>
                    <div class="col-xl-12 col-lg-12 col-md-12 ">
                        <!-- About User -->
                        <div class="card mb-6">
                            <div class="card-body" style="">
                                <!-- <small class="card-text text-uppercase text-muted small">About</small> -->
                                <div class="header-img">
                                    <img src="header-img.jpg" alt="Header Image">
                                </div>

                                <!-- Client Information -->
                                <div class="client-info">
                                    <h6>To, <br> <?php echo $client_name; ?></h6>
                                </div>
                                <br>

                                <!-- Property Details Table -->
                                <table>
                                    <tr>
                                        <th>Title</th>
                                        <th>Details</th>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td>Property Name</td>
                                        <td><?php echo $row_leads['property_title']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Location</td>
                                        <td><?php echo $row_leads['location']; ?></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>Google Location Lat</td>
                                        <td><?php echo $row_leads['google_location_lat']; ?></td>
                                        
                                        
                                    </tr>
                                    <tr>
                                        <td>Google Location Long</td>
                                        <td><?php echo $row_leads['google_location_long']; ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Buildeer Name</td>
                                        <td><?php echo $row_leads['builder_name']; ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Car Parking</td>
                                        <td><?php echo $row_leads['car_parking']; ?></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>Furnishing</td>
                                        <td><?php echo $row_leads['furnishing']; ?></td>
                                        
                                    </tr>
                                    <tr>
                                       
                                        <td>Amenities</td>
                                        <td><?php echo $row_leads['amenities']; ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>USP</td>
                                        <td colspan="1"><?php echo $row_leads['USP']; ?></td>
                                    </tr>
                                </table>

                                <!-- Footer with Customer Executive Details -->
                                <div class="footer-details">
                                  <br>
                                    <h6>From,</h6>
                                    <p> <?php echo $_SESSION['login_name'] ?></p>
                                    <p>401, Koyna, Mohan Nagar,</p>
                                    <p>Baner, Pune, Maharashtra - 411045.</p>
                                    <p>Contact No: <?php echo $contact; ?></p>
                                </div>

                                <!-- Footer Image -->
                                <div class="footer-img">
                                    <img src="footer-img.jpg" alt="Footer Image">
                                </div>

                                    </div>
                                </div>

                        
                        <!--/ About User -->
                        
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
        // For print functionality
        window.onload = function () {
            window.print();
        };
    </script>

  </body>
</html>
