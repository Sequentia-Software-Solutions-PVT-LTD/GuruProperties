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

     <style>
        .mar-top {
            margin-top: -12px;
        }
        <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header image */
        .header {
            text-align: center;
        }

        .header img {
            max-width: 100%;
            height: auto;
        }

        /* To section (Client Name) */
        .client-info {
            margin-top: 30px;
        }

        .client-info p {
            text-align: left;
            font-size: 18px;
            margin-left: 0;
        }

        /* Table style */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* CE Details */
        .ce-details {
            margin-top: 50px;
        }

        .ce-details p {
            margin: 5px 0;
        }

        .signature {
            margin-top: 20px;
        }

        .signature img {
            width: 150px;
            height: auto;
        }

        /* Footer image */
        .footer {
            text-align: center;
            margin-top: 30px;
        }

        .footer img {
            max-width: 100%;
            height: auto;
        }

        /* Print page formatting */
        @media print {
            body {
                margin: 0;
                padding: 0;
                background-color: white;
            }
            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }
        }
    </style>
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
                    ?>
                    <div class="col-xl-12 col-lg-12 col-md-12 ">
                        <!-- About User -->
                        <div class="card mb-6">
                            <div class="card-body" style="display:flex; justify-content: space-around;">
                                <!-- <small class="card-text text-uppercase text-muted small">About</small> -->
                                <ul class="list-unstyled my-3 py-1" style="">
                                <small class="card-text text-uppercase text-muted small">About</small>
                                    <li class="d-flex align-items-center mb-4" style="margin-top: 20px;"><i class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">Client Name:</span> <span><?php echo $client_name; ?></span></li>
                                    <li class="d-flex align-items-center mb-4" style="margin-top: 20px;"><i class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">Property Name:</span> <span><?php echo $row_leads['property_title']; ?></span></li>
                                    <li class="d-flex align-items-center mb-4"><i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Location:</span> <span><?php echo $row_leads['location']; ?></span></li>
                                    <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Google Location Lat:</span> <span><?php echo $row_leads['google_location_lat']; ?></span></li>
                                   
                                    <!-- <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Budget Range:</span> <span><?php echo $row_leads['budget_range']; ?></span></li> -->
                                </ul>
                                
                                <ul class="list-unstyled my-3 py-1" style="">
                                <small class="card-text text-uppercase text-muted small" >Contacts</small>
                                    <li class="d-flex align-items-center mb-4" style="margin-top: 20px;"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Buildeer Name:</span> <span><?php echo $row_leads['builder_name']; ?></span></li>
                                    <li class="d-flex align-items-center mb-4"><i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Car Parking:</span> <span><?php echo $row_leads['car_parking']; ?></span></li>
                                    <li class="d-flex align-items-center mb-2"><i class="ri-money-rupee-circle-line ri-24px"></i><span class="fw-medium mx-2">Google Location Long:</span> <span><?php echo $row_leads['google_location_long']; ?></span></li>
                                </ul>
                                
                                <ul class="list-unstyled my-3 py-1" style="">
                                <small class="card-text text-uppercase text-muted small" style="margin-bottom:20px;">Other</small>
                                    <li class="d-flex align-items-center mb-4"  style="margin-top: 20px;"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Furnishing:</span> <span><?php echo $row_leads['furnishing']; ?></span></li>
                                    <li class="d-flex align-items-center mb-4"  style="margin-top: 20px;"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Amenities:</span> <span><?php echo $row_leads['amenities']; ?></span></li>
                                    <li class="d-flex align-items-center mb-4"  style="margin-top: 20px;"><i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">USP:</span> <span><?php echo $row_leads['USP']; ?></span></li>
                                    <!-- <li class="d-flex align-items-center mb-4"><i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Date:</span> <span><?php echo date("d-M-Y" , strtotime($row_leads['added_on'])); ?></span></li> -->
                                </ul>
                            </div>
                        </div>
                        <!--/ About User -->
                        
                    </div>
                </div>
                
               <!-- *************** - /main containt in page write here - **********************  -->
            </div>
            <!-- / Content -->

            <div class="container">

    <!-- Header Image -->
    <div class="header">
        <img src="header_image.jpg" alt="Header Image">
    </div>

    <!-- Client Information -->
    <div class="client-info">
        <p>To,<br>
           <strong>Client Name</strong><br>
           Client Address</p>
    </div>

    <!-- Table Section -->
    <table>
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
                <th>Column 3</th>
                <th>Column 4</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Row 1, Col 1</td>
                <td>Row 1, Col 2</td>
                <td>Row 1, Col 3</td>
                <td>Row 1, Col 4</td>
            </tr>
            <tr>
                <td>Row 2, Col 1</td>
                <td>Row 2, Col 2</td>
                <td>Row 2, Col 3</td>
                <td>Row 2, Col 4</td>
            </tr>
            <tr>
                <td>Row 3, Col 1</td>
                <td>Row 3, Col 2</td>
                <td>Row 3, Col 3</td>
                <td>Row 3, Col 4</td>
            </tr>
            <tr>
                <td>Row 4, Col 1</td>
                <td>Row 4, Col 2</td>
                <td>Row 4, Col 3</td>
                <td>Row 4, Col 4</td>
            </tr>
            <tr>
                <td>Row 5, Col 1</td>
                <td>Row 5, Col 2</td>
                <td>Row 5, Col 3</td>
                <td>Row 5, Col 4</td>
            </tr>
            <tr>
                <td>Row 6, Col 1</td>
                <td>Row 6, Col 2</td>
                <td>Row 6, Col 3</td>
                <td>Row 6, Col 4</td>
            </tr>
        </tbody>
    </table>

    <!-- CE Details -->
    <div class="ce-details">
        <p><strong>Customer Executive Name</strong></p>
        <p>ABC Company</p>
        <p>Company Address</p>
        <p>Contact No: 123-456-7890</p>

        <!-- Signature -->
        <div class="signature">
            <img src="signature_image.jpg" alt="Signature">
        </div>
    </div>

    <!-- Footer Image -->
    <div class="footer">
        <img src="footer_image.jpg" alt="Footer Image">
    </div>

</div>


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
    window.onload = function() {
        window.print();  // Automatically trigger print dialog when page loads
    }
</script>
    
      <script>
            $(document).on("click", ".open-myModal", function (e) 
            {
                e.preventDefault();
                var _self = $(this);
                var employee_id = _self.data('employee_id');
                $("#employee_id").val(employee_id);
                $(_self.attr('href')).modal('show');
            }); 
        </script>
  </body>
</html>
