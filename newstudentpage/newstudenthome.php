<?php 
include 'logincheck.php';
include 'uploadlogic.php';

$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>

<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
<link rel="icon" type="image/gif" href="pic/logo.png" sizes="16x16">
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
</head>
<body>
    <?php include 'header.HTML';?>

<div class="content">
    <h1>Hi, <?php echo $_SESSION["lastname"] ;?>! Follow procedures carefully.</h1>

                    <?php
                    // Include config file
                    require_once "../config.php";
                    $id = $_SESSION["id"];
                    // Attempt select query execution
                    $sql = "SELECT * from newstudent where id = $id";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    echo "<h2> Name: " . $row['firstname'] . " " . $row['lastname'] . "</h2>";
                                    echo "<h2> Address: " . $row['address'] . "</h2>";
                                    echo "<h2> Email: " . $row['email'] . "</h2>";
                                    echo "<h2> Strand: " . $row['strand'] . "</h2>"; 
                                    echo "<h2> Preferred Course: " . $row['prefcourse'] . "</h2>"; ?>



                                    <?php

                                	if (($row['exam']) == '0000-00-00' or (empty($row['exam'])) ) { 
                        				echo "<h2>FIRST step: Get all the required requirements. Zip it together and upload it below. <a href='https://support.microsoft.com/en-us/windows/zip-and-unzip-files-8d28fa72-f2f9-712f-67df-f80cf89fd4e5' target='_blank'>How to zip?</a></h2>
                                        <h2>Requirements needed to upload: <br>
                                            1. Softcopy of Report Card <br>
                                            2. Softcopy of Certificate of Good Moral <br>
                                            3. 1 x 1 ID picture <br>
                                            4. Admission form, click <a href='https://cvsu-imus.edu.ph/assets/files/CvSU%20-%20APPLICATION%20FORM%20FOR%20ADMISSION.pdf'>here to download</a> a copy.</h2>";
                                        ?>

                                                  <div class="row" style="margin-top: -5%;" >
                                                    <form action="newstudenthome.php" method="post" enctype="multipart/form-data" >
                                                      <h3>File name must be "SURNAME_requirements"</h3>
                                                      <h3></h3>
                                                      <input type="file" name="myfile"> <br>
                                                      <button type="submit" name="save">upload</button>
                                                    </form>
                                                  </div>



                                            <?php
                                	}
                                	else if ((($row['exam']) != '0000-00-00' or (!empty($row['exam']))) and ((empty($row['verifiedclinic']))) ) {
                                		echo "<h2> GREAT! Your entrance exam are scheduled on " . $row['exam'] . "</h2>";
                                        if (empty($row['result'])){
                                            echo "<h2> Exam Result: Exam not yet taken </h2>";
                                        }
                                        else if (($row['result']) == 'Passed'){
                                            echo "<h2> Exam Result: Congratulations! You passed. </h2>"; 
                                            echo "<h2>Next step, do the following: </h2>
                                        <h2>1. Get the Notice of Admission (NOA) from the guidance. <br>
                                            2. Get the medical referral slip at the campus clinic. <br>
                                            3. Take an interview at the Department of your chosen course, and have the NOA signed from them. <br>
                                            4. Proceed to the date of medical examination </h2>";

                                        if ((($row['examclinic']) == '' or (empty($row['examclinic'])) or ($row['examclinic']) == '0000-00-00') and (($row['verifieddept']) == '' or (empty($row['verifieddept']))) ){
                                            echo "<h2>Clinic: Assessing</h2>
                                                  <h2>Department: Assessing</h2>";  
                                        }
                                        else if ((($row['examclinic']) != '' or (!empty($row['examclinic']))) and (($row['verifieddept']) == '' or (empty($row['verifieddept']))) ){
                                            echo "<h2>Clinic: Your medical examination date is on " . $row['examclinic'] . "</h2>";
                                            echo "<h2>Department: Assessing</h2>";  
                                        }
                                        else if ((($row['examclinic']) == '' or (empty($row['examclinic'])) or ($row['examclinic']) == '0000-00-00') and (($row['verifieddept']) != '' or (!empty($row['verifieddept']))) ){
                                            echo "<h2>Clinic: Assessing</h2>";
                                            echo "<h2>Department: " . $row['verifieddept'] . "</h2>";  
                                        }
                                        else if ((($row['examclinic']) != '' or (!empty($row['examclinic']))) and (($row['verifieddept']) != '' or (!empty($row['verifieddept']))) and (($row['verifiedclinic']) == '' or (empty($row['verifiedclinic']))) ){
                                            echo "<h2>Clinic: Your medical examination date is on " . $row['examclinic'] . "</h2>";
                                            echo "<h2>Department: " . $row['verifieddept'] . "</h2>"; 
                                            echo "<h2>Clinic: Not Yet approved </h2>";
                                        }
                                        else{
                                            echo "Nothing to say";

                                        }
                                    }
                                        else{
                                            echo "<h2> Exam Result: You failed on exam. You're not eligible to enroll. </h2>";?>


                                    <a href="crudexamfreshmen/server.php?del=<?php echo $row['id']; ?>" class="del_btn">Logout and remove account</a>


                                            <?php
                                        }

                                }

                                    else if ((($row['exam']) != '0000-00-00' or (!empty($row['exam']))) and ((!empty($row['verifiedclinic']))) and ((empty($row['verifiedregistrar']))) ){
                                            echo "<h2>Clinic: " . $row['verifieddept'] . "</h2>"; 
                                            echo "<h2>Department: " . $row['verifieddept'] . "</h2>"; 
                                            echo "<h2> Next Step: </h2>
                                                 <h2>1. Make a softcopy of your NOA and medical result.<br></h2>
                                            <h2> 2. Get a copy of <a href='https://cvsu-imus.edu.ph/assets/files/CvSU%20-%20STUDENT%20PROFILE%20FORM%20FOR%20INVENTORY.pdf'>student profile form here</a> and fill it up.</h2>
                                            <h2> 3. Make a zip of your files and submit it below.";
                                        
                                                ?>
                                                  <div class="row" style="margin-top: -5%;" >
                                                    <form action="newstudenthome.php" method="post" enctype="multipart/form-data" >
                                                      <h3>Submit all your requirements here</h3>
                                                      <h3></h3>
                                                      <input type="file" name="myfile2"> <br>
                                                      <button type="submit" name="save2">upload</button>
                                                    </form>
                                                  </div>
                                                <?php
                                            echo "<h2> Status: Waiting for registrar to approve. </h2>";
                                    }

                                    else if (((!empty($row['verifiedregistrar']))) ){
                                        echo "<h2> You are now approved! You can now login to the main login and get your pre-registration there. <br>You can now login to the main login form by clicking  ";
                                     ?>               
                                    <a href="crudexamfreshmen/server.php?try=<?php echo $row['id']; ?>" class="del_btn">here.</a> <?php 

                                    }

                            }



                            // Free result set
                            mysqli_free_result($result);
                        }


                         else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } 
                    else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>


</div>
</body>
</html>