<?php include 'logincheck.php';?>
<?php include 'crudclinic/server.php'; ?>
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

        if ((is_object($record) && count(get_object_vars($record)) > 0) || count($record) == 1 ) {
            $n = mysqli_fetch_array($record);
            $exam = $n['examclinic'];
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
    <h3 style="text-align: center;">Medical Examination Date for students</h3>

    
<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>



    <?php $results = mysqli_query($db, "SELECT * FROM newstudent WHERE result = 'Passed';"); ?>

<table>
    <thead>
        <tr>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Email</th>
            <th>Medical Exam Date</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php if (($row['examclinic']) == '0000-00-00' or (empty($row['examclinic']))) { 
                                        echo "assessing";
                                    }
                else
                echo $row['examclinic']; ?></td>

            
            <td>
                <a href="clinichome.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Add schedule</a>
            </td>
        </tr>
    <?php } ?>
</table>

    <form method="post" action="crudclinic/server.php" >
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>Add medical examination date for: <?php echo $lastname; ?></label><br>
            <select id = "month" name="month" value="<?php echo $month; ?>">
               <option value="01">January</option>
               <option value="02">February</option>
               <option value="03">March</option>
               <option value="04">April</option>
               <option value="05">May</option>
               <option value="06">June</option>
               <option value="07">July</option>
               <option value="08">August</option>
               <option value="09">September</option>
               <option value="10">October</option>
               <option value="11">November</option>
               <option value="12">December</option>
            </select>
            <select id = "day" name="day" value="<?php echo $day; ?>">
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
               <option value="13">13</option>
               <option value="14">14</option>
               <option value="15">15</option>
               <option value="16">16</option>
               <option value="17">17</option>
               <option value="18">18</option>
               <option value="19">19</option>
               <option value="20">20</option>
               <option value="21">21</option>
               <option value="22">22</option>
               <option value="23">23</option>
               <option value="24">24</option>
               <option value="25">25</option>
               <option value="26">26</option>
               <option value="27">27</option>
               <option value="28">28</option>
               <option value="29">29</option>
               <option value="30">30</option>
               <option value="31">31</option>
            </select>
        </div>
        <div class="input-group">


            <?php if ($update == true): ?>
    <button class="btn" type="submit" name="update" style="background: #556B2F;" >Add schedule</button>
<?php else: ?>
<?php endif ?>
    </form>
    <br><a class = "btn" href = "examclinic.php" style="text-decoration: none;">Students medical approval</a>
        </div>




</div>

</body>
</html>