<?php
include('dist/conf/db.php');
$pdo = Database::connect();

if (isset($_POST['property_id'])) {
    $propertyId = $_POST['property_id'];

    $sql = "SELECT * FROM property_tower WHERE property_name_id = :property_id and status = 'Active'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':property_id' => $propertyId]);

    echo '<option value="">Select Property Tower</option>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // echo '<option value="">'.'Select Tower'.'</option>';
        echo '<option value="'.$row['property_tower_id'].'">'.$row['property_tower_name'].'</option>';
    }
}
?>