<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$subjcode = $section = $subjtitle = $sem = $units = $slots = $day = $daylab = $time = $timeend = $timelab = $timelabend = $prereq_err = $prereq = $year = "";
$subjcode_err = $section_err = $subjtitle_err = $sem_err = $units_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name

    if(empty(trim($_POST["subjcode"]))){
        $subjcode_err = "Subject Code can't be empty!";     
    }
    else{
        $subjcode = trim($_POST["subjcode"]);
    }

    if(empty(trim($_POST["subjtitle"]))){
        $subjtitle_err = "Subject Title can't be empty!";     
    }
    else{
        $subjtitle = trim($_POST["subjtitle"]);
    }
    
    $units = trim($_POST["units"]);
    $prereq = trim($_POST["prereq"]);
    $sem = trim($_POST["sem"]);
    $year = trim($_POST["year"]);
    $section = ($_POST['course'] . $_POST['year'] . $_POST['section']);  
    $slots = 50;
    $day = trim($_POST["day"]);
    $time = trim($_POST["time"]);
    $timeend = trim($_POST["timeend"]);
    $daylab = trim($_POST["daylab"]);
    $timelab = trim($_POST["timelab"]);
    $timelabend = trim($_POST["timelabend"]);
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO subject (subjcode, subjtitle, units, prereq, sem, year, section, slots, day, time, timeend, daylab, timelab, timelabend) VALUES (?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ? ,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssss", $param_subjcode, $param_subjtitle, $param_units, $param_prereq, $param_sem, $param_year, $param_section, $param_slots, $param_day, $param_time, $param_timeend, $param_daylab, $param_timelab, $param_timelabend);
            
            // Set parameters
            $param_subjcode = $subjcode;
            $param_subjtitle = $subjtitle;
            $param_units = $units;
            $param_prereq = $prereq;
            $param_sem = $sem;
            $param_year = $year;
            $param_section = $section;
            $param_slots = $slots;
            $param_day = $day;
            $param_time = $time;
            $param_timeend = $timeend;
            $param_daylab = $daylab;
            $param_timelab = $timelab;
            $param_timelabend = $timelabend;

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: ../schedadd.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Add subject</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Subject Code</label>
                            <input type="text" name="subjcode" class="form-control <?php echo (!empty($subjcode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $subjcode; ?>">
                            <span class="invalid-feedback"><?php echo $subjcode_err;?></span>
                        </div>

                        <div class="input-group">
            <label>Course:&nbsp;</label>
            <select id = "course" name="course" value="<?php echo $course; ?>">
               <option value="BSIT">BSIT</option>
               <option value="BSCS">BSCS</option>
               <option value="BSEDUC">BSEDUC</option>
               <option value="BSBM">BSBM</option>
            </select>
            <label>&emsp; Year level: &nbsp;</label>
            <select id = "year" name="year" value="<?php echo $year; ?>">
               <option value="1">1st</option>
               <option value="2">2nd</option>
               <option value="3">3rd</option>
               <option value="4">4th</option>
            </select>
            <label>&emsp; Section: &nbsp;</label>
            <select id = "section" name="section" value="<?php echo $section; ?>">
               <option value="A">A</option>
               <option value="B">B</option>
               <option value="C">C</option>
               <option value="D">D</option>
               <option value="E">E</option>
            </select>
        </div>

                        
                        <div class="form-group">
                            <label><br>Subject Title</label>
                            <input type="text" name="subjtitle" class="form-control <?php echo (!empty($subjtitle_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $subjtitle; ?>">
                            <span class="invalid-feedback"><?php echo $subjtitle_err;?></span>
                        </div>


                        <div class="input-group">
            <label>&emsp; Sem: &nbsp;</label>
            <select id = "sem" name="sem" value="<?php echo $sem; ?>">
               <option value="1">1st</option>
               <option value="2">2nd</option>
            </select>



            <label> &emsp;No. of Units: &nbsp;</label>
            <select id = "units" name="units" value="<?php echo $units; ?>">
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
            </select>
        </div>

                        <div class="form-group">
                            <label><br>Prerequisite</label>
                            <input type="text" name="prereq" class="form-control <?php echo (!empty($prereq_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $prereq; ?>">
                            <span class="invalid-feedback"><?php echo $prereq_err;?></span>
                        </div>

                        <div class="input-group">
            <label>Day: &nbsp;</label>
            <select id = "day" name="day" value="<?php echo $day; ?>">
               <option value="Monday">Monday</option>
               <option value="Tuesday">Tuesday</option>
               <option value="Wednesday">Wednesday</option>
               <option value="Thursday">Thursday</option>
               <option value="Friday">Friday</option>
               <option value="Saturday">Saturday</option>
            </select>
        </div>
             <label>Starting from: </label>
  <input type="time" id="time" name="time">
             <label>To: </label>
  <input type="time" id="timeend" name="timeend">
                       
                        <div class="input-group">
            <label>Day of Lab: &nbsp;</label>
            <select id = "daylab" name="daylab" value="<?php echo $daylab; ?>">
               <option value="N/A">N/A</option>
               <option value="Monday">Monday</option>
               <option value="Tuesday">Tuesday</option>
               <option value="Wednesday">Wednesday</option>
               <option value="Thursday">Thursday</option>
               <option value="Friday">Friday</option>
               <option value="Saturday">Saturday</option>
            </select>
        </div>
             <label>Starting from: </label>
  <input type="time" id="timelab" name="timelab">
             <label>To: </label>
  <input type="time" id="timelabend" name="timelabend">

                        <br><input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../schedadd.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>