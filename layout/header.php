<!-- Navbar -->

    <style>
        .template-customizer-open-btn {
            display:none !important;
        }
        .mar-bot-10 {
          margin-bottom:10px;
        }
        .container-p-y:not([class^=pt-]):not([class*=" pt-"]) {
            padding-top: 0rem !important;
        }
        .mar-top-10 {
          margin-top:10px;
        }
        .app-brand-text.demo {
          font-size:12px !important;
        }
        .logo-btn {
          color: #fff !important;
          background-color: #004040 !important;
          border-color: #004040 !important;
          /* box-shadow: 0 1px 10px 1px #004040 !important; */
        }
        .logo-btn:hover {
            background-color: #b0810d !important;
            border-color: #b0810d !important;
            box-shadow: 0 1px 10px 1px #b0810d !important;
            /* box-shadow: unset !important; */
        }
        .btn-success {
            background-color: #00a65a;
            border-color: #008d4c;
        }

        /* .btn-success:hover, .btn-success:active, .btn-success.hover {
            background-color: #008d4c ;
            border-color: #008d4c ;
        } */

        .form-floating > label {
          left: 15px;
        }

        /* thead, tbody, tfoot, tr, td, th {
          text-align: center;
        } */
        .float-right {
          float: right;
        }
        .float-left {
          float: left;
        }
        
        .text-right {
          text-align: right;
        }
        .w-max-content {
          width: max-content !important;
        }

        .btn-group .btn-success, .input-group .btn-success {
          border-left: 1px solid #ffffff !important;
          border-right: 1px solid #ffffff !important;
        }

        .btn-success {
          background: #004040;
          border: 1px solid transparent;
        }
        
        .btn-success.no-hover-effect:hover,
        .btn-success.no-hover-effect:active,
        .btn-success.no-hover-effect:focus
        {
            background-color: #004040 !important;
            border-color: transparent !important;
            color: #fff !important;
            border-left: 1px solid #ffffff !important;
            border-right: 1px solid #ffffff !important;
        }
        
        html:not([dir=rtl]) .btn-group > .btn-group:last-child > .btn:not([class*=btn-outline-]):last-of-type, html:not([dir=rtl]) .input-group > .btn:not([class*=btn-outline-]):last-of-type, html:not([dir=rtl]) :not(.btn-group):not(.input-group) > .btn-group > .btn:not([class*=btn-outline-]):last-of-type, html:not([dir=rtl]) .input-group > .btn-group:last-child > .btn:not([class*=btn-outline-]):last-of-type {
          border-right-color: #b0810d !important;
        }

        .btn-success:hover,
        .btn-success:active,
        .btn-check:active + .btn-success,
        .btn-check:checked + .btn-success,
        .btn-success.show.dropdown-toggle,
        .show > .btn-success.dropdown-toggle,
        .btn-success.active,
        .btn-success.hover {
            color: #b0810d !important;
            /* background-color: #5c61e6 !important; */
            /* border-color: #5c61e6 !important; */
            background: transparent !important;
            border: 1px solid #b0810d !important;
        }

        .bs-stepper.wizard-icons .bs-stepper-header .step .step-trigger {
          padding: 0.50rem !important;
          font-size: 16px;
        }

        a,
        .menu-toggle::after,
        .app-brand .layout-menu-toggle svg path,
        a:hover {
          color: #d7d8ee;
          fill: #d7d8ee;
        }

        
        .bs-stepper .step.active .bs-stepper-icon i,
        .bs-stepper .step.crossed .step-trigger .bs-stepper-icon i {
          color: #67e4e4 !important;
        }

        .bs-stepper.wizard-icons .bs-stepper-header .step-trigger .bs-stepper-icon i {
          font-size: 2.5rem;
        }

        .menu-vertical .menu-item .menu-link:hover {
            background-color: #000000;
        }
        .light-style .menu-vertical .menu-item.active > .menu-toggle, .light-style .menu-vertical .menu-item.open > .menu-toggle {
          background-color: #414141;
        }
        /* .menu-header .menu-header-text {
          color: #ffffff;
          font-weight: 800;
        } */
        /* html:not([dir=rtl]) .menu-inner > .menu-header::before {
          width: 100%;
        } */
        .bg-dark-custom {
          background-color: #282a42 !important;
          color: #d7d8ee
        }
        /* .form-floating > .form-control:focus ~ label, .form-floating > .form-control:not(:placeholder-shown) ~ label, .form-floating > .form-control-plaintext ~ label, .form-floating > .form-select ~ label
         */
        .table > :not(caption) > * > *
        {
          color: #000000 !important;
        }
        .card-body
        {
          color: #000000 !important;
        }
        .form-label, .col-form-label
        {
          color: #000000 !important;
        }
        .ri-survey-line1 {
          display: none;
        }
        .menu-link.active {
          background-color: #666cff !important;
          color: #ffffff;
        }

        @media(max-width: 767px) {
          .card-header.header-elements {
            justify-content: space-between;
          }
        }
    </style>
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
    <!--  -->

    <?php 
        $admin_id = $_SESSION['login_user_id'];
        $login_name = $_SESSION['login_name'];
        $login_role = $_SESSION['login_role'];
        $login_photo = $_SESSION['login_photo'];
        $added_on = date('Y-m-d');
        $today = date('Y-m-d');
        
        // ------------------------- Performance Calulation ---------------------------------

        if($login_role == 'CUSTOMER EXECUTIVE')
        {
              $sqlsr = "SELECT COUNT(assign_leads_id) as total_count 
                        FROM assign_leads 
                        WHERE admin_id = $admin_id 
                        AND (added_on = '$added_on' OR edited_on = '$added_on' OR next_date = '$added_on')
                        AND connection_status = 'connected'";
              $q = $pdo->prepare($sqlsr);
              $q->execute(array());
              $row_assign1 = $q->fetch(PDO::FETCH_ASSOC);

              $count_assign_leads = $row_assign1['total_count'];

              // echo "<pre>";
              // print_r($sqlsr);
              // print_r($row_assign1);
              // exit();

              // --------------------------------------------------------
              if($count_assign_leads >= 50) {
                $percentage = "Today's score is 100%";
                $performance = "Your today's performance was Excellent";
                $img = "alertsuccess.png";
            } 
            elseif($count_assign_leads >= 37 && $count_assign_leads <= 49) {
                $percentage = "Today's score is 75%";
                $performance = "Your today's performance was above average";
                $img = "alert-warning.png";
            } 
            elseif($count_assign_leads <= 37) {
                $percentage = "Today's score is Below average";
                $performance = "Your today's performance was Poor";
                $img = "alertred.png";
            } 
            else {
                $percentage = "0%";
                $performance = "Your today's performance was bad";
                $img = "alertred.png";
            }
            $count_print = 'You have made '. $count_assign_leads .' calls today.';
    }

    if($login_role == 'SALES EXECUTIVE')
    {
            // Calculate the dates for last week's Sunday and Saturday
            $last_sunday = date('Y-m-d', strtotime('last Sunday - 1 week'));
            $last_saturday = date('Y-m-d', strtotime('last Saturday'));

            // Query to get the count of converted leads from last Sunday to last Saturday
            $sql_converted = "
                SELECT COUNT(assign_leads_sr_id) AS total_count_converted
                FROM assign_leads_sr 
                WHERE admin_id = :admin_id
                AND (
                        added_on BETWEEN :last_sunday AND :last_saturday
                        OR edited_on BETWEEN :last_sunday AND :last_saturday
                    )
                AND status = 'Converted'
            ";

            $q = $pdo->prepare($sql_converted);
            $q->execute([
                ':admin_id' => $admin_id,
                ':last_sunday' => $last_sunday,
                ':last_saturday' => $last_saturday
            ]);

            $row_convert = $q->fetch(PDO::FETCH_ASSOC);
            $count_converted_leads = $row_convert['total_count_converted'];

            // echo "<pre>";
            // print_r($last_sunday);
            // print_r($last_saturday);
            // print_r($sql_converted);
            // print_r($count_converted_leads);
            // exit();

            // ----------------Conditions----------------------------------------
            if($count_converted_leads >= 2) {
              $percentage1 = "Last week's score is 100%";
              $performance1 = "Your performance was excellent";
              $img1 = "alertsuccess.png";
            } 
            elseif($count_converted_leads == 1) {
                $percentage1 = "Last week's score is 50%";
                $performance1 = "Your performance was average";
                $img1 = "alert-warning.png";
            } 
            elseif($count_converted_leads == 0) {
                $percentage1 = "Last week's score is 0%";
                $performance1 = "Your performance was poor";
                $img1 = "alertred.png";
            } 
            else {
                $percentage1 = "0%";
                $performance1 = "Your performance was bad";
                $img1 = "alertred.png";
            }
            $count_print_converted = 'You have made '. $count_converted_leads .' converts.';

        // *************----------------- Weekly count for visits------------------------------
            // $sql_visitedted = "
            //   SELECT COUNT(assign_leads_sr_id) AS total_count_visited
            //   FROM assign_leads_sr 
            //   WHERE admin_id = :admin_id
            //   AND (
            //           added_on BETWEEN :last_sunday AND :last_saturday
            //           OR edited_on BETWEEN :last_sunday AND :last_saturday
            //       )
            //   AND photo IS NOT NULL
            // ";

            // $q = $pdo->prepare($sql_visitedted);
            // $q->execute([
            //     ':admin_id' => $admin_id,
            //     ':last_sunday' => $last_sunday,
            //     ':last_saturday' => $last_saturday
            // ]);

            $sql_visitedted = "
                SELECT COUNT(assign_leads_sr_id) AS total_count_visited
                FROM assign_leads_sr 
                WHERE admin_id = :admin_id
                AND (
                    DATE(added_on) = :today
                    OR DATE(edited_on) = :today
                )
                AND photo IS NOT NULL
            ";

            $q = $pdo->prepare($sql_visitedted);
            $q->execute([
                ':admin_id' => $admin_id,
                ':today' => $today
            ]);

            $row_visited = $q->fetch(PDO::FETCH_ASSOC);
            $count_visited_leads = $row_visited['total_count_visited'];

            // echo "<pre>";
            // print_r($sql_visitedted);
            // print_r($q);
            // print_r($row_visited);
            // // print_r($count_converted_leads);
            // exit();

            // --------------- Conditions -----------------------------------------------
            // if($count_assign_leads >= 37 && $count_assign_leads <= 49) {
            if($count_visited_leads >= 20 && $count_visited_leads <= 25) {
              $percentage2 = "Today's score is 100%";
              $performance2 = "Your performance was excellent";
              $img2 = "alertsuccess.png";
            } 
            elseif($count_visited_leads >= 15 && $count_visited_leads <= 19) {
                $percentage2 = "Last week score is 75%";
                $performance2 = "Your performance was above average";
                $img2 = "alert-warning.png";
            } 
            elseif($count_visited_leads >= 1 && $count_visited_leads <= 12) {
              // elseif($count_visited_leads <= 12) {
                $percentage2 = "Today's score is 50%";
                $performance2 = "Your performance was average";
                $img2 = "alertred.png";
            } 
            else {
                $percentage2 = "0%";
                $performance2 = "Your performance was bad";
                $img2 = "alertred.png";
            }
            $count_print_visited = 'You have made '. $count_visited_leads .' visit.';


            // print_r($sql_visitedted);
            // print_r($row_visited);
            // exit();

    }


      // $percentage = "Below Average";
      // $performance = "Poor";
      // $img = "alertred.png";

        // print_r($sqlsr);
        // print_r($_SESSION);
        // // print_r($count_assign_leads);
        // exit();
        
        // ------------------------- /Performance Calulation ---------------------------------

    ?>
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="ri-menu-fill ri-22px"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              

              <ul class="navbar-nav flex-row align-items-center ms-auto">
               
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <!-- <img src="assets/img/avatars/1.png" alt class="rounded-circle" /> -->
                      <?php if($login_role == 'CUSTOMER EXECUTIVE' || $login_role == 'SALES EXECUTIVE') { ?>
                        <img src="assets/img/avatars/<?php echo $login_photo;?>" alt class="rounded-circle" style="height: 40px;width: 40px;"/>
                      <?php  } else { ?>
                      <img src="guru-logo-short.jpg" alt class="rounded-circle" style="height: 40px;width: 40px;"/>
                      <?php } ?>
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-2">
                            <div class="avatar avatar-online">
                              <!-- <img src="assets/img/avatars/1.png" alt class="rounded-circle" /> -->
                              <?php if($login_role == 'CUSTOMER EXECUTIVE' || $login_role == 'SALES EXECUTIVE') { ?>
                                <img src="assets/img/avatars/<?php echo $login_photo;?>" alt class="rounded-circle" style="height: 40px;width: 40px;"/>
                              <?php  } else { ?>
                                <img src="guru-logo-short.jpg" alt class="rounded-circle" style="height: 40px;width: 40px;"/>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block small"><?php echo $login_name; ?></span>
                            <small class="text-muted"><?php echo $login_role; ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-profile-user.html">
                        <i class="ri-user-3-line ri-22px me-3"></i><span class="align-middle">My Profile</span>
                      </a>
                    </li> -->
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <!-- <li>
                      <div class="d-grid px-4 pt-2 pb-1">
                        <a class="btn btn-sm btn-danger d-flex" href="dist/conf/signout.php" >
                          <small class="align-middle">Logout</small>
                          <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                        </a>
                      </div>
                    </li> -->
                    <li>
                        <div class="d-grid px-4 pt-2 pb-1">
                            <?php if($login_role == 'CUSTOMER EXECUTIVE' || $login_role == 'SALES EXECUTIVE') { ?>
                                <!-- Button to trigger the modal -->
                                <a class="btn btn-sm btn-danger d-flex open-myModal" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <small class="align-middle">Logout</small>
                                    <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                                </a>
                            <?php } else { ?>
                                <!-- Regular logout button -->
                                <a class="btn btn-sm btn-danger d-flex" href="dist/conf/signout.php">
                                    <small class="align-middle">Logout</small>
                                    <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                                </a>
                            <?php } ?>
                        </div>
                    </li>

                    <?php if($login_role == 'CUSTOMER EXECUTIVE' || $login_role == 'SALES EXECUTIVE') { ?>

                    <li>
                      <div class="d-grid px-4 pt-2 pb-1">
                        <a class="btn btn-sm btn-warning d-flex" href="reset_password.php" >
                          <small class="align-middle">Change Password</small>
                          <i class="ri-user-settings-line ms-2 ri-16px"></i>
                        </a>
                      </div>
                    </li>
                    <?php } ?>
                    
                  </ul>
                </li>
                <!--/ User -->

              </ul>
              
            </div>

            

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
                type="text"
                class="form-control search-input container-xxl border-0"
                placeholder="Search..."
                aria-label="Search..." />
              <i class="ri-close-fill search-toggler cursor-pointer"></i>
            </div>
          </nav>

          <?php if($login_role == 'CUSTOMER EXECUTIVE') { ?>
          <!-- Logout Confirmation Modal -->
          <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-simple modal-dialog-centered">
                      <div class="modal-content" style="padding: 10px 0px; width:100%; margin:0 auto;">
                          <div class="modal-body text-center">
                              <img src="<?php echo $img; ?>" alt="Success" class="" style="width:100px;">

                              <h4 class="mb-2">  &nbsp;<b><?php echo $percentage; ?> </b> </h4>
                              <p> &nbsp;<b><?php echo $count_print; ?> </b> </p>
                              <p> &nbsp;<b><?php echo $performance; ?> </b> </p>
                              
                              <div class="d-flex justify-content-center gap-3">
                                  <form action="dist/conf/signout.php" method="POST">
                                      <input type="hidden" id="long_signout" name="longitude_signout" />
                                      <input type="hidden" id="lat_signout" name="latitude_signout" />
                                      <input type="hidden" id="accuracy_signout" name="accuracy_signout" />
                                      <button type="submit" name="logout" id="logout_button" class="btn btn-success">Submit Today's Report & Logout</button>
                                   </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- /Logout Confirmation Modal -->
               <?php } ?>

                <?php if($login_role == 'SALES EXECUTIVE') { ?>
                    <!-- Logout Confirmation Modal -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-simple modal-dialog-centered">
                            <div class="modal-content" style="padding: 10px 0px; width:100%; margin:0 auto;">
                              <!--  -->
                              <div style="display:flex;flex-direction:row;">
                                <div class="modal-body text-center">
                                    <!-- <div class="swal2-icon swal2-info swal2-icon-show" style="display: flex;"><div class="swal2-icon-content">i</div></div>
                                    <img class="swal2-image" style=""> -->
                                    <img src="<?php echo $img1; ?>" alt="Success" class="" style="width:100px;">

                                    <h4 class="mb-2">  &nbsp;<b><?php echo $percentage1; ?> </b> </h4>
                                    <p> &nbsp;<b><?php echo $count_print_converted; ?> </b> </p>
                                    <p> &nbsp;<b><?php echo $performance1; ?> </b> </p>
                                    
                                    <div class="d-flex justify-content-center gap-3">
                                        <form action="dist/conf/signout.php" method="POST">
                                            <input type="hidden" id="long_signout" name="longitude_signout" />
                                            <input type="hidden" id="lat_signout" name="latitude_signout" />
                                            <input type="hidden" id="accuracy_signout" name="accuracy_signout" />
                                            <!-- <button type="submit" name="logout" id="logout_button" class="btn btn-success">Submit Today's Report & Logout</button> -->
                                        <!-- </form> -->
                                    </div>
                                </div>
                                <!--  -->
                                <div class="modal-body text-center">
                                    <img src="<?php echo $img2; ?>" alt="Success" class="" style="width:100px;">

                                    <h4 class="mb-2">  &nbsp;<b><?php echo $percentage2; ?> </b> </h4>
                                    <p> &nbsp;<b><?php echo $count_print_visited; ?> </b> </p>
                                    <p> &nbsp;<b><?php echo $performance2; ?> </b> </p>
                                    
                                    <div class="d-flex justify-content-center gap-3">
                                        <!-- <form action="dist/conf/signout.php" method="POST"> -->
                                            <input type="hidden" id="long_signout" name="longitude_signout" />
                                            <input type="hidden" id="lat_signout" name="latitude_signout" />
                                            <input type="hidden" id="accuracy_signout" name="accuracy_signout" />
                                            <!-- <button type="submit" name="logout" id="logout_button" class="btn btn-success">Submit Today's Report & Logout</button> -->
                                        
                                    </div>
                                    
                                </div>
                                </div>
                                <!--  -->
                                <div calss="col-12" style="text-align: center; padding-bottom: 30px;">
                                  <button type="submit" name="logout" id="logout_button" class="btn btn-success">Submit Today's Report & Logout</button>
                                  </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- /Logout Confirmation Modal -->
                  <?php } ?>

                    <!-- <div class="swal2-container swal2-center swal2-backdrop-show" style="overflow-y: auto;"><div aria-labelledby="swal2-title" aria-describedby="swal2-html-container" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: grid;"><button type="button" class="swal2-close" aria-label="Close this dialog" style="display: none;">×</button><ul class="swal2-progress-steps" style="display: none;"></ul><div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;"><div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                      <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                      <div class="swal2-success-ring"></div> <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                      <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                    </div>
                    <img class="swal2-image" style="display: none;">
                    <h2 class="swal2-title" id="swal2-title" style="display: block;">Good job!</h2>
                    <div class="swal2-html-container" id="swal2-html-container" style="display: block;">You clicked the button!</div>
                    <input id="swal2-input" class="swal2-input" style="display: none;">
                    <input type="file" class="swal2-file" style="display: none;">
                    <div class="swal2-range" style="display: none;">
                      <input type="range"><output></output>
                    </div><select id="swal2-select" class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label class="swal2-checkbox" style="display: none;"><input type="checkbox" id="swal2-checkbox"><span class="swal2-label"></span></label><textarea id="swal2-textarea" class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div><div class="swal2-actions" style="display: flex;"><div class="swal2-loader"></div><button type="button" class="swal2-confirm btn btn-primary waves-effect waves-light" aria-label="" style="display: inline-block;">OK</button><button type="button" class="swal2-deny" aria-label="" style="display: none;">No</button><button type="button" class="swal2-cancel" aria-label="" style="display: none;">Cancel</button></div><div class="swal2-footer" style="display: none;"></div><div class="swal2-timer-progress-bar-container"><div class="swal2-timer-progress-bar" style="display: none;"></div></div></div></div> -->

                

                <!-- / Navbar -->


          <script type="text/javascript">
                initGeolocation_signout();
                function initGeolocation_signout()
                {
                    window.setInterval(function(){
                        navigator.geolocation.getCurrentPosition( success_signout, fail_signout );
                    }, 1000);
                }

                function success_signout(position)
                {   
                  if( document.getElementById('long_signout') != null)
                      document.getElementById('long_signout').value = position.coords.longitude;
                  if( document.getElementById('lat_signout') != null)
                      document.getElementById('lat_signout').value = position.coords.latitude;
                  if( document.getElementById('accuracy_signout') != null)
                      document.getElementById('accuracy_signout').value = position.coords.accuracy;
                  if( document.getElementById('logout_button') != null)
                      document.getElementById('logout_button').disabled  = false;
                }

                function fail_signout()
                {
                    // alert("Please enable your location and refresh the page, to login.");
                    // alert("Sorry, your browser does not support geolocation services.");
                    document.getElementById('long_signout').value = "00.0000000";
                    document.getElementById('lat_signout').value = "00.0000000";
                    document.getElementById('accuracy_signout').value = "0";
                    document.getElementById('logout_button').disabled  = true;
                }
                

        </script> 
