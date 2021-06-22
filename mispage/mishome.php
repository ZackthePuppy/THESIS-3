<?php include 'logincheck.php';?>
<?php include 'uploadlogic.php';?>

<?php include 'crudmis/server.php'; ?>


<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="icon" type="image/gif" href="pic/logo.png" sizes="16x16">
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
        <div class="container" style="margin-top: 1%;">
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
    <thead>
        <tr>
            <th>Lastname&nbsp;</th>
            <th>Firstname&nbsp;</th>
            <th>Email&nbsp;</th>
            <th>Verification&nbsp;</th>
            <th>Files&nbsp;</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php if (($row['verifiedregistrar']) == '' or (empty($row['verifiedregistrar']))) { 
                                        echo "Not yet";
                                    }
                else
                echo $row['verifiedregistrar']; ?></td>
            <td><?php echo $row['filename2']; ?></td>
            <td><a href="verifyfreshmen.php?file_id2=<?php echo $row['id'] ?>">Download</a></td>
            <td>
                <a href="verifyfreshmen.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
            </td>
        </tr>
    <?php } ?>
</table>                



<?php               
            }
        }
?>


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