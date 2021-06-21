<?php include 'logincheck.php';?>
<?php include 'crudverifyfreshmen/server.php'; ?>
<?php include 'uploadlogic.php';?>
<?php
$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>
<?php 
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $record = mysqli_query($db, "SELECT * FROM newstudent WHERE id=$id");

        if ((is_object($record) && count(get_object_vars($record)) > 0) || count($record) == 1  ) {
            $n = mysqli_fetch_array($record);
            $verified = $n['verifiedregistrar'];
            $lastname = $n['lastname'];
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="icon" type="image/gif" href="pic/logo.png" sizes="16x16">
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
</head>
<body>

    <?php include 'header.HTML';?>


<div class="content">
    <h3 style="text-align: center;">Verify requirements of freshmens</h3>

    
<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>



    <?php $results = mysqli_query($db, "SELECT * FROM newstudent where exam != ''"); ?>

<table>
    <thead>
        <tr>
            <th>Lastname&nbsp;</th>
            <th>Firstname&nbsp;</th>
            <th>Email&nbsp;</th>
            <th>Verification&nbsp;</th>
            <th>Files&nbsp;</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php if (($row['verifiedregistrar']) == '' or (empty($row['verifiedregistrar']))) { 
                                        echo "Not yet";
                                    }
                else
                echo $row['verifiedregistrar']; ?></td>
            <td><?php echo $row['filename2']; ?></td>
            <td><a href="verifyfreshmen.php?file_id2=<?php echo $row['id'] ?>">Download</a></td>
            <td>
                <a href="verifyfreshmen.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
            </td>
        </tr>
    <?php } ?>
</table>

    <form method="post" action="crudverifyfreshmen/server.php" >
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>Verify freshmen: <?php echo $lastname; ?></label>
            <select id = "verifiedregistrar" name="verifiedregistrar" value="<?php echo $verified; ?>">
               <option value="01"></option>
               <option value="Verified">Verified</option>
               <option value="To be followed">To be followed</option>
            </select>
        </div>
        <div class="input-group">


            <?php if ($update == true): ?>
    <button class="btn" type="submit" name="update" style="background: #556B2F;" >Verify</button>
<?php else: ?>
<?php endif ?>
    </form>
    <a class = "btn" href = "verifyfreshmen.php" style="text-decoration: none;">Back</a>
        </div>




</div>





</body>
</html>