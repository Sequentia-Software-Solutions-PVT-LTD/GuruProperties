<?php
//   include_once ('dist/conf/checklogin.php'); 
  session_start();
  include ('dist/conf/db.php');

  $pdo = Database::connect();

  $sqlLocation = "SELECT name FROM location order by name";
  $qlocation = $pdo->prepare($sqlLocation);
  $qlocation->execute(array());
  $locationList = $qlocation->fetchAll(PDO::FETCH_ASSOC);

  $publishlocationList = array();
  foreach($locationList as $locationelement) {
    array_push($publishlocationList, $locationelement['name']);
  }

   echo json_encode($publishlocationList);
?>