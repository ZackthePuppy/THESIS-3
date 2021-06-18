<?php 
	$db = mysqli_connect('localhost', 'root', '', 'enrollsemi');

	// initialize variables
	$verified = "";
	$lastname = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$result = $_POST['result'];

		mysqli_query($db, "INSERT INTO events (result) VALUES ('$result'"); 
		$_SESSION['message'] = "Content Added"; 
		header('location: ../editfreshmen.php');
	}

	if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$verified = $_POST['verified']; 

	mysqli_query($db, "UPDATE newstudent SET verified='$verified' WHERE id=$id");
	$_SESSION['message'] = "Content updated!"; 
	header('location: ../verifyfreshmen.php');
	}


	?>