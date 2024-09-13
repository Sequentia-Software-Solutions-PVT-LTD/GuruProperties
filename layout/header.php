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
        .btn-success:hover, .btn-success:active, .btn-success.hover {
            background-color: #008d4c !important;
            border-color: #008d4c !important;
        }
        .form-floating > label {
          left: 15px;
        }

        thead, tbody, tfoot, tr, td, th {
          text-align: center;
        }
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
        .btn-success {
          background: #004040;
          border: 1px solid #004040;
        }
        .btn-success:hover {
            color: #b0810d !important;
            /* background-color: #5c61e6 !important; */
            /* border-color: #5c61e6 !important; */
            background: transparent !important;
            border: 1px solid #b0810d !important;
        }
        a,
        .menu-toggle::after,
        .app-brand .layout-menu-toggle svg path,
        a:hover {
          color: #d7d8ee;
          fill: #d7d8ee;
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
        
        // ------------------------- Performance Calulation ---------------------------------

        if($login_role == 'CUSTOMER EXECUTIVE')
        {
              // Correct query with placeholders
              $sqlsr = "SELECT COUNT(assign_leads_id) as total_count 
                        FROM assign_leads 
                        WHERE admin_id = $admin_id 
                        AND next_date = '$added_on' 
                        AND connection_status = 'connected'";
              $q = $pdo->prepare($sqlsr);
              $q->execute(array());
              $row_assign1 = $q->fetch(PDO::FETCH_ASSOC);

              $count_assign_leads = $row_assign1['total_count'];
              // --------------------------------------------------------
              if($count_assign_leads >= 50) {
                $percentage = "Today's score is 100%";
                $performance = "Your today's performance was Excellent";
                $img = "alertsuccess.png";
            } 
            elseif($count_assign_leads >= 37 && $count_assign_leads <= 49) {
                $percentage = "Today's score is 75%";
                $performance = "Your today's performance was Above Average";
                $img = "alert-warning.png";
            } 
            elseif($count_assign_leads <= 37) {
                $percentage = "Today's score is Below Average";
                $performance = "Your today's performance was Poor";
                $img = "alertred.png";
            } 
            else {
                $percentage = "0%";
                $performance = "Your today's performance was Bad";
                $img = "alertred.png";
            }
            $count_print = 'You have made'. $count_assign_leads .' calls today.';
    }

    if($login_role == 'SALES EXECUTIVE'){

          $percentage = "Logout Confirmation!";
          $performance = "Do you really want to log out now?";
          $img = "alertsuccess.png";
          $count_print = "";
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
                    <li>
                      <div class="d-grid px-4 pt-2 pb-1">
                        <a class="btn btn-sm btn-warning d-flex" href="reset_password.php" >
                          <small class="align-middle">Reset Password</small>
                          <i class="ri-user-settings-line ms-2 ri-16px"></i>
                        </a>
                      </div>
                    </li>
                    
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

          <!-- Logout Confirmation Modal -->
          <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-simple modal-dialog-centered">
                      <div class="modal-content" style="padding: 10px 0px; width:70%; margin:0 auto;">
                          <div class="modal-body text-center">
                              <img src="<?php echo $img; ?>" alt="Success" class="" style="width:100px;">

                              <h4 class="mb-2">  <?php echo $percentage; ?>  </h4>
                              <p> <?php echo $count_print; ?> </p>
                              <p> <?php echo $performance; ?> </p>
                              
                              <div class="d-flex justify-content-center gap-3">
                                  <form action="dist/conf/signout.php" method="POST">
                                    <input type="hidden" id="long_signout" name="longitude_signout" />
                                    <input type="hidden" id="lat_signout" name="latitude_signout" />
                                    <input type="hidden" id="accuracy_signout" name="accuracy_signout" />
                                    <button type="submit" name="logout" id="logout_button" class="btn btn-info login-btn">Submit Today's Report & Logout</button>
                                   </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- /Logout Confirmation Modal -->

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
                        document.getElementById('long_signout').value = position.coords.longitude;
                        document.getElementById('lat_signout').value = position.coords.latitude;
                        document.getElementById('accuracy_signout').value = position.coords.accuracy;
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
