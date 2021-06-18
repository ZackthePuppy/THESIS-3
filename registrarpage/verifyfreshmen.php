<?php include 'logincheck.php';?>
<?php include 'crudverifyfreshmen/server.php'; ?>
<?php include 'uploadlogic.php';?>

<?php 
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $record = mysqli_query($db, "SELECT * FROM newstudent WHERE id=$id");

        if (count($record) == 1 ) {
            $n = mysqli_fetch_array($record);
            $verified = $n['verified'];
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
            <th>Exam Result&nbsp;</th>
            <th>Verify&nbsp;</th>
            <th>Files&nbsp;</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['result']; ?></td>
            <td><?php if (($row['verified']) == '' or (empty($row['verified']))) { 
                                        echo "Not yet";
                                    }
                else
                echo $row['verified']; ?></td>
            <td><?php echo $row['filename']; ?></td>
            <td><a href="verifyfreshmen.php?file_id=<?php echo $row['id'] ?>">Download</a></td>
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
            <select id = "verified" name="verified" value="<?php echo $verified; ?>">
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