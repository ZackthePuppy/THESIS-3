<?php include 'logincheck.php';?>
<?php include 'crudexamfreshmen/server.php'; ?>

<?php 
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $record = mysqli_query($db, "SELECT * FROM newstudent WHERE id=$id");

        if (count($record) == 1 ) {
            $n = mysqli_fetch_array($record);
            $result = $n['result'];
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
    <h3 style="text-align: center;">Exam result of freshmens</h3>

    
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
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Email</th>
            <th>Exam Date</th>
            <th>Exam Result</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php if (($row['exam']) == '0000-00-00' or (empty($row['exam']))) { 
                                		echo "To be assessed";
                                	}
				else
				echo $row['exam']; ?></td>
            <td><?php echo $row['result']; ?></td>
            <td>
                <a href="examfreshmen.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
            </td>
        </tr>
    <?php } ?>
</table>

    <form method="post" action="crudexamfreshmen/server.php" >
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>Exam result for <?php echo $lastname; ?></label>
            <select id = "result" name="result" value="<?php echo $result; ?>">
               <option value="01"></option>
			   <option value="Passed">Passed</option>
			   <option value="Failed">Failed</option>
			</select>
        </div>
        <div class="input-group">


            <?php if ($update == true): ?>
    <button class="btn" type="submit" name="update" style="background: #556B2F;" >Confirm</button>
<?php else: ?>
<?php endif ?>
    </form>
    <a class = "btn" href = "editfreshmen.php" style="text-decoration: none;">Back</a>
        </div>

</div>











</body>
</html>