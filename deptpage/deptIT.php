<?php include 'logincheck.php';?>
<?php include 'deptcrud/server.php'; ?>

<?php 
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $record = mysqli_query($db, "SELECT * FROM newstudent WHERE id=$id");

        if ((is_object($record) && count(get_object_vars($record)) > 0) || count($record) == 1 ) {
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
    <h3 style="text-align: center;">NOA Approval for Students</h3>

    
<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>



    <?php $results = mysqli_query($db, "SELECT * FROM newstudent where prefcourse = 'BSIT' or prefcourse = 'BSCS';"); ?>

<table>
    <thead>
        <tr>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Email</th>
            <th>Preferred Course</th>
            <th>Approval</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['prefcourse']; ?></td>

            <td><?php if ((empty($row['verifieddept']))) { 
                                        echo "not yet";
                                    }
                else
                echo $row['verifieddept']; ?></td>
            <td>
                <a href="deptIT.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
            </td>
        </tr>
    <?php } ?>
</table>

    <form method="post" action="deptcrud/server.php" >
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>Exam result for <?php echo $lastname; ?></label>
            <select id = "verifieddept" name="verifieddept" value="<?php echo $result; ?>">
               <option value="01"></option>
               <option value="Approved">Approved</option>
               <option value="Not Approved">Not Approved</option>
            </select>
        </div>
        <div class="input-group">


            <?php if ($update == true): ?>
    <button class="btn" type="submit" name="update" style="background: #556B2F;" >Confirm</button>
<?php else: ?>
<?php endif ?>
    </form>
        </div>

</div>











</body>
</html>