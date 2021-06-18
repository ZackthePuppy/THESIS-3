<!DOCTYPE html>
<html>
<head>
	<title>NEW STUDENT</title>
	<link rel="stylesheet" type="text/css" href="css/newstudent.css">
</head>
<body>
	<?php include 'header.HTML'; ?>
	<?php include 'newstudentaction.php'; ?>

    <div class="wrapper">
        <h2>Request a schedule for entrance exam</h2>
        <form id="myFormId" action="" method="post" >

                <label>Username</label>
            <div>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  

            <div>
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>

                <label>Firstname</label>
   
            <div>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $firstname_err; ?></span>
            </div>

                <label class="last">Lastname</label>
            <div>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname_err; ?></span>
            </div> 

                <label>Email Address</label>
            <div>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>

                <label>Gender:</label>
            <div>
                <select name="gender">
                <option></option>
                <option>Male</option>
                <option>Female</option>
                </select>
                <span class="help-block"><?php echo $gender_err; ?></span>
            </div>  

                <label>Address</label>
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                <span class="help-block"><?php echo $address_err; ?></span>
            </div>

                <label>School Graduated</label>
            <div class="form-group <?php echo (!empty($schoolgrad_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="schoolgrad" class="form-control" value="<?php echo $schoolgrad; ?>">
                <span class="help-block"><?php echo $schoolgrad_err; ?></span>
            </div>

            <label>Strand:</label>
            <div>
                <select name="strand">
                <option></option>
                <option>STEM</option>
                <option>HUMSS</option>
                <option>GAS</option>
                <option>ABM</option>
                <option>TVL</option>
                </select>
                <span class="help-block"><?php echo $strand_err; ?></span>
            </div>  

            <label>Preferred Course:</label>
            <div>
                <select name="prefcourse">
                <option></option>
                <option>BSIT</option>
                <option>BSCS</option>
                <option>BSED</option>
                </select>
                <span class="help-block"><?php echo $prefcourse_err; ?></span>
            </div>  

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" onclick="resetForm('myFormId'); return false;" class="btn btn-default" value="Clear">
            </div>

        </form>
    </div>    

</div>
</div>


</body>

<script src="js/clear.js"></script>
</html>