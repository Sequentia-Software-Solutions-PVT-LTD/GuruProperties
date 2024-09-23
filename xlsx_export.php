<?php
// include_once ('dist/conf/checklogin.php'); 
include ('dist/conf/db.php');


function export()
{
	// $requestObject = '{"excelData":[["2024","September","11","1"],["2024","October",0,"1"]],"columns":"Year, Month, Total No Of Leads, Converted Leads","filename":"Leads_Data_"}';
	// $requestObject = $_REQUEST['postData'];
	$requestObject = ($_REQUEST['postData']);
	$requestObject = json_decode($requestObject);
	$exceldata = $requestObject->excelData;
	$columns = $requestObject->columns;
	$filename = $requestObject->filename;
	$filename = $filename.date('Y-m-d H-i-s').'.csv';
	$rsSearchResults = count($exceldata);
	if ($rsSearchResults !== 0)
    {
		$cnt = $rsSearchResults;
		$out = '';
		$out .= $columns;
		$out .="\n";
		foreach ($exceldata as $row) 
		{ 
			$row = (array)$row;
			$i = 0;
			foreach($row as $value) {
				$str = str_replace(',',' ', $row[$i++]);
				$out .=''.$str.',';	
			}

			$out .="\n";
		}
		@header("Content-type: text/x-csv");	
		@header("Content-Disposition: attachment; filename=$filename;");
		echo $out;
		exit;	
	 }
	 else
	 {
		header("location:test.php?r=1");
		echo "database empty";
	 }
}

export();
if(isset($_REQUEST['postData'])) {
	header("Location: view_daily_summary");
}
?>	
					