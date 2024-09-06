<?php
    include('dist/conf/db.php');
    $pdo = Database::connect();

    if (isset($_POST['tower_id'])) {
        $towerId = $_POST['tower_id'];

        // print_r($towerId);
        // exit();

        $sql = "SELECT * FROM property_varients WHERE property_tower_id = :tower_id and status = 'Active'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':tower_id' => $towerId]);

        // print_r($sql);
        // exit();

        if ($stmt->rowCount() > 0) {
            echo '<option value="">Select Property Variants</option>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$row['property_varients_id'].'">'.$row['varients'].'</option>';
            }
        } else {
            echo '<option value="">No Variants Found</option>';
        }
    } else {
        echo '<option value="">Invalid Tower ID</option>';
    }
?>