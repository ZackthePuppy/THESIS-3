<?php include 'registrarpage/crud/server.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
    <link rel="stylesheet" type="text/css" href="registrarpage/css/style.css">
<link rel="icon" type="image/gif" href="pic/logo.png" sizes="16x16">
</head>
<body>
	<?php include 'header.HTML';?>

<div class="content">


    <?php $results = mysqli_query($db, "SELECT * FROM events"); ?>

<table>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo "<h1>" . $row['title'] . "</h1>"; ?></td>
        </tr>
        <tr>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <tr>
            <td><?php echo "<h2>" . $row['content'] . "</h2>"; ?></td>
        </tr>
    <?php } ?>
</table>



</div>

</body>
</html>