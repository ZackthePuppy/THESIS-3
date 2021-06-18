<?php
// Include config file
require_once "config.php";
 
// Initialize natin yung 6 variables para sa mga input
$username = $password = $firstname = $lastname = $email = $gender = $address = $schoolgrad = $strand = $prefcourse = "";
$username_err = $password_err = $firstname_err = $lastname_err = $email_err = $gender_err = $address_err = $schoolgrad_err = $strand_err = $prefcourse_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Username can't be empty!";     
    }
    else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Password can't be empty!";     
    } 
    elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must atleast 8 characters.";
    } 
    else{
        $password = trim($_POST["password"]);
    }

    //checking if wala kang nilagay, pag meron, i-i-store na nya
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter firstname";     
    } 
    else{
        $firstname = trim($_POST["firstname"]);
    }

    //checking if wala kang nilagay, pag meron, i-i-store na nya
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter lastname";     
    } 
    else{
        $lastname = trim($_POST["lastname"]);
    }

    //checking if wala kang nilagay, pag meron, i-i-store na nya
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email address";     
    } 
    else{
        $email = trim($_POST["email"]);
    }

    //checking if wala kang nilagay, pag meron, i-i-store na nya
    if(empty(trim($_POST["gender"]))){
        $gender_err = "Select your gender";     
    } 
    else{
        $gender = trim($_POST["gender"]);
    }

    //checking if wala kang nilagay, pag meron, i-i-store na nya
    if(empty(trim($_POST["address"]))){
        $address_err = "Put your address that you're living in";     
    } 
    else{
        $address = trim($_POST["address"]);
    }

    //checking if wala kang nilagay, pag meron, i-i-store na nya
    if(empty(trim($_POST["schoolgrad"]))){
        $schoolgrad_err = "Put your school where you graduated";     
    } 
    else{
        $schoolgrad = trim($_POST["schoolgrad"]);
    }

    if(empty(trim($_POST["strand"]))){
        $strand_err = "Put your strand";     
    } 
    else{
        $strand = trim($_POST["strand"]);
    }

    if(empty(trim($_POST["prefcourse"]))){
        $prefcourse_err = "Put your preferred course";     
    } 
    else{
        $prefcourse = trim($_POST["prefcourse"]);
    }



    // Check mga input errors bago ilagay sa database
    if(empty($username_err) && empty($password_err) && empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($gender_err) && empty($address_err) && empty($schoolgrad_err) && empty($strand_err)){
        
        // Prepare an insert statement yung sa mysql
        $sql = "INSERT INTO newstudent (username, password, firstname, lastname, email, gender, address, schoolgrad, strand, prefcourse) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_username, $param_password, $param_firstname, $param_lastname, $param_email, $param_gender, $param_address, $param_schoolgrad, $param_strand, $param_prefcourse);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_gender = $gender;
            $param_address = $address; 
            $param_schoolgrad = $schoolgrad;
            $param_strand = $strand;
            $param_prefcourse = $prefcourse;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page pag success
                echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Process completed. Please login your temporary account to see your status.')
                    window.location.href='newstudent.php';
                    </script>");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>