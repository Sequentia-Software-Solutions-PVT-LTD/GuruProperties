<?php
	session_start();

	//Session Validation
	if (isset($_SESSION['login_id']))
	{
		//if((time() - $_SESSION['login_time']) > 600000) // Time in Seconds
		//{

			// unset($_SESSION['login_photo']);
			// unset($_SESSION['login_name']);
			// unset($_SESSION['login_id']);
			// unset($_SESSION['login_role']);
			// unset($_SESSION['login_time']);

			// $_SESSION = array();
			// if (ini_get("session.use_cookies")) {
			//     $params = session_get_cookie_params();
			//     setcookie(session_name(), '', time() - 42000,
			//         $params["path"], $params["domain"],
			//         $params["secure"], $params["httponly"]
			//     );
			// }
			
			// session_destroy();
			// $redirect = $_SERVER['REQUEST_URI'];
			// header("location:login?redirect=$redirect");
		//}
		//else
		//{
			$_SESSION['login_time'] = time();
			//Segregation
			{

				$curPageName = basename($_SERVER['PHP_SELF'], '.php');

				$adminAllowedPages = array(
					"dashboard",
					"fetch_towers",
					"fetch_variants",
					"login",
				);

				$superadminAllowedPages = array(
					"add_employee",
					"dashboard",
					"edit_employee",
					"login",
					"view-employees",
					"admin_request_leads_by_CE",
					"admin_request_leads_by_SE",
					"transfer_lead_by_SE_to_SE",
					"timeline",
					"dashboard_superadmin",
					"dashboard_CE",
					"dashboard_SE",
					"attendance_report",

					"report_design_sample",
					"report_lead",
					"report_converted_all",
					"report_converted_separated",
					"report_sold_properties",

					"report_summary",
					"report_CE_freshleads",
					"report_CE_assignedleads",
					"report_CE_followupleads",
					"report_CE_transferredleads",
					"report_CE_deadleads",
					"report_SE_dead",
					"report_summary_SE",
					"report_SE_converted",
					"report_SE_received",
					"report_SE_transferToCE",
					"report_SE_transferToSE",
					"report_SE_visited",
					"pdf_export_report_attendance"
				);

				$CEAllowedPages = array(
					"add_property_name",
					"add_property_name_design",
					"add_property_tower",
					"add_property_varients",
					"all_leads_CE",
					"assigned_leads",
					"assign_leads_to_sales_executive",
					"dashboard",
					"dead_leads_CE",
					"edit_employee",
					"edit_property",
					"fetch_towers",
					"fetch_variants",
					"login",
					"past_leads_CE",
					"received_leads",
					"suspend_employee",
					"suspend_property",
					"timeline",
					"todays_followup_leads_CE",
					"todays_new_leads_CE",
					"transfer_assigned_lead",
					"transfer_leads",
					"trasnfered_leads_CE",
					"upcomming_leads_CE",
					"view-employees",
					"view-properties",
					"view_assigned_lead",
					"view_properties_name",
					"view_properties_tower",
					"view_property_varients",
					"view_leads_for_assigned_SE",
					"add_location",
					"view_locations",
					"export_pdf_property_details",
					"reset_password",
					"dashboard_CE",
					"timeline_showcase_testing"
					
				);

				$SEAllowedPages = array(
					"add_property_name",
					"add_property_name_design",
					"add_property_tower",
					"add_property_varients",
					"all_leads_SE",
					"convert_lead_by_SE",
					"dashboard",
					"edit_employee",
					"edit_property",
					"fetch_towers",
					"fetch_variants",
					"login",
					"received_leads_SE",
					"suspend_employee",
					"suspend_property",
					"timeline",
					"transfer_lead_by_SE",
					"upcomming_leads_SE",
					"view-employees",
					"view-properties",
					"view_converted_leads_SE",
					"view_converted_lead_details",
					"view_day_after_tomorrow_leads_SE",
					"view_dead_leads_SE",
					"View_follow_up_leads_SE",
					"view_leads_for_assigned_SE",
					"view_properties_name",
					"view_properties_tower",
					"view_property_varients",
					"view_SE_assigned_leads",
					"view_single_lead_assigned_by_CE",
					"view_todays_leads_SE",
					"view_Today’s_follow_up_leads_SE",
					"view_tomorrow_leads_SE",
					"add_location",
					"view_locations",
					"export_pdf_property_details",
					"reset_password",
					"dashboard_SE",
					"timeline_showcase_testing"
				);

				$LeadAllowedPages = array(
					"add-leads",
					"dashboard",
					"lead_addmore",
					"login",
					"timeline_showcase_testing",
					"upload"
				);

				if(isset($_SESSION['login_role']) && $_SESSION['login_role'] == "ADMIN" ){
					if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == "ADMIN" ) {
						if(isset($_SESSION['login_user_id']) && $_SESSION['login_user_id'] != "" )
						{
							if(!in_array($curPageName,$adminAllowedPages)) {
								header("Location: dashboard" );
							}
						}
					}
					if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == "SUPERADMIN" ) {
						if(isset($_SESSION['login_user_id']) && $_SESSION['login_user_id'] != "" )
						{
							if(!in_array($curPageName,$superadminAllowedPages)) {
								header("Location: dashboard" );
							}
						}
					}
				}
				

				if(isset($_SESSION['login_role']) && $_SESSION['login_role'] == "CUSTOMER EXECUTIVE" ) {
					if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == "CUSTOMER EXECUTIVE" ) {
						if(isset($_SESSION['login_user_id']) && $_SESSION['login_user_id'] != "" )
						{
							if(!in_array($curPageName,$CEAllowedPages)) {
								header("Location: dashboard" );
							}
						}
					}
				}
				
				if(isset($_SESSION['login_role']) && $_SESSION['login_role'] == "SALES EXECUTIVE" ) {
					if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == "SALES EXECUTIVE" ) {
						if(isset($_SESSION['login_user_id']) && $_SESSION['login_user_id'] != "" )
						{
							if(!in_array($curPageName,$SEAllowedPages)) {
								header("Location: dashboard" );
							}
						}
					}
				}
				
				if(isset($_SESSION['login_role']) && $_SESSION['login_role'] == "LEAD GENERATOR" ) {
					if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == "LEAD GENERATOR" ) {
						if(isset($_SESSION['login_user_id']) && $_SESSION['login_user_id'] != "" )
						{
							if(!in_array($curPageName,$LeadAllowedPages)) {
								header("Location: dashboard" );
							}
						}
					}
				}
			}			
		//}
	}

	if (!isset($_SESSION['login_id']))
	{
		$redirect = $_SERVER['REQUEST_URI'];
	    header("Location: login?redirect=$redirect" );
	}
?>