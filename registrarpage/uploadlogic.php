<?php
// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'enrollsemi');

$sql = "SELECT filename, size, downloads from newstudent";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
    $id = $_SESSION["id"];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // mDITO ANG LAST KO
        if (move_uploaded_file($file, $destination)) {
            $sql = "UPDATE newstudent SET filename = '$filename', size = $size, downloads = 0 WHERE id = $id"; 
            //$sql = "INSERT INTO files (name, size, downloads) VALUES ('$filename', $size, 0)";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}

if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM newstudent WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../newstudentpage/uploads/' . $file['filename'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../newstudentpage/uploads/' . $file['filename']));
        readfile('../newstudentpage/uploads/' . $file['filename']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE newstudent SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }

}

else if (isset($_GET['file_id2'])) {
    $id = $_GET['file_id2'];

    // fetch file to download from database
    $sql = "SELECT * FROM newstudent WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../newstudentpage/uploads/' . $file['filename2'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../newstudentpage/uploads/' . $file['filename2']));
        readfile('../newstudentpage/uploads/' . $file['filename2']);

        // Now update downloads count
        $newCount = $file['downloads2'] + 1;
        $updateQuery = "UPDATE newstudent SET downloads2=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }

}