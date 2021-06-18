<!DOCTYPE html>
<html>
<head>
	<title>wew</title>
</head>
<body>
<? PHP

$package = $_GET['package_select'];

          if ($package == 'one') {

              echo "Link 1"; 

            } else if ($package == 'two') {

              echo "Link 2";

            } else {

              echo "No Links";

            }



?>



<form action="filename.php" method="get" id="packageForm" >

    <select name="package_select">
        <option value="">Select package</option>
        <option value="one">One listing</option>
        <option value="two">Two listings</option>
    </select>

    <input id="submitButton" type="submit" value="Submit" />

</form>
</body>
</html>
