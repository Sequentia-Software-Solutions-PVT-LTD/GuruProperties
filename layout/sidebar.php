<?php 

//print_r($_SESSION);
//exit();
if($_SESSION['login_role'] == 'ADMIN' &&  $_SESSION['login_id'] == 'superadmin') 
{
  // echo "superadmin";
  // exit();
  include('sidebar_superadmin.php');
} 
elseif($_SESSION['login_role'] == 'ADMIN' &&  $_SESSION['login_id'] == 'admin') 
{
  include('sidebar_admin.php');
}
elseif($_SESSION['login_role'] == 'CUSTOMER EXECUTIVE') 
{
  include('customer_executive.php');
} 
elseif($_SESSION['login_role'] == 'SALES EXECUTIVE') 
{
  include('sales_executive.php');
}
else 
{
  // include('sidebar_assistant.php');
}

?>