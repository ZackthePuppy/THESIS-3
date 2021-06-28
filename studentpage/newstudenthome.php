<?php include 'logincheck.php';?>
<?php include 'uploadlogic.php';
$page = $_SERVER['PHP_SELF'];
$sec = "300";

if(isset($_POST['yey']) ) {

        $id = trim($_SESSION["id"]);
        $year = trim($_SESSION["year"]);
        $sem = trim($_SESSION["sem"]);;
        $lastname = $_SESSION["lastname"];
        $firstname = $_SESSION["firstname"];


        $con = new mysqli('localhost', 'root', '', 'enrollsemi');
        $results = "SELECT (section) FROM prereg where studentno = $id limit 1"; 
        $stmt = $con->prepare("INSERT INTO grades (studentno, lastname, firstname, section, subjcode, subjtitle, sem, year, units, day, time, timeend, daylab, timelab, timelabend, grade)
            SELECT studentno, lastname, firstname, section, subjcode, subjtitle, sem, year, units, day, time, timeend, daylab, timelab, timelabend, grade
            FROM prereg WHERE studentno = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();



        $stmt2 = $con->prepare("DELETE FROM prereg WHERE studentno = ?");
        $stmt2->bind_param("s", $id);
        $stmt2->execute();

        $stmt3 = $con->prepare("UPDATE regular set enrolled = 'Yes' where id = ?;");
        $stmt3->bind_param("s", $id);
        $stmt3->execute();
        header("Refresh:0");



/*

        $con = new mysqli('localhost', 'root', '', 'enrollsemi');
        $stmt = $con->prepare("INSERT INTO prereg (studentno, lastname, firstname, section)
            SELECT id, lastname, firstname, (SELECT section from subject GROUP BY ?) as section
            FROM regular WHERE id = ?");
        $stmt->bind_param("ss", $section , $id);
        $stmt->execute();
        */
}


else if (isset($_POST['retry'])) {

    $id = trim($_SESSION["id"]);
    $year = trim($_SESSION["year"]);
    $sem = trim($_SESSION["sem"]);;
    $lastname = $_SESSION["lastname"];
    $firstname = $_SESSION["firstname"];
     
    // Redirect to login page

    if ($year = 1 and $sem = 1){

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt = $con->prepare("UPDATE regular set sem = 2 where id = $id");
    $stmt->execute();

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt2 = $con->prepare("UPDATE regular set enrolled = '' where id = $id");
    $stmt2->execute();
    header("Refresh:0");

    }
    else if ($year = 1 and $sem = 2){

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt = $con->prepare("UPDATE regular set year = 2 where id = $id");
    $stmt->execute();

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt2 = $con->prepare("UPDATE regular set enrolled = '' where id = $id");
    $stmt2->execute();
    header("Refresh:0");
        
    }

    else if ($year = 2 and $sem = 1){

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt = $con->prepare("UPDATE regular set sem = 2 where id = $id");
    $stmt->execute();

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt2 = $con->prepare("UPDATE regular set enrolled = '' where id = $id");
    $stmt2->execute();
    header("Refresh:0");
        
    }

    else if ($year = 2 and $sem = 2){

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt = $con->prepare("UPDATE regular set year = 3 where id = $id");
    $stmt->execute();

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt2 = $con->prepare("UPDATE regular set enrolled = '' where id = $id");
    $stmt2->execute();
    header("Refresh:0");
        
    }

    else if ($year = 3 and $sem = 1){

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt = $con->prepare("UPDATE regular set sem = 2 where id = $id");
    $stmt->execute();

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt2 = $con->prepare("UPDATE regular set enrolled = '' where id = $id");
    $stmt2->execute();
    header("Refresh:0");
        
    }

    else if ($year = 3 and $sem = 2){

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt = $con->prepare("UPDATE regular set year = 4 where id = $id");
    $stmt->execute();

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt2 = $con->prepare("UPDATE regular set enrolled = '' where id = $id");
    $stmt2->execute();
    header("Refresh:0");
        
    }

    else if ($year = 1 and $sem = 1){

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt = $con->prepare("UPDATE regular set sem = 2 where id = $id");
    $stmt->execute();

    $con = new mysqli('localhost', 'root', '', 'enrollsemi');
    $stmt2 = $con->prepare("UPDATE regular set enrolled = '' where id = $id");
    $stmt2->execute();
    header("Refresh:0");
        
    }

}


?>

<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
<link rel="icon" type="image/gif" href="pic/logo.png" sizes="16x16">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
</head>
<body style="background-image: url('../css/bg/green.jpg');">
    <?php include 'header.HTML';?>

<div class="content">
    <h1>Name: <?php echo $_SESSION["lastname"] . ", " . $_SESSION['firstname'] . "&emsp;&emsp;Status: " . $_SESSION['status'] . "&emsp;&emsp;Year: " . $_SESSION['year'] . "&emsp;&emsp;Semester: " . $_SESSION['sem'];?></h1>

</div>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    


                    $bet = $_SESSION["id"];
                    $pref = $_SESSION["prefcourse"];
                    $year = $_SESSION["year"];
                    $sem = $_SESSION["sem"];









$sql = "SELECT * from regular where id = $bet";
if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){

                                    if ((($row['enrolled']) == '' or (empty($row['enrolled']))) and (($row['status']) == 'regular') ) { 

                        ?><h1 class="pull-left" style="text-align: center;">List of sections</h1><?php


 // Attempt select query execution
                    $sql = "SELECT * FROM subject where section like '%$pref%' and sem = $sem and year = $year";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            ?>

                            <?php
                            echo '<table class="table table-dark">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Schedule Code</th>";
                                        echo "<th>Section</th>";
                                        echo "<th>Subject Code</th>";
                                        echo "<th>Subject Title</th>";
                                        echo "<th>Semester</th>";
                                        echo "<th># of units</th>";
                                        echo "<th>Day</th>";
                                        echo "<th>Time</th>";
                                        echo "<th>Day of lab</th>";
                                        echo "<th>Time of lab</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['schedcode'] . "</td>";
                                        echo "<td>" . $row['section'] . "</td>";
                                        echo "<td>" . $row['subjcode'] . "</td>";
                                        echo "<td>" . $row['subjtitle'] . "</td>";
                                        echo "<td>" . $row['sem'] . "</td>";
                                        echo "<td>" . $row['units'] . "</td>";
                                        echo "<td>" . $row['day'] . "</td>";
                                        echo "<td>" . $row['time'] . " - " . $row['timeend'] . "</td>";
                                        echo "<td>" . $row['daylab'] . "</td>";
                                        echo "<td>" . $row['timelab'] . " - " . $row['timelabend'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            //mysqli_free_result($result);
                        }

                         else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                            include 'index.php';
                    }
                     else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }






                                    }






                                    else if (($row['enrolled']) == 'Pending' and (($row['status']) == 'regular')) { 
                                        echo "<h2> Status: Your pre-reg form is still pending </h2>";

                                    }







                                    else if (($row['enrolled']) == 'Approved' and (($row['status']) == 'regular')) { 
                                        echo "<td>You are now enrolled.</td>";
                                        ?>
                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                                        <div class="form-group">
                                            <input type="submit" name="yey" value="View enrolled subjects" class="btn btn-primary submitBtn" style="width:20em; margin:0;" />
                                        </div>
                                    </form>
                                        <?php
                                    }










                                    else if (($row['enrolled']) == 'Yes' and (($row['status']) == 'regular')) { 
                                        


 // Attempt select query execution
                    $id = $_SESSION['id'];
                    $sql = "SELECT * FROM grades where studentno = $id and grade = ''";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            ?>

                            <?php
                            echo '<table class="table table-dark">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Section</th>";
                                        echo "<th>Subject Code</th>";
                                        echo "<th>Subject Title</th>";
                                        echo "<th>Semester</th>";
                                        echo "<th># of units</th>";
                                        echo "<th>Day</th>";
                                        echo "<th>Time</th>";
                                        echo "<th>Day of lab</th>";
                                        echo "<th>Time of lab</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['section'] . "</td>";
                                        echo "<td>" . $row['subjcode'] . "</td>";
                                        echo "<td>" . $row['subjtitle'] . "</td>";
                                        echo "<td>" . $row['sem'] . "</td>";
                                        echo "<td>" . $row['units'] . "</td>";
                                        echo "<td>" . $row['day'] . "</td>";
                                        echo "<td>" . $row['time'] . " - " . $row['timeend'] . "</td>";
                                        echo "<td>" . $row['daylab'] . "</td>";
                                        echo "<td>" . $row['timelab'] . " - " . $row['timelabend'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            //mysqli_free_result($result);
                        }

                         else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    }
                     else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }





                        $sql =  "SELECT enrollcheck FROM checksem WHERE id=1";
                          $result=mysqli_query($link,$sql);

                          // Associative array
                         $row=mysqli_fetch_assoc($result);
                         if(($row['enrollcheck']) == 'Yes'){

                            ?>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                            <div class="form-group">
                                <input type="submit" name="retry" style="border: 0px;" value="Enrollment is now open!" class="btn btn-primary submitBtn" style="width:20em; margin:0;" />
                            </div>
                        </form>
                            <?php
                           }

                         else if(($row['enrollcheck']) == '' or ($row['enrollcheck']) == 'No'){
                           }









                                    }









                                    //IRREG 1
                                    else if ((($row['enrolled']) == '' or (empty($row['enrolled']))) and (($row['status']) == 'irregular') ) { 




 // Attempt select query execution
                    $sql = "SELECT * FROM subject where section like '%$pref%' and sem = $sem and year = $year";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            ?>

                            <?php

                            echo '<div style = "height: 500px; overflow: auto;">';
                            echo '<table class="table table-dark">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Schedule Code</th>";
                                        echo "<th>Section</th>";
                                        echo "<th>Subject Code</th>";
                                        echo "<th>Subject Title</th>";
                                        echo "<th>Semester</th>";
                                        echo "<th># of units</th>";
                                        echo "<th>Day</th>";
                                        echo "<th>Time</th>";
                                        echo "<th>Day of lab</th>";
                                        echo "<th>Time of lab</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['schedcode'] . "</td>";
                                        echo "<td>" . $row['section'] . "</td>";
                                        echo "<td>" . $row['subjcode'] . "</td>";
                                        echo "<td>" . $row['subjtitle'] . "</td>";
                                        echo "<td>" . $row['sem'] . "</td>";
                                        echo "<td>" . $row['units'] . "</td>";
                                        echo "<td>" . $row['day'] . "</td>";
                                        echo "<td>" . $row['time'] . " - " . $row['timeend'] . "</td>";
                                        echo "<td>" . $row['daylab'] . "</td>";
                                        echo "<td>" . $row['timelab'] . " - " . $row['timelabend'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            echo "</div>";
                            // Free result set
                            //mysqli_free_result($result);
                        }

                         else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                        include 'create.php';
                    }
                     else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                            include 'index2.php'
;







                                    }








                                    //IRREG2
                                    else if (($row['enrolled']) == 'Pending' and (($row['status']) == 'irregular')) { 
                                        echo "<h2> Status: Your pre-reg form is still pending </h2>";

                                    }









                                    //IRREG3
                                    else if (($row['enrolled']) == 'Approved' and (($row['status']) == 'irregular')) { 
                                        echo "<td>YES" . $row['enrolled'] . "</td>";

                                    }








                                    //IRREG4
                                    else if (($row['enrolled']) == 'Yes' and (($row['status']) == 'irregular')) { 
                                        echo "<td>YES" . $row['enrolled'] . "</td>";

                                    }










                                }

                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }










                   
 













                    // Close connection
                    mysqli_close($link);

                    ?>
                    
                </div>
            </div>        
        </div>
    </div>





</body>
</html>