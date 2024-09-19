<?php

    include ('dist/conf/db.php');
    $pdo = Database::connect();

    $year = "2024";
    $month = "8";

    $sql = "SELECT * FROM converted_leads WHERE month(`added_on`) = '$month' and YEAR(`added_on`) = '$year'";
    foreach($pdo->query($sql) as $convertedLeads) {
        var_dump($convertedLeads);
    }
