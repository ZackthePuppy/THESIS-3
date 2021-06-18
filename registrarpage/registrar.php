<?php include 'logincheck.php';?>
<?php include 'crud/server.php'; ?>

<?php 
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $record = mysqli_query($db, "SELECT * FROM events WHERE id=$id");

        if (count($record) == 1 ) {
            $n = mysqli_fetch_array($record);
            $title = $n['title'];
            $content = $n['content'];
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="icon" type="image/gif" href="pic/logo.png" sizes="16x16">
</head>
<body>

    <?php include 'header.HTML';?>

<div class="content">
    <h3>Manage current events</h3>

    
<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>



    <?php $results = mysqli_query($db, "SELECT * FROM events"); ?>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th colspan="2">Date added</th>
        </tr>
    </thead>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['content']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a href="registrar.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
            </td>
            <td>
                <a href="crud/server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

    <form method="post" action="crud/server.php" >
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo $title; ?>">
        </div>
        <div class="input-group">
            <label>Content</label>
            <input type="text" name="content" value="<?php echo $content; ?>">
        </div>
        <div class="input-group">

            <?php if ($update == true): ?>
    <button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
<?php else: ?>
    <button class="btn" type="submit" name="save" >Add</button>
<?php endif ?>
        </div>

    </form>




</div>

</body>
</html>