<?php include 'crudschedadd/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>

<body>
    <div class="" style="margin: 50px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Subject Details</h2>
                        <a href="crudschedadd/create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Subject</a>
                        <a href="editfreshmen.php" class="btn btn-success pull-right">Back</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "crudschedadd/config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM subject";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Schedule Code</th>";
                                        echo "<th>Subject Code</th>";
                                        echo "<th>Section</th>";
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
                                        echo "<td>" . $row['section'] . "</td>";
                                        echo "<td>" . $row['subjtitle'] . "</td>";
                                        echo "<td>" . $row['sem'] . "</td>";
                                        echo "<td>" . $row['units'] . "</td>";
                                        echo "<td>" . $row['day'] . "</td>";
                                        echo "<td>" . $row['time'] . " - " . $row['timeend'] . "</td>";
                                        echo "<td>" . $row['daylab'] . "</td>";
                                        echo "<td>" . $row['timelab'] . " - " . $row['timelabend'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="crudschedadd/update.php?id='. $row['schedcode'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="crudschedadd/delete.php?id='. $row['schedcode'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
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
</body>
</html>