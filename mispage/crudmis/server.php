<?php 
	$db = mysqli_connect('localhost', 'root', '', 'enrollsemi');

	// initialize variables
	$month = "";
	$day = "";
	$examclinic = "";
	$lastname = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$examclinic = $_POST['examclinic'];

		mysqli_query($db, "INSERT INTO events (examclinic) VALUES ('$examclinic'"); 
		$_SESSION['message'] = "Content Added"; 
		header('location: ../clinichome.php');
	}

	if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$examclinic = (("2021") . "-" . $_POST['month'] . "-" . $_POST['day']);   

	mysqli_query($db, "UPDATE newstudent SET examclinic='$examclinic' WHERE id=$id");
	$_SESSION['message'] = "Content updated!"; 
	header('location: ../clinichome.php');
	}

	if (isset($_POST['update2'])) {
	$id = $_POST['id'];
	$verifiedclinic = $_POST['verifiedclinic']; 

	mysqli_query($db, "UPDATE newstudent SET verifiedclinic='$verifiedclinic' WHERE id=$id");
	$_SESSION['message'] = "Content updated!"; 
	header('location: ../examclinic.php');
	}

	?>