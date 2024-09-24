<?php 
include_once ('dist/conf/checklogin.php'); 

// if ($_SESSION['login_id'] == "superadmin" || $_SESSION['login_id'] == "ASSISTANT" ){
//   header('location:dashboard');
// }

include ('dist/conf/db.php');
$pdo = Database::connect();


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
    
                            // Prepare the SQL statement
                            $sql = "INSERT INTO leads (lead_name, email_id, location, phone_no, budget_range, Source, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
                            $q = $pdo->prepare($sql);
    
                            // Execute the statement with data from the file
                            $q->execute([
                                $data[0], // lead_name
                                $data[1], // email_id
                                $data[2], // location
                                $data[3] ?? null, // phone_no (use null if not set)
                                $data[4] ?? null, // budget_range (use null if not set)
                                $data[5] ?? null, // Source (use null if not set)
                                $data[6] ?? null, // status (use null if not set)
                            ]);
                        }
    
                        // Commit the transaction
                        $pdo->commit();
                        fclose($handle);
                        echo "Data inserted successfully from CSV file.";
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