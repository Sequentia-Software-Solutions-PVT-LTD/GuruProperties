<!-- Menu -->

<?php
//  echo "customeer exec sidebar";
//   exit();
      $twvisit = 0;
      $ufleads = 0;
      $uv = 0;
      $tdv = 0;
      $tdf = 0;
      $rcvleads = 0;
      $cnvleads = 0;
      $dleads = 0;
      $aleads = 0;
      $admin_id = $_SESSION['login_user_id'];

    $tomorrow_date = date('Y-m-d', strtotime('+1 day'));
    $sql = "SELECT count(*) FROM assign_leads_sr where admin_id= $admin_id and DATE(visit_date) = '$tomorrow_date'";
    $result = $pdo->prepare($sql); 
    $result->execute(); 
    $twvisit = $result->fetchColumn(); 

$today_date = date('Y-m-d');
$sql = "SELECT count(*) FROM assign_leads_sr where admin_id= $admin_id and status='Followup' and transfer_status='Available' and DATE(next_date) > '$today_date'";
    $result = $pdo->prepare($sql); 
    $result->execute(); 
    $ufleads = $result->fetchColumn(); 

    $today_date = date('Y-m-d');
    $sql = "SELECT count(*) FROM assign_leads_sr WHERE admin_id = $admin_id and status = 'Active' And transfer_status='Available' AND DATE(visit_date) > '$today_date'";
    $q = $pdo->query($sql);
    $result = $pdo->prepare($sql); 
    $result->execute(); 
    $uv = $result->fetchColumn(); 
$today_date = date('Y-m-d');
$sql = "SELECT count(*) FROM assign_leads_sr where admin_id= $admin_id and status='Active' and transfer_status='Available' and DATE(visit_date) = '$today_date'  ";
    $result = $pdo->prepare($sql); 
    $result->execute(); 
    $tdv = $result->fetchColumn(); 

    $today_date = date('Y-m-d');
$sql = "SELECT count(*) FROM assign_leads_sr where admin_id= $admin_id and status='Followup' and transfer_status='Available'  and (DATE(next_date) = '$today_date' OR DATE(visit_date) = '$today_date')";
    $result = $pdo->prepare($sql); 
    $result->execute(); 
    $tdf = $result->fetchColumn(); 

    $sql = "SELECT count(*) FROM assign_leads_sr where admin_id = $admin_id and status = 'Active' and transfer_status='Available' and mark_dead='' 
    UNION
    SELECT count(*) FROM assign_leads_sr where admin_id = $admin_id and status = 'Transferred' and transfer_status='Available' and mark_dead=''";
    $result = $pdo->prepare($sql); 
    $result->execute(); 
    $rcvleads = $result->fetchColumn(); 

    $sql = "SELECT count(*) FROM assign_leads_sr where admin_id= $admin_id and status='Converted'";
    $result = $pdo->prepare($sql); 
    $result->execute(); 
    $cnvleads = $result->fetchColumn(); 

    $sql = "SELECT count(*) FROM assign_leads_sr where admin_id= $admin_id and status='Dead'";
    $result = $pdo->prepare($sql); 
    $result->execute(); 
    $dleads = $result->fetchColumn(); 

    $sql = "SELECT count(*) FROM assign_leads_sr where admin_id = $admin_id GROUP BY leads_id ORDER BY  edited_on, added_on";
    $result = $pdo->prepare($sql); 
    $result->execute(); 
    $aleads = $result->fetchAll(PDO::FETCH_ASSOC); 
    $aleads = count($aleads);

?>
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme-bg-dark text-white bg-dark-custom">
          <div class="app-brand demo">
            <a href="dashboard" class="app-brand-link">
              <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary)">
                  <img src="guru-logo-short.jpg" alt class="rounded-circle" style="height: 50px;width: 50px;"/>
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
            <!-- <li class="menu-item">
              <a href="dashboard.php" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-home-smile-line"></i>
                <div data-i18n="Dashboards">Dashboards</div>
              </a>
            </li> -->
            <li class="menu-item">
              <a href="dashboard_SE" class="menu-link">
                <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn="#">Dashboard</div>
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
                    <div data-i18nn   ="Preview">View Properties</div>
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
                    <div data-i18nn   ="Preview">View Property Towers</div>
                  </a>
                </li>
              </ul>
            </li>
            <!--  -->
            <!-- <li class="menu-header mt-5">
              <span class="menu-header-text" data-i18nn="Apps & Pages">Variants</span>
            </li> -->

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn="#"> Variant</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="add_property_varients.php" class="menu-link">
                    <div data-i18nn="List">Add Property Variant</div>
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

            <!--  -->
            <li class="menu-header mt-5">
              <span class="menu-header-text" data-i18nn="Apps & Pages">Leads</span>
            </li>

            <!-- <li class="menu-item">
              <a href="view_SE_assigned_leads.php" class="menu-link">
              <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn ="Preview">Assigned Leads</div>
              </a>
            </li> -->

            <li class="menu-item">
              <a href="view_tomorrow_leads_SE.php" class="menu-link">
              <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn ="Preview">Tomorrow's Visit</div>
                <div class="badge bg-danger rounded-pill ms-auto"><?php echo $twvisit; ?></div>
              </a>
            </li>

            <li class="menu-item">
              <a href="View_follow_up_leads_SE.php" class="menu-link">
              <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn ="Preview"> Upcoming Follow Up Leads</div>                
                <div class="badge bg-danger rounded-pill ms-auto"><?php echo $ufleads; ?></div>
              </a>
            </li>
            <li class="menu-item">
              <a href="upcomming_leads_SE.php" class="menu-link">
              <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn="List">Upcoming Visit</div>
                <div class="badge bg-danger rounded-pill ms-auto"><?php echo $uv; ?></div>
              </a>
            </li>
            <li class="menu-item">
              <a href="view_todays_leads_SE.php" class="menu-link">
              <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn ="Preview">Today's Visit</div>
                <div class="badge bg-danger rounded-pill ms-auto"><?php echo $tdv; ?></div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="view_Today’s_follow_up_leads_SE.php" class="menu-link">
              <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn ="Preview">Today's Follow Up</div>
                <div class="badge bg-danger rounded-pill ms-auto"><?php echo $tdf; ?></div>
              </a>
            </li>

            <li class="menu-item">
              <a href="received_leads_SE.php" class="menu-link">
              <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn ="Preview">Received Leads</div>
                <div class="badge bg-danger rounded-pill ms-auto"><?php echo $rcvleads; ?></div>
              </a>
            </li>

            <!-- <li class="menu-item">
              <a href="view_day_after_tomorrow_leads_SE.php" class="menu-link">
              <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn ="Preview">Day After Tomorrow's Leads</div>
              </a>
            </li> -->

            <li class="menu-item">
              <a href="view_converted_leads_SE.php" class="menu-link">
              <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn ="Preview">Converted Leads</div>
                <div class="badge bg-danger rounded-pill ms-auto"><?php echo $cnvleads; ?></div>
              </a>
            </li>

            <li class="menu-item">
              <a href="view_dead_leads_SE.php" class="menu-link">
              <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn ="Preview">Dead Leads</div>
                <div class="badge bg-danger rounded-pill ms-auto"><?php echo $dleads; ?></div>
              </a>
            </li>

            <li class="menu-item">
              <a href="all_leads_SE.php" class="menu-link">
              <i class="menu-icon tf-icons ri-bill-line"></i>
                <div data-i18nn ="Preview">All Leads</div>
                <div class="badge bg-danger rounded-pill ms-auto"><?php echo $aleads; ?></div>
              </a>
            </li>

          </ul>
        </aside>
        <!-- / Menu -->