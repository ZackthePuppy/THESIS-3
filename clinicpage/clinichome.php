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
    <h1>CLINIC</h1>

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

                                    <h2>Save this QR code in case you forgot your credentials.</h2>
                                <img src="../pic/qr.png" width="100" height="100">


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
                                	else {
                                		echo "<h2> GREAT! Your entrance exam are scheduled on " . $row['exam'] . "</h2>";
                                        if (empty($row['result'])){
                                            echo "<h2> Exam Result: Exam not yet taken </h2>";
                                        }
                                        else if (($row['result']) == 'Passed'){
                                            echo "<h2> Exam Result: Congratulations! You passed. </h2>"; ?>

                                            <div class="container">
                                                  <div class="row">
                                                    <form action="newstudenthome.php" method="post" enctype="multipart/form-data" >
                                                      <h3>Upload the Requirements</h3>
                                                      <input type="file" name="myfile"> <br>
                                                      <button type="submit" name="save">upload</button>
                                                    </form>
                                                  </div>
                                                </div>



                                            <?php

                                        if (($row['verified']) == '' or (empty($row['verified']))){
                                            echo "<h2> Waiting for verification of your requirements.</h2>"; 

                                        }
                                        else{
                                            echo "<h2> Your requirements are verified. You can now enroll and enter your credentials in main login by clicking below.</h2>"; ?>
                                    <a href="crudexamfreshmen/server.php?try=<?php echo $row['id']; ?>" class="del_btn">Logout</a>
                                    <?php
                                        }
                                    }
                                        else{
                                            echo "<h2> Exam Result: You failed on exam. You're not eligible to enroll. </h2>";?>


                                    <a href="crudexamfreshmen/server.php?del=<?php echo $row['id']; ?>" class="del_btn">Logout and remove account</a>


                                            <?php
                                        }

                                }}



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