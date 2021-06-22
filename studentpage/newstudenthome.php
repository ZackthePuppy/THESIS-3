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
    <h1>Hi, <?php echo $_SESSION["lastname"] ;?>! Select your section here</h1>

</div>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h1 class="pull-left" style="text-align: center;">BSIT 1A</h1>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM subject where section = 'BSIT1A' and sem = 1";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Schedule Code</th>";
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
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 


                    ?>
                    <div class="mt-5 mb-3 clearfix">
                        <h1 class="pull-left" style="text-align: center;">BSIT 1B</h1>
                    </div>
                    <?php
                    // Attempt select query execution
                    $sql = "SELECT * FROM subject where section = 'BSIT1B' and sem = 1";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Schedule Code</th>";
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


<?php include 'index.php';?>



</body>
</html>