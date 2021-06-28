<?php

// Include config file
// Define variables and initialize with empty values
$schedcode = $schedcode_err = "";

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5" style="text-align: center;">Add Subjects Here</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Schedule Code</label>
                            <input type="text" name="schedcode" class="form-control <?php echo (!empty($schedcode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $schedcode; ?>">
                            <span class="invalid-feedback"><?php echo $schedcode_err;?></span>
                        </div>


                        <br><input type="submit" class="btn btn-primary" value="Add subject">

                    </form>









<?php
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name

            error_reporting(0);

    if(empty(trim($_POST["schedcode"]))){
        $schedcode_err = "<h2>You must put schedule code</h2>";     
    }
    else{
        $schedcode = trim($_POST["schedcode"]);
        ?>



<?php  $section = "SELECT (schedcode, section, subjcode, subjtitle, prereq, units, day, time, timeend, daylab, timelab, timelabend) from subject where schedcode = $schedcode"; 


    $db = mysqli_connect('localhost', 'root', '', 'enrollsemi');
    $resultsx = mysqli_query($db, "SELECT * from subject where schedcode = $schedcode") or die( mysqli_error($db)); ?>

    <?php while ($row = mysqli_fetch_array($resultsx)) { 
        $schedcode = $row['schedcode'];
        $prereq = $row['prereq'];

        if ( $row['prereq'] == '' or (empty($row['prereq'])) ){
            

        $id = trim($_SESSION["id"]);
        $lastname = $_SESSION["lastname"];
        $firstname = $_SESSION["firstname"];
        $con = new mysqli('localhost', 'root', '', 'enrollsemi');
        $stmt = $con->prepare("INSERT INTO prereg (studentno, lastname, firstname, section, subjcode, subjtitle, sem, year, units, day, time, timeend, daylab, timelab, timelabend)
            SELECT ?, ?, ?, section, subjcode, subjtitle, sem, year, units, day, time, timeend, daylab, timelab, timelabend
            FROM subject WHERE schedcode = ?;");
        $stmt->bind_param("ssss", $id, $lastname, $firstname, $schedcode);
        $stmt->execute();

        }
        else if ( $row['prereq'] != ''  ){

            $prereq = $row['prereq'];

            $id = trim($_SESSION["id"]);
            $query = "SELECT subjcode FROM grades WHERE subjcode = '$prereq' AND studentno = $id LIMIT 1";
            $result = mysqli_query($db, $query);

            error_reporting(0);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if(! $row) {

            echo ("<script LANGUAGE='JavaScript'>
                        window.alert('ERROR! You cannot take this subject because of prerequisite!')
                        </script>");
            } else {
                echo '<p>' . $row['subjcode'] . '</p>';
            }

        }
        



} ?>
     





<?php


    $db = mysqli_connect('localhost', 'root', '', 'enrollsemi');
    $results = mysqli_query($db, "SELECT * from prereg where studentno = $id") or die( mysqli_error($db)); ?>
<table class="table table-dark">
    
        <tr>
            <th>Section&nbsp;</th>
            <th>Subject Code&nbsp;</th>
            <th>Subject Title&nbsp;</th>
            <th>Unit&nbsp;</th>
            <th>Day&nbsp;</th>
            <th>Time&nbsp;</th>
            <th>Day (Lab)&nbsp;</th>
            <th>Time (Lab)&nbsp;</th>
        </tr>
    <?php while ($row = mysqli_fetch_array($results)) { 
        

        ?>
        <tr>
            <td><?php echo $row['section']; ?></td>
            <td><?php echo $row['subjcode']; ?></td>
            <td><?php echo $row['subjtitle']; ?></td>
            <td><?php echo $row['units']; ?></td>
            <td><?php echo $row['day']; ?></td>
            <td><?php echo $row['time'] . $row['timeend']; ?></td>
            <td><?php echo $row['daylab']; ?></td>
            <td><?php if ( (($row['timelab']) == '00:00:00' or (empty($row['timelab']))) and (($row['timelabend']) == '00:00:00' or (empty($row['timelabend']))) ){ 
                                        echo "N/A";
                                    }
                else
                echo $row['timelab'] . "-" . $row['timelabend']; ?></td>
        </tr>
    <?php 


} ?>







<?php

    }

    
    // Check input errors before inserting in database

    
    // Close connection
    //mysqli_close($link);
}
?>










                </div>
            </div>        
        </div>
    </div>
</body>
</html>