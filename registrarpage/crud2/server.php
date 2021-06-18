<?php 
	$db = mysqli_connect('localhost', 'root', '', 'enrollsemi');

	// initialize variables
	$month = "";
	$day = "";
	$exam = "";
	$lastname = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$exam = $_POST['exam'];

		mysqli_query($db, "INSERT INTO events (exam) VALUES ('$exam'"); 
		$_SESSION['message'] = "Content Added"; 
		header('location: ../editfreshmen.php');
	}

	if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$exam = (("2021") . "-" . $_POST['month'] . "-" . $_POST['day']);   

	mysqli_query($db, "UPDATE newstudent SET exam='$exam' WHERE id=$id");
	$_SESSION['message'] = "Content updated!"; 
	header('location: ../editfreshmen.php');
	}


	?>