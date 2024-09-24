<?php 
include_once ('dist/conf/checklogin.php'); 

include ('dist/conf/db.php');
$pdo = Database::connect();

// require 'PhpSpreadsheet/vendor/autoload.php'; // Adjust the path as necessary
require 'C:/xampp/htdocs/GuruProperties/PhpSpreadsheet/vendor/autoload.php'; // Adjust the path as necessary

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['submit'])) 
{
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['xls', 'xlsx'];

        if (in_array($fileExt, $allowed)) {
            try {
                // Load the uploaded Excel file
                $spreadsheet = IOFactory::load($fileTmpName);
                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                // Begin a transaction
                $pdo->beginTransaction();

                // Read each row in the sheet
                foreach ($sheetData as $row) {
                    // Ensure we have the correct number of columns
                    if (count($row) < 9) { // Adjust this to your actual required column count
                        continue; // Skip rows with missing data
                    }

                    // Prepare the SQL statement
                    $sql = "INSERT INTO leads (lead_name, email_id, location, phone_no, budget_range, Source, status, added_on, lead_gen_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $q = $pdo->prepare($sql);

                    // Execute the statement with data from the Excel sheet
                    $q->execute([
                        $row['A'], // lead_name
                        $row['B'], // email_id
                        $row['C'], // location
                        $row['D'] ?? null, // phone_no (use null if not set)
                        $row['E'] ?? null, // budget_range (use null if not set)
                        $row['F'] ?? null, // Source (use null if not set)
                        $row['G'] ?? null, // status (use null if not set)
                        $row['H'] ?? null, // added_on (use null if not set)
                        $row['I'] ?? null  // lead_gen_date (use null if not set)
                    ]);
                }

                // Commit the transaction
                $pdo->commit();
                echo "Data inserted successfully from Excel file.";
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
