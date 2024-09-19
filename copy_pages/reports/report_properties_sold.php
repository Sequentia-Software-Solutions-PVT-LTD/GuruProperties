<?php

    include ('dist/conf/db.php');
    $pdo = Database::connect();

    // $sqlemp = "select * from employee";
    // $q = $pdo->prepare($sqlemp);
    // $q->execute(array());      
    // $row_emp = $q->fetchAll(PDO::FETCH_ASSOC);

    $sqlproperty = "select * from property_name ";
    $q = $pdo->prepare($sqlproperty);
    $q->execute(array());      
    $row_property = $q->fetchAll(PDO::FETCH_ASSOC);
    
    // $sqltower = "select * from property_tower ";
    // $q = $pdo->prepare($sqltower);
    // $q->execute(array());      
    // $row_tower = $q->fetchAll(PDO::FETCH_ASSOC);
    
    $sqlvariant = "select * from property_varients ";
    $q = $pdo->prepare($sqlvariant);
    $q->execute(array());      
    $row_variant = $q->fetchAll(PDO::FETCH_ASSOC);


    // $employeeName = "";
    //     $needle = $convertedLeads['employee_id'];
    //     $resultArray = array_filter($row_emp, function ($v) use ($needle) {
    //         return $needle == $v['employee_id']; 
    //     });
    //     if($needle == 1) $needle = 0;
    //     else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
    //     if(isset($resultArray[$needle]["employee_name"]) && $resultArray[$needle]["employee_name"] != "") 
    //     $employeeName = $resultArray[$needle]["employee_name"]; 
        
    //     $propertyName = "";
    //     $needle = $convertedLeads['property_name_id'];
    //     $resultArray = array_filter($row_property, function ($v) use ($needle) {
    //         return $needle == $v['property_name_id']; 
    //     });
    //     if($needle == 1) $needle = 0;
    //     else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
    //     if(isset($resultArray[$needle]["property_title"]) && $resultArray[$needle]["property_title"] != "") 
    //     $propertyName = $resultArray[$needle]["property_title"]; 

    //     $towerName = "";
    //     $needle = $convertedLeads['property_tower_id'];
    //     $resultArray = array_filter($row_tower, function ($v) use ($needle) {
    //         return $needle == $v['property_tower_id']; 
    //     });
    //     if($needle == 1) $needle = 0;
    //     else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
    //     if(isset($resultArray[$needle]["property_tower_name"]) && $resultArray[$needle]["property_tower_name"] != "") 
    //     $towerName = $resultArray[$needle]["property_tower_name"]; 

    //     $variantName = "";
    //     $needle = $convertedLeads['property_variants'];
    //     $resultArray = array_filter($row_variant, function ($v) use ($needle) {
    //         return $needle == $v['property_varients_id']; 
    //     });
    //     if($needle == 1) $needle = 0;
    //     else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
    //     if(isset($resultArray[$needle]["varients"]) && $resultArray[$needle]["varients"] != "") 
    //     $variantName = $resultArray[$needle]["varients"]; 

    //     $overallCommision += $convertedLeads['commission'];

    echo '<pre>';

    $year = "2024";
    $month = "9";
    
    $sql = "SELECT *,count(*) as SoldCount, month(`added_on`) as Month, YEAR(`added_on`) as Year FROM converted_leads WHERE month(`added_on`) = '$month' and YEAR(`added_on`) = '$year' GROUP BY property_variants";

        echo '
            <table cellsborder="1">
            <thead>
            <tr>
                <th>Year</th>
                <th>Month</th>
                <th>Propertie Name</th>
                <th>Variant</th>
                <th>Variants Sold</th>
                <th>Action(View)</th>
            </tr>
            </thead>
            <tbody>';
    

    foreach($pdo->query($sql) as $convertedLeads) {
        
        $propertyName = "";
        $needle = $convertedLeads['property_name_id'];
        $resultArray = array_filter($row_property, function ($v) use ($needle) {
            return $needle == $v['property_name_id']; 
        });
        if($needle == 1) $needle = 0;
        else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
        if(isset($resultArray[$needle]["property_title"]) && $resultArray[$needle]["property_title"] != "") 
        $propertyName = $resultArray[$needle]["property_title"]; 

        $variantName = "";
        $needle = $convertedLeads['property_variants'];
        $resultArray = array_filter($row_variant, function ($v) use ($needle) {
            return $needle == $v['property_varients_id']; 
        });
        if($needle == 1) $needle = 0;
        else if ($needle != 0 && $needle != 1) $needle =  $needle - 1;
        if(isset($resultArray[$needle]["varients"]) && $resultArray[$needle]["varients"] != "") 
        $variantName = $resultArray[$needle]["varients"]; 

        echo '
            <tr>
                <td>'.$convertedLeads['Year'].'</td>
                <td>'.date("F", mktime(0, 0, 0, $convertedLeads['Month'], 10)).'</td>
                <td>'.$propertyName.'</td>
                <td>'.$variantName.'</td>
                <td>'.$convertedLeads['SoldCount'].'</td>
                <td> <a href="link_to_view_what">What Needs to be viewed</a></td>
            </tr>';

    }

        echo '
            </tbody>
            </table>';

        // $cMonth = $convertedLeads['Month'];
        // $cYear = $convertedLeads['Year'];

        // $sqlALCount = "SELECT count(leads_id) as TotalLeads FROM assign_leads WHERE fresh_lead = 1 and month(`added_on`) = '$cMonth' and YEAR(`added_on`) = '$cYear' GROUP BY month(`added_on`)";
        // $qALCount = $pdo->prepare($sqlALCount);
        // $qALCount->execute(array());
        // $TotalLeads = $qALCount->fetch(PDO::FETCH_ASSOC);