<?php
include('dist/conf/db.php');
$pdo = Database::connect();

if (isset($_POST['property_title'])) {
    $propertyTitle = $_POST['property_title'];

    $sqlv = "SELECT varients FROM property WHERE status='Active' AND property_title = :property_title";
    $stmt = $pdo->prepare($sqlv);
    $stmt->execute([':property_title' => $propertyTitle]);

    while ($rowv = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$rowv['varients'].'">'.$rowv['varients'].'</option>';
    }
}
?>
