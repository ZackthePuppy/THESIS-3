<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<?php include 'loginaction.php'; ?>

    <div class="wrapper">
<a href="home.php">
<img src="pic/logo.png" alt="CvSU" style='height: 50px; width: 50px; object-fit: contain; position: absolute;'></a>
        <h2>Login</h2>
        <p>Please put your credentials.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
                <p>For new students, please login <a href="loginnewstudent.php"><u>HERE</u></a></p>
            </div>
        </form>
    </div>    


</body>
</html>