<?php 
	$db = mysqli_connect('localhost', 'root', '', 'enrollsemi');

	// initialize variables
	$verifieddept = "";
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
	$verifieddept = $_POST['verifieddept']; 

	mysqli_query($db, "UPDATE newstudent SET verifieddept='$verifieddept' WHERE id=$id");
	$_SESSION['message'] = "Content updated!"; 
	header('location: ../deptIT.php');
	}


	?>