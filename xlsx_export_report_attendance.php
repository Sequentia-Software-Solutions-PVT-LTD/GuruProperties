<?php
include_once ('dist/conf/checklogin.php'); 
include ('dist/conf/db.php');
// $pdo = Database::connect();



function export()
{
	if(isSet($_POST["xlsx"])) {

        // print_R($_POST);
        // exit();
        $pdo = Database::connect();

	    // $datepicker = $_POST["patient_date"];
	    // $patient_date = date("Y-m-d", strtotime($datepicker));
	    // $doctor_id = $_POST["doctor_id"];

	    // $sql = "Select * from patient_pro where checkup_date = '$patient_date' and `doctor_id` = '$doctor_id'";

        
        $current_year = $_POST['year'];

        $from_month = $_POST['from_month'];
        $to_month = $_POST['from_month'];
        $employee_name = $_POST['employee_name'];

        // Convert month numbers to date strings (e.g., '02' -> '2024-02-01' and '09' -> '2024-09-30')
        $from_date = $current_year.'-'.$from_month.'-01';
        $to_date = date("Y-m-t", strtotime( $current_year.'-'.$from_month.'-01')); // 'Y-m-t' gives the last day of the given month

        $sql = "SELECT * FROM attendance WHERE login_name = '$employee_name' AND date BETWEEN '$from_date' AND '$to_date'";
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters properly
        $stmt->execute([
            ':employee_name' => $employee_name,
            ':from_date' => $from_date,
            ':to_date' => $to_date
        ]);
        
	  }
	
	//$sql = "select * from patient";
	
	
	// Query Database
	$filename = 'Attendance_Report'.date('Y-m-d H-i-s').'.csv';	
	$pdo = Database::connect();
    // print_R($sql);
    // exit();
	$temp = $pdo->query($sql);
  

    // $stmt->execute();
	$rsSearchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if (count($rsSearchResults) !== 0)
    {
		$cnt = $rsSearchResults;

		$out = '';
		// fiels to export
		$out .='Executive Name, Date, In Time, Out Time, Latitude, Longitude';
		$out .="\n";
		// Add all values in the table
		// foreach ($pdo->query($sql) as $row) 
        foreach($rsSearchResults as $row)
		{ 
            $i = 1;
            $status = $row['status'];
            if($status == 'Logged In'){
                $in_time = $row["time"];
            }
            else {
            $in_time = '-';
            }
        //   
            if($status == 'Logged Out'){
            $out_time = $row["time"];
            }
            else {
                $out_time = '-';
            }


		 	$str = str_replace(',',' ', $row['login_name']);
			$out .=''.$str.',';

			$str = str_replace(',',' ', $row['date']);
			$out .=''.$str.',';
			
			$str = str_replace(',',' ', $in_time);
			$out .=''.$str.',';
			
			$str = str_replace(',',' ', $out_time);
			$out .=''.$str.',';
			
			$str = str_replace(',',' ', $row['latitude']);
			$out .=''.$str.',';
			
			$str = str_replace(',',' ', $row['longitude']);
			$out .=''.$str.',';

			$out .="\n";
		}
		// Output to browser with appropriate mime type
		@header("Content-type: text/x-csv");	
		@header("Content-Disposition: attachment; filename=$filename;");
		echo $out;
		exit;	
	 }
	 else
	 {
		header("location:attendance_report.php?r=1");
		echo "database empty";
	 }
}

if(isset($_REQUEST['xlsx'])) {
	export();
	header("Location: attendance_report");
}
?>	
					