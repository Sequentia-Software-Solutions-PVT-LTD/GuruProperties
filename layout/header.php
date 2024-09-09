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
    </style>
    <!--  -->

    <?php 
        $admin_id = $_SESSION['login_user_id'];
        $login_name = $_SESSION['login_name'];
        $login_role = $_SESSION['login_role'];
        // print_r($_SESSION);
        // exit();

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
                      <img src="guru-logo-short.jpg" alt class="rounded-circle" style="height: 40px;width: 40px;"/>
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-2">
                            <div class="avatar avatar-online">
                              <!-- <img src="assets/img/avatars/1.png" alt class="rounded-circle" /> -->
                              <img src="guru-logo-short.jpg" alt class="rounded-circle" style="height: 40px;width: 40px;"/>
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
                      <div class="modal-content">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          <div class="modal-body text-center">
                              <h4 class="mb-2">Logout Confirmation</h4>
                              <p>Do you really want to log out now?</p>
                              <div class="d-flex justify-content-center gap-3">
                                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <!-- Button to redirect to logout -->
                                  <a href="dist/conf/signout.php" class="btn btn-danger">Logout</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- /Logout Confirmation Modal -->

          <!-- <script>
            $(document).on("click", ".open-myModal", function (e) {
                e.preventDefault();  // Prevent the default action

                var employee_id = $(this).data('employee_id');
                $("#employee_id").val(employee_id);  // Pass employee ID to the hidden input in the modal

                // Show the modal
                $("#enableOTP").modal('show');
            });
          </script> -->

          <!-- / Navbar -->