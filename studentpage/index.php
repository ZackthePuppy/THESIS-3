<?php
	$db = mysqli_connect('localhost', 'root', '', 'enrollsemi');
$f = "visit.php";
if(!file_exists($f)){
	touch($f);
	$handle =  fopen($f, "w" ) ;
	fwrite($handle,0) ;
	fclose ($handle);
}
 
include('libs/phpqrcode/qrlib.php'); 



if(isset($_POST['submit']) ) {
	$tempDir = 'temp/'; 
	$filename = $_SESSION["lastname"];
	$studentno = $_SESSION["id"];
	$codeContents = urlencode($studentno);  
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);

		$id = trim($_SESSION["id"]);
		$section =  trim($_POST["section"]);
		$year = trim($_SESSION["year"]);
		$sem = trim($_SESSION["sem"]);;
		$lastname = $_SESSION["lastname"];
		$firstname = $_SESSION["firstname"];

		$con = new mysqli('localhost', 'root', '', 'enrollsemi');
		$stmt = $con->prepare("INSERT INTO prereg (section, subjcode, subjtitle, sem, year, units, day, time, timeend, daylab, timelab, timelabend)
			SELECT section, subjcode, subjtitle, sem, year, units, day, time, timeend, daylab, timelab, timelabend
			FROM subject WHERE year = ? and sem = ?;");
		$stmt->bind_param("ss", $year , $sem);
		$stmt->execute();

		$stmt2 = $con->prepare("UPDATE prereg set studentno = ?, lastname = ?, firstname = ? where year = ? and sem = ?;");
		$stmt2->bind_param("sssss", $id, $lastname, $firstname,  $year , $sem);
		$stmt2->execute();


/*
		$con = new mysqli('localhost', 'root', '', 'enrollsemi');
		$stmt = $con->prepare("INSERT INTO prereg (studentno, lastname, firstname, section)
			SELECT id, lastname, firstname, (SELECT section from subject GROUP BY ?) as section
			FROM regular WHERE id = ?");
		$stmt->bind_param("ss", $section , $id);
		$stmt->execute();
		*/
}

?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
	</head>
	<body>
		<div class="myoutput">
			<div class="input-field">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
					<h2>Choose your section</h2>
					<div class="form-group">


            <select id = "section" name="section" value="<?php echo $section; ?>">
			   <option value="BSIT1A">BSIT1A</option>
			   <option value="BSIT1B">BSIT1B</option>
			</select>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Submit and generate QR" class="btn btn-primary submitBtn" style="width:20em; margin:0;" />
					</div>
				</form>
			</div>
			<?php
			if(!isset($filename)){
				$filename = "author";
			}
			?>
			<div class="qr-field">
				<h2 style="text-align:center">Save this QR Code and present it to MIS: </h2>
				<center>
					<div class="qrframe" style="border:2px solid black; width:210px; height:210px;">
							<?php echo '<img src="temp/'. @$filename.'.png" style="width:200px; height:200px;"><br>'; ?>
					</div>
					<a class="btn btn-primary submitBtn" style="width:210px; margin:5px 0;" href="download.php?file=<?php echo $filename; ?>.png ">Download QR Code</a>
				</center>
			</div>
			<div class = "dllink" style="text-align:center;margin:100px 0px 50px 0px;">
				<h4></h4>
			</div>
		</div>
	</body>
</html>