<?php
if (isset($_POST["submit1"])) {
    echo "<pre>";
    print_r($_POST);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
</head>
<body>
    <form action="#" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo htmlspecialchars($_REQUEST['assign_leads_sr_id']); ?>" name="assign_leads_sr_id">
        <!-- Your form fields here -->
        <button type="submit" name="submit1" class="btn btn-success logo-btn">Submit</button>
    </form>
</body>
</html>
