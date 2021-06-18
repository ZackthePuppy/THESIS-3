<?php 
	$db = mysqli_connect('localhost', 'root', '', 'enrollsemi');

	// initialize variables
	$title = "";
	$content = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$title = $_POST['title'];
		$content = $_POST['content'];

		mysqli_query($db, "INSERT INTO events (title, content) VALUES ('$title', '$content')"); 
		$_SESSION['message'] = "Content Added"; 
		header('location: ../registrar.php');
	}

	if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$title = $_POST['title']; $content = $_POST['content'];

	mysqli_query($db, "UPDATE events SET title='$title', content='$content' WHERE id=$id");
	$_SESSION['message'] = "Content updated!"; 
	header('location: ../registrar.php');
	}

	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM events WHERE id=$id");
		$_SESSION['message'] = "Content deleted!"; 
		header('location: ../registrar.php');
	}

	?>