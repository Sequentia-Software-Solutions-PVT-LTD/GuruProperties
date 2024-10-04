<?php 

//print_r($_SESSION);
//exit();
if($_SESSION['login_role'] == 'ADMIN' &&  $_SESSION['login_id'] == 'superadmin') 
{
  // echo "superadmin";
  // exit();
  include('layout/sidebar_superadmin.php');
} 
elseif($_SESSION['login_role'] == 'ADMIN' &&  $_SESSION['login_id'] == 'admin') 
{
  include('layout/sidebar_admin.php');
}
elseif($_SESSION['login_role'] == 'CUSTOMER EXECUTIVE') 
{
  include('layout/customer_executive.php');
} 
elseif($_SESSION['login_role'] == 'SALES EXECUTIVE') 
{
  include('layout/sales_executive.php');
}
elseif($_SESSION['login_role'] == 'LEAD GENERATOR') 
{
  include('layout/sidebar_lead_generator.php');
}
else 
{
  // include('sidebar_lead_generator.php');
}

?>