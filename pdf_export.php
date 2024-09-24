<?php
    include_once ('dist/conf/checklogin.php'); 
    include ('dist/conf/db.php');
    $pdo = Database::connect();
    
    $requestObject = ($_REQUEST['postData']);
    $requestObject = json_decode($requestObject);
    $exceldata = $requestObject->excelData;
    $columns = $requestObject->columns;
    $filename = $requestObject->filename;
    $FileTitle = $requestObject->FileTitle;

?>
<!doctype html>
<html data-assets-path="assets/">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <?php include 'layout/header_js.php'; ?>    
  </head>

  <body onload="window.print();">
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
          <div class="content-wrapper">
              <div class="container-xxl flex-grow-1 container-p-y">
                <h5 class="card-header mb-5 text-center"><?php echo $FileTitle; ?></h5>
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                        <thead>
                            <tr>
                                <?php
                                    $columns = explode( ",", $columns);
                                    $columnsCount = count($columns);
                                    $i = 0;
                                    if ($columnsCount !== 0)
                                    {foreach ($columns as $column) 
                                        { 
                                ?>
                                <th><?php echo $column; ?></th>
                                <?php }} ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $rsSearchResults = count($exceldata);
                                if ($rsSearchResults !== 0)
                                {
                                    $i1 = 0;
                                    foreach($exceldata as $row){
                            ?>
                            <tr>
                                <?php 
                                    $row = (array)$row;
                                    foreach($row as $value) {
                                        echo "<td>".str_replace(',',' ', $value)."</td>";
                                    }
                                ?>
                            </tr>
                            <?php $i1++; } ?>
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
    <?php include 'layout/footer_js.php'; ?>
  </body>
</html>
