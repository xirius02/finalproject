<?php
session_start();

$usr = $_SESSION['username'];
    if (!isset($usr)) 
    {
      header('Location: login.php');
     exit();
    }
    
    include 'functions/dbconnect.php';
include 'navbar.html';
include 'sidebar.php';

 $amount = "";
    
$boxid = "";

 $boxid = filter_input(INPUT_GET, 'id'); 
 
 $location = filter_input(INPUT_GET, 'location');
 $location2 = filter_input(INPUT_POST, 'location');
 

$mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
$query = "select * from tblbox where boxid = '$boxid' ";


$query2 = "select count('boxid') as count  from tblitem where boxid = '$boxid' ";
$query3 = "select * from tblitem where boxid = '$boxid' ";

$amount = mysqli_query($mysqli, $query2);
$row = $amount->fetch_object();
$number = $row->count;
if ($mysqli->connect_errno)
    {
        echo 'connection failed'.$mysqli->connect_error;
        exit();
    }
    
   if($res = $mysqli->query($query)) {
         $ret = [];
        while($row = $res->fetch_assoc()) {
          $ret[] = $row;
         }
            $id = ($ret[0]['boxid']);
         } else {
              echo $mysqli->error;
         }
         
          if($res2 = $mysqli->query($query3)) {
         $ret2 = [];
        while($row2 = $res2->fetch_assoc()) {
          $ret2[] = $row2;
         }
            $id2 = ($ret2[0]['boxid']);
         } else {
              echo $mysqli->error;
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
      <div class="content1" style="padding: 20px;">
            <h2 style="text-align: center; color: white;">Box Info</h2>
            <table class="table table-hover table-dark" style="color: white;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Box ID</th>
                        <th scope="col">Location</th>
                        <th scope="col">Amount of Items</th>
                    </tr>
                </thead>
                <tbody>
            <?php if(isset($res)) foreach ($res as $row): ?>
                    <tr>
                        <td scope="row"><?php echo $row['ID'] ?></td>
                        <td scope="row"><?php echo $row['boxid'] ?></td>
                        <td scope="row"><?php echo $row['boxlocation'] ?></td>
                        <?php
                            $number = "";
                            $changeid = $row['boxid'];
                            $query2 = "select count('boxid') as count  from tblitem where boxid = '$changeid' ";
                            $amount = mysqli_query($mysqli, $query2);
                            $row = $amount->fetch_object();
                            $number = $row->count;
                            ?>
                        <td scope="row"><?php echo $number; ?></td>
    
            <?php endforeach; ?>
                    </tr>
                </tbody>
                
                  </table>
            
<div class="content3">
            <h2 style="text-align: center; color: white;">List Of Items</h2>
            <table class="table table-hover table-dark" style="color: white;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Box ID</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
            <?php if(isset($res2)) foreach ($res2 as $row2): ?>
                    <tr>
                        <td scope="row"><?php echo $row2['ID'] ?></td>
                        <td scope="row"><?php echo $row2['description'] ?></td>
                        <td scope="row"><?php echo $row2['status'] ?></td>
                        <td scope="row"><?php echo $row2['boxid'] ?></td>
                            <td>
                                <a href="edititem.php?id=<?php echo $row2['ID'] ?>&boxid=<?php echo $row2['boxid']?>&location=<?php echo $location?>" class="btn btn-outline-success btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >Edit</a>
                                <a href="moveitem.php?id=<?php echo $row2['ID'] ?>&boxid=<?php echo $row2['boxid']?>" class="btn btn-outline-success" data-title="Delete" data-toggle="modal" data-target="#delete" >Move Item</a>
                                <a href="deleteitem.php?id=<?php echo $row2['ID'] ?>&boxid=<?php echo $row2['boxid']?>" class="btn btn-outline-danger" data-title="Delete" data-toggle="modal" data-target="#delete" >Delete Item</a>
                        </td>
            <?php endforeach; ?>
                    </tr>
                </tbody>
                  </table>
            <a  style="margin-left: 42%; " href="index.php" class="btn btn-outline-success btn-lg" >Go Home</a>
            <p></p>
            <a style="margin-left: 42%; " href="additems.php?id=<?php echo $boxid;?>&location=<?php echo $location?>" class="btn btn-outline-success btn-lg" >New Item</a>
            </div>
            </div>
<script>
function validateForm() {
  var x = document.forms["form1"]["location"].value;
  if (x == "") {
    alert("all fields must be filled out");
    return false;
  }
  if (x != "") {
      document.getElementById("form1").submit();
    }
  }
</script>
</body>
</html>