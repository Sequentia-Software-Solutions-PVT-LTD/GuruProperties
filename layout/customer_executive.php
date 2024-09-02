<!-- Menu -->


<?php
//  echo "customeer exec sidebar";
//   exit();
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary)">
                  <img src="guru-logo-short.jpg" alt class="rounded-circle" style="height: 40px;width: 40px;"/>
                </span>
              </span>
              <div>
                <span class="app-brand-text demo menu-text fw-semibold ms-2"><?php echo $_SESSION['login_name']; ?></span>
                <br>
                <span class="app-brand-text demo menu-text fw-semibold ms-2"><?php echo $_SESSION['login_type']; ?></span>
              </div>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M8.47365 11.7183C8.11707 12.0749 8.11707 12.6531 8.47365 13.0097L12.071 16.607C12.4615 16.9975 12.4615 17.6305 12.071 18.021C11.6805 18.4115 11.0475 18.4115 10.657 18.021L5.83009 13.1941C5.37164 12.7356 5.37164 11.9924 5.83009 11.5339L10.657 6.707C11.0475 6.31653 11.6805 6.31653 12.071 6.707C12.4615 7.09747 12.4615 7.73053 12.071 8.121L8.47365 11.7183Z"
                  fill-opacity="0.9" />
                <path
                  d="M14.3584 11.8336C14.0654 12.1266 14.0654 12.6014 14.3584 12.8944L18.071 16.607C18.4615 16.9975 18.4615 17.6305 18.071 18.021C17.6805 18.4115 17.0475 18.4115 16.657 18.021L11.6819 13.0459C11.3053 12.6693 11.3053 12.0587 11.6819 11.6821L16.657 6.707C17.0475 6.31653 17.6805 6.31653 18.071 6.707C18.4615 7.09747 18.4615 7.73053 18.071 8.121L14.3584 11.8336Z"
                  fill-opacity="0.4" />
              </svg>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-home-smile-line"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                <!-- <div class="badge bg-danger rounded-pill ms-auto">5</div> -->
              </a>
            </li>

            <!--  -->
            <!-- <li class="menu-item">
              <a href="add-leads.php" class="menu-link">
                <div data-i18nn="List">Add Leads</div>
              </a>
            </li> -->
            <!--  -->

            <li class="menu-header mt-5">
              <span class="menu-header-text" data-i18nn="Apps & Pages">Location</span>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn="#">Location</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="add_location.php" class="menu-link">
                    <div data-i18nn="List">Add Location</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view_locations.php" class="menu-link">
                    <div data-i18nn="Preview">View Location</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Apps & Pages -->
            <!-- <li class="menu-header mt-5">
              <span class="menu-header-text" data-i18nn="Apps & Pages">Employee</span>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn="#">Employee</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="add_employee.php" class="menu-link">
                    <div data-i18nn="List">Add Employee</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view-employees.php" class="menu-link">
                    <div data-i18nn="Preview">View Employee</div>
                  </a>
                </li>
              </ul>
            </li> -->

            <!--  -->
            <li class="menu-header mt-5">
              <span class="menu-header-text" data-i18nn="Apps & Pages">Property</span>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn="#">Property</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="add_property_name.php" class="menu-link">
                    <div data-i18nn="List">Add Property</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view_properties_name.php" class="menu-link">
                    <div data-i18nn   ="Preview">View Property</div>
                  </a>
                </li>
              </ul>
            </li>
            <!--  -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn="#"> Tower</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="add_property_tower.php" class="menu-link">
                    <div data-i18nn="List">Add Property Tower</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view_properties_tower.php" class="menu-link">
                    <div data-i18nn   ="Preview">View Property Tower</div>
                  </a>
                </li>
              </ul>
            </li>
            <!--  -->
            <li class="menu-header mt-5">
              <span class="menu-header-text" data-i18nn="Apps & Pages">Variants</span>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn="#">Property Variants</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="add_property_varients.php" class="menu-link">
                    <div data-i18nn="List">Add Property Variants</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view_property_varients.php" class="menu-link">
                    <div data-i18nn   ="Preview">View Property Variants</div>
                  </a>
                </li>
              </ul>
            </li>

            <!--  -->

            <li class="menu-header mt-5">
              <span class="menu-header-text" data-i18nn="Apps & Pages">Leads</span>
            </li>

                <li class="menu-item">
                  <a href="assigned_leads.php" class="menu-link">
                  <i class="menu-icon tf-icons ri-bill-line"></i>
                    <div data-i18nn="List">Today's New Leads</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="received_leads.php" class="menu-link">
                  <i class="menu-icon tf-icons ri-bill-line"></i>
                    <div data-i18nn ="Preview">Received Leads</div>
                  </a>
                </li>
                <!-- <li class="menu-item">
                  <a href="transfer_leads.php" class="menu-link">
                    <div data-i18nn   ="Preview">Transfer Leads</div>
                  </a>
                </li> -->
                <!-- <li class="menu-item">
                  <a href="transfer_leads.php" class="menu-link">
                    <div data-i18nn   ="Preview">Transfered Leads</div>
                  </a>
                </li> -->
                <!-- <li class="menu-item">
                  <a href="todays_new_leads_CE.php" class="menu-link">
                    <div data-i18nn   ="Preview">Today's New Leads</div>
                  </a>
                </li> -->
                <li class="menu-item">
                  <a href="todays_followup_leads_CE.php" class="menu-link">
                  <i class="menu-icon tf-icons ri-bill-line"></i>
                    <div data-i18nn   ="Preview">Today's Followup Leads</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="upcomming_leads_CE.php" class="menu-link">
                  <i class="menu-icon tf-icons ri-bill-line"></i>
                    <div data-i18nn="List">Upcomming Leads</div>
                  </a>
                </li>
                <!-- <li class="menu-item">
                  <a href="past_leads_CE.php" class="menu-link">
                    <div data-i18nn="List">Past Leads</div>
                  </a>
                </li> -->
                <li class="menu-item">
                  <a href="dead_leads_CE.php" class="menu-link">
                  <i class="menu-icon tf-icons ri-bill-line"></i>
                    <div data-i18nn="List">Dead Leads</div>
                  </a>
                </li>
                <!-- <li class="menu-item">
                  <a href="trasnfered_leads_CE.php" class="menu-link">
                    <div data-i18nn="List">Transfered Leads</div>
                  </a>
                </li> -->
                <!-- <li class="menu-item">
                  <a href="assign_leads_to_sales_executive.php" class="menu-link">
                    <div data-i18nn="List">Assign Leads To Sales Executive</div>
                  </a>
                </li> -->

              <li class="menu-item">
                <a href="all_leads_CE.php" class="menu-link">
                <i class="menu-icon tf-icons ri-bill-line"></i>
                  <div data-i18nn ="Preview">All Leads</div>
                </a>
              </li>


          </ul>
        </aside>
        <!-- / Menu -->