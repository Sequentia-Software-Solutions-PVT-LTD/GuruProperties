<?php 
include_once ('dist/conf/checklogin.php'); 

// if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
//   header('location:dashboard');
// }

include ('dist/conf/db.php');
$pdo = Database::connect();


$sqllocation = "select * from location ";
$qlocation = $pdo->prepare($sqllocation);
$qlocation->execute(array());      
$row_location = $qlocation->fetchAll(PDO::FETCH_ASSOC);
$leads_idGlobal = 0;

if (isset($_POST['submit'])) 
{
        // Check if the file was uploaded without errors
        // if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        //     // echo "<pre>";
        //     // print_r($_FILES['file']); // This will show you the details of the uploaded file
        //     // exit();
        // } else {
        //     echo "File upload error: " . $_FILES['file']['error'];
        // }

        // -----------------------------------------------------------------------------------------
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {

   

            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name']; // Use this temporary file name
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            //$allowed = ['xls', 'xlsx', 'csv'];
            $allowed = ['csv'];
    
            if (in_array($fileExt, $allowed)) {
                try {

                    $input1 = array();
                    $input2 = array();
                    $input3 = array();
                    $input4 = array();
                    $input5 = array();
                    $input6 = array();

                    // Open the uploaded file for reading
                    if (($handle = fopen($fileTmpName, "r")) !== FALSE) { 
                        $pdo->beginTransaction();
                        
                        $skipFirstRow = true; // Set a flag to skip the first row

                        // Read each row in the file
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            // Ensure we have the correct number of columns

                            // echo "<pre>";
                            // print_R($data);
                            // exit();

                            // if (count($data) < 7) { // Adjust this to your actual required column count
                            //     // echo "Skipping row: " . implode(", ", $data) . " - Insufficient data<br>";
                            //     continue; // Skip rows with missing data
                            // }

                            if ($skipFirstRow) {
                                $skipFirstRow = false; // Set flag to false after the first iteration
                                continue; // Skip this iteration (header row)
                            }

                            array_push($input1, $data[0]);
                            array_push($input2, $data[1]);
                            array_push($input3, $data[2]);
                            array_push($input4, $data[3]);
                            array_push($input5, $data[4]);
                            array_push($input6, $data[5]);
                            
                            
                            // Prepare the SQL statement
                            // $sql = "INSERT INTO leads (lead_name, email_id, location, phone_no, budget_range, Source, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
                            // $q = $pdo->prepare($sql);
    
                            // // Execute the statement with data from the file
                            // $q->execute([
                            //     $data[0], // lead_name
                            //     $data[1], // email_id
                            //     $data[2], // location
                            //     $data[3] ?? null, // phone_no (use null if not set)
                            //     $data[4] ?? null, // budget_range (use null if not set)
                            //     $data[5] ?? null, // Source (use null if not set)
                            //     $data[6] ?? null, // status (use null if not set)
                            // ]);
                        }

                        $subCount= count($input1);

                        $insertedLeadIds = array();
                        
                        for($i=0;$i<$subCount;$i++) 
                        {        
                            $added_on = date('Y-m-d H-i-s');
                            $status = "Active";
                            $todays_date = date('Y-m-d');
                  
                            $input1Single = $input1[$i];
                            $input2Single = $input2[$i];
                            $input3Single = $input3[$i];
                            $input4Single = $input4[$i];
                            $input5Single = $input5[$i];
                            $input6Single = $input6[$i];

                            $needle = $input3Single;
                            $resultArray = array_filter($row_location, function ($v) use ($needle) {
                                return $needle == $v['name']; 
                            });
                            // if($needle == 1) $needle = 0;
                            // else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
                            
                            if(isset($resultArray) && count($resultArray) > 0) 
                                foreach($resultArray as $result) {
                                    $input3Single = $result['id']; 
                                }    
                            else
                                $input3Single = 0; 
                            
                            $added_on = date("Y-m-d H:i:s");
                            $todays_date = date("d-m-Y");

                            $sql = "INSERT INTO leads(lead_name, email_id, location, phone_no, budget_range, Source, status, added_on, lead_gen_date) values(?,?,?,?,?,?,?,?,?)";
                            $q = $pdo->prepare($sql);
                            $q->execute(array($input1Single, $input2Single, $input3Single,  $input4Single,  $input5Single, $input6Single, 'Active', $added_on, $todays_date));
                            $leads_idGlobal = $pdo->lastInsertId();
                            if($input3Single != 0 && $input3Single != "" && $input3Single != null) {
                                array_push($insertedLeadIds, ["lead_id" => $pdo->lastInsertId(), "location_id" => $input3Single]);
                            }
                        }
                        
                        $sqlcearray = "SELECT *, a.admin_id as ADMINID, e.employee_id as EMPLOYEEID FROM admin a JOIN employee e on a.admin_id = e.admin_id where a.login_role = 'CUSTOMER EXECUTIVE' and a.status = 'Active' and e.status = 'Active'";
                        $qcearray = $pdo->query($sqlcearray);
                        $customerExecutiveArray = array();
                        foreach ($pdo->query($sqlcearray) as $rowcearray) { 
                            $admin_id = $rowcearray['ADMINID'];
                            $employee_id = $rowcearray['EMPLOYEEID'];
                            $employee_name = $rowcearray['employee_name'];

                            array_push($customerExecutiveArray, array($admin_id, $employee_id, $employee_name));
                        }
                        
                        $totalCustomerExuctiveCount = count($customerExecutiveArray); 
                        // echo "totalCustomerExuctiveCount ----- ".$totalCustomerExuctiveCount.'<br>';
                        $leadsCount = count($insertedLeadIds); 
                        // echo "leadsCount ----- ".$leadsCount.'<br>';
                        $leadForsingleCE = floor($leadsCount/$totalCustomerExuctiveCount); 
                        // echo "leadForsingleCE ----- ".$leadForsingleCE.'<br>';
                        // $employeewiseTotalLeadIds = array_chunk($insertedLeadIds, $leadForsingleCE); 
                        // echo "employeewiseTotalLeadIds ----- "; var_dump('<pre>', $employeewiseTotalLeadIds, '</pre>'); echo '<br>';
                        
                        // var_dump($insertedLeadIds);
                        // echo '<br>';
                        // var_dump($customerExecutiveArray);

                        // exit();
                        
                        if($totalCustomerExuctiveCount < $leadsCount) {
                            
                            $employeewiseTotalLeadIds = array_chunk($insertedLeadIds, $leadForsingleCE); 

                            $i = 0;
                            $leadsAssigned = 0 ;
                            for ($i=0; $i < count($customerExecutiveArray); $i++) { 

                                $employeewiseLeadIds = $employeewiseTotalLeadIds[$i];
                                $admin_id = $customerExecutiveArray[$i][0];
                                $employee_id = $customerExecutiveArray[$i][1];
                                $employee_name = $customerExecutiveArray[$i][2];
                                $added_on = date('Y-m-d H-i-s');
                                
                                foreach($employeewiseLeadIds as $employeewiseLeadId) {
                                    $lead_id = $employeewiseLeadId['lead_id'];
                                    $location_id = $employeewiseLeadId['location_id'];
                                    $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`, `location_id`, `employee_name`, `status`,`transfer_status`, `added_on`, `fresh_lead`) VALUES (?,?,?,?,?,?,?,?,?)";
                                    $q = $pdo->prepare($sql);
                                    $q->execute(array($lead_id, $admin_id, $employee_id, $location_id, $employee_name, 'Active', 'Available', $added_on, 1));

                                    $assign_lead = $pdo->lastInsertId();
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $sql = "UPDATE leads set status='Assigned', assign_lead_id = ? WHERE id = ?";
                                    $q = $pdo->prepare($sql);
                                    $q->execute(array($assign_lead, $lead_id));

                                    $leadsAssigned++;
                                }
                            }

                            $remaining_leads = $leadsCount - $leadsAssigned;

                            if($remaining_leads > 0) {
                                $remainingLeadsForLoop = $remaining_leads;
                                foreach($employeewiseTotalLeadIds as $employeewiseLeadIds) {
                                while( $remainingLeadsForLoop != 0 ) {
                                    $i1 = 0;

                                    $employeewiseLeadIds = $employeewiseTotalLeadIds[$i];
                                    foreach($employeewiseLeadIds as $employeewiseLeadId) {
                                    $admin_id = $customerExecutiveArray[$i1][0];
                                    $employee_id = $customerExecutiveArray[$i1][1];
                                    $employee_name = $customerExecutiveArray[$i1][2];
                                    $added_on = date('Y-m-d H-i-s');
                                                        
                                    $lead_id = $employeewiseLeadId['lead_id'];
                                    $location_id = $employeewiseLeadId['location_id'];
                                    $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`, `location_id`, `employee_name`, `status`,`transfer_status`, `added_on`, `fresh_lead`) VALUES (?,?,?,?,?,?,?,?,?)";
                                    $q = $pdo->prepare($sql);
                                    $q->execute(array($lead_id, $admin_id, $employee_id,  $location_id, $employee_name, 'Active','Available', $added_on, 1));

                                    $assign_lead = $pdo->lastInsertId();
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $sql = "UPDATE leads set status='Assigned', assign_lead_id = ? WHERE id = ?";
                                    $q = $pdo->prepare($sql);
                                    $q->execute(array($assign_lead, $lead_id));
                                    $i1++;
                                    $leadsAssigned++;
                                    $remainingLeadsForLoop--;
                                    }
                                }
                                }
                            }

                            if(($leadsCount - $leadsAssigned) == 0) {
                            // echo "Links Are Assigned Properly";
                            }

                        } else {
                            $i = 0;
                            $leadsAssigned = 0 ;
                            $remaining_leads = $leadsCount;
                            $employeewiseTotalLeadIds = array($insertedLeadIds);
                            
                            if($remaining_leads > 0) {
                                $remainingLeadsForLoop = $remaining_leads;
                                foreach($employeewiseTotalLeadIds as $employeewiseLeadIds) {
                                while( $remainingLeadsForLoop != 0 ) {
                                    $i1 = 0;

                                    $employeewiseLeadIds = $employeewiseTotalLeadIds[$i];
                                    foreach($employeewiseLeadIds as $employeewiseLeadId) {
                                    $admin_id = $customerExecutiveArray[$i1][0];
                                    $employee_id = $customerExecutiveArray[$i1][1];
                                    $employee_name = $customerExecutiveArray[$i1][2];
                                    $added_on = date('Y-m-d H-i-s');
                                    
                                    $lead_id = $employeewiseLeadId['lead_id'];
                                    $location_id = $employeewiseLeadId['location_id'];
                                    $sql = "INSERT INTO `assign_leads`(`leads_id`, `admin_id`, `employee_id`, `location_id`, `employee_name`, `status`,`transfer_status`, `added_on`, `fresh_lead`) VALUES (?,?,?,?,?,?,?,?,?)";
                                    $q = $pdo->prepare($sql);
                                    $q->execute(array($lead_id, $admin_id, $employee_id, $location_id, $employee_name, 'Active','Available', $added_on, 1));

                                    $assign_lead = $pdo->lastInsertId();
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $sql = "UPDATE leads set status='Assigned', assign_lead_id = ? WHERE id = ?";
                                    $q = $pdo->prepare($sql);
                                    $q->execute(array($assign_lead, $lead_id));
                                    $i1++;
                                    $leadsAssigned++;
                                    $remainingLeadsForLoop--;
                                    }
                                }
                                }
                            }

                            if(($leadsCount - $leadsAssigned) == 0) {
                            // echo "Links Are Assigned Properly";
                            }
                        }

                        // Commit the transaction
                        $pdo->commit();
                        fclose($handle);
                        // echo "Data inserted successfully from CSV file.";

                        header('location: add-leads');
                        
                    } else {
                        throw new Exception("Error opening file: $fileTmpName");
                        
                    }
                } catch (Exception $e) {
                    if ($pdo->inTransaction()) {
                        $pdo->rollBack();
                    }
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Please upload an Excel file (.xls or .xlsx).";
            }
        } else {
            echo "File upload error: " . $_FILES['file']['error'];
        }
}
?>