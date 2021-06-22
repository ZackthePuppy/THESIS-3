<?php include 'logincheck.php';?>
<?php include 'uploadlogic.php';?>

<?php include 'crudmis/server.php'; ?>


<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="icon" class="no-print" type="image/gif" href="pic/logo.png" sizes="16x16">
</head>
<body>

    <?php include 'header.HTML';?>

<html>
    <head>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    </head>
    <body>
        <div class="container no-print" style="margin-top: 1%;">
        <form style="width: 40%; height: 50% !important" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row"
>                <div class="col-md-6" style="text-align: center;">
                    <video id="preview" width="20%" height="40%"></video>
                </div>
                <div class="col-md-6" style="text-align: center;" >
                    <label>SCAN QR CODE</label>
                    <input type="text" name="text" id="text" readonyy="" placeholder="scan qrcode" class="form-control">
                
                </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Enter">
            </div>

        </form>
        </div>


<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $text = "";
            if(empty(trim($_POST["text"]))){
                $text_err = "<h2> Not scanned </h2>";
            } else{
                $text = trim($_POST["text"]);
?>


<?php $results = mysqli_query($db, "SELECT * FROM prereg where studentno = $text"); ?>

<table>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><h2>Name: <?php echo $row['lastname'] . ", " . $row['firstname']; ?></h2></td>
            <td><h2>Section: <?php echo $row['section']; ?></h2></td>
            <td><h2>Student No: <?php echo $row['studentno']; ?></h2></td>
        </tr>
    <?php } ?>

<?php  $section = "SELECT (section) from prereg where studentno = $text"; 
    $results = mysqli_query($db, "SELECT * FROM subject where section = 'BSIT1A'"); ?>
<table>
    
        <tr>
            <th>Subject Code&nbsp;</th>
            <th>Subject Title&nbsp;</th>
            <th>Unit&nbsp;</th>
            <th>Day&nbsp;</th>
            <th>Time&nbsp;</th>
            <th>Day (Lab)&nbsp;</th>
            <th>Time (Lab)&nbsp;</th>
        </tr>
    <?php while ($row = mysqli_fetch_array($results)) { ?>

        <tr>
            <td><?php echo $row['subjcode']; ?></td>
            <td><?php echo $row['subjtitle']; ?></td>
            <td><?php echo $row['units']; ?></td>
            <td><?php echo $row['day']; ?></td>
            <td><?php echo $row['time'] . $row['timeend']; ?></td>
            <td><?php echo $row['daylab']; ?></td>
            <td><?php if ( (($row['timelab']) == '00:00:00' or (empty($row['timelab']))) and (($row['timelabend']) == '00:00:00' or (empty($row['timelabend']))) ){ 
                                        echo "N/A";
                                    }
                else
                echo $row['timelab'] . "-" . $row['timelabend']; ?></td>
        </tr>

    <?php } ?>
</table>

</table>                



<?php               
            }
        }
?>
<div class="container" style="">
<button class="no-print" style="float: center;" onClick="window.print()">Print this page</button>
</div>
        <script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
               } else{
                   alert('No cameras found');
               }

           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('text').value=c;
           });

        </script>
    </body>
</html>




</body>
</html>