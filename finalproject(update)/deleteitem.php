<?php
session_start();

$usr = $_SESSION['username'];
    if (!isset($usr)) 
    {
      header('Location: login.php');
     exit();
    }
 $amount = "";
    
$id = "";

 $id = filter_input(INPUT_GET, 'id'); 
 $boxid = filter_input(INPUT_GET, 'boxid'); 
 
 //$location = filter_input(INPUT_GET, 'location');
 
include 'functions/dbconnect.php';
include 'navbar.html';
include 'sidebar.php';
$mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
$query = "select * from tblitem where ID = '$id' ";

if($res = $mysqli->query($query)) {
         $ret = [];
        while($row = $res->fetch_assoc()) {
          $ret[] = $row;
         }
            $id2 = ($ret[0]['boxid']);
         } else {
              echo $mysqli->error;
         }
         
/*$amount = mysqli_query($mysqli, $query2);
$row = $amount->fetch_object();
$number = $row->count;*/



 if ($mysqli->connect_errno)
    {
        echo 'connection failed'.$mysqli->connect_error;
        exit();
    }

    if (isset($_POST['submit'])) {
        $delquery = "delete from tblitem where ID = '$id' ";
        $mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
        mysqli_query($mysqli, $delquery);
         if ($mysqli->connect_errno)
            {
                echo 'connection failed'.$mysqli->connect_error;
                exit();
            }
            header("location: viewbox.php?id=$boxid");
}

?>

<html>
    <head>
        <title>Boxit</title>
<link rel="stylesheet" type="text/css" href="style/loginstyle.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
<div class="content">
    <h2 style="color: white">Delete Box</h2>
    <form name="form1" method="post" onsubmit="return deletefunction()" >
                <div class="content3">
                        <h2 style="text-align: center; color: white;">List Of Items</h2>
                        <table class="table table-hover table-dark" style="color: white;">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Box ID</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php if(isset($res)) foreach ($res as $row): ?>
                                <tr>
                                    <td scope="row"><?php echo $row['ID'] ?></td>
                                    <td scope="row"><?php echo $row['description'] ?></td>
                                    <td scope="row"><?php echo $row['status'] ?></td>
                                    <td scope="row"><?php echo $row['boxid'] ?></td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
                  </table>
                        <div class="col-md-18" style="margin-left: 42%;">
                                <p></p>
                                <a href="index.php" class="btn btn-outline-success" >Go Home</a>
                            <input type="submit" class="btn btn-outline-danger" name="submit" value="Delete" style="align-content: center;" />
                            </div>
                    </form>
        </div>
</div>
<script>
function deletefunction() {
  var r = confirm("This will permanently delete the item");
  if (r == true) {
      document.getElementById("form1").submit();
  } else {
            return false;
  }
}
</script>
</body>
</html>