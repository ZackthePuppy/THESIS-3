<?php 
	$db = mysqli_connect('localhost', 'root', '', 'enrollsemi');

	// initialize variables
	$result = "";
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
	$result = $_POST['result']; 

	mysqli_query($db, "UPDATE newstudent SET result='$result' WHERE id=$id");
	$_SESSION['message'] = "Content updated!"; 
	header('location: ../examfreshmen.php');
	}

	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM newstudent WHERE id=$id");
		session_start();
		 
		// Unset all of the session variables
		$_SESSION = array();
		 
		// Destroy the session.
		session_destroy();
		 
		// Redirect to login page
		header("location: ../../home.php");
		exit;
	}

	if (isset($_GET['try'])) {
		$id = $_GET['try'];
		mysqli_query($db, "INSERT INTO regular (id, username, password, firstname, lastname, email)
			SELECT concat('2021', id) as id, username, password, firstname, lastname, email
			FROM newstudent WHERE id = $id");
		mysqli_query($db, "DELETE FROM newstudent WHERE id=$id");
		session_start();
		 
		// Unset all of the session variables
		$_SESSION = array();
		 
		// Destroy the session.
		session_destroy();
		 
		// Redirect to login page
		header("location: ../../login.php");
		exit;
	}

	?>