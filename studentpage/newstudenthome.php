<?php include 'logincheck.php';?>
<?php include 'uploadlogic.php';?>

<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
<link rel="icon" type="image/gif" href="pic/logo.png" sizes="16x16">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php include 'header.HTML';?>

<div class="content">
    <h1>Hi, <?php echo $_SESSION["lastname"] ;?>! This is your pre-registration form</h1>

        <h2>Select your section</h2>


</div>
</body>
</html>