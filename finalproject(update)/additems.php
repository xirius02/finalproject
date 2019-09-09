<?php
session_start();

$usr = $_SESSION['username'];
    if (!isset($usr)) 
    {
      header('Location: login.php');
     exit();
    }
 $amount = "";
    
$boxid = "";

 $boxid = filter_input(INPUT_GET, 'id'); 
 
 $location = filter_input(INPUT_GET, 'location');
 $location2 = filter_input(INPUT_POST, 'location');
 
 
    $item = filter_input(INPUT_POST, 'description');
    $status = filter_input(INPUT_POST, 'status');
 
include 'functions/dbconnect.php';
include 'navbar.html';
include 'sidebar.php';
$mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
$query = "delete from tblbox where boxid = '$boxid' ";


$query2 = "select count('boxid') as count  from tblitem where boxid = '$boxid' ";
$amount = mysqli_query($mysqli, $query2);
$row = $amount->fetch_object();
$number = $row->count;
if ($mysqli->connect_errno)
    {
        echo 'connection failed'.$mysqli->connect_error;
        exit();
    }
    
    if (isset($_POST['submit'])) {
            $query3 = "INSERT INTO tblitem set description = '$item', status = '$status', boxid = '$boxid' ";
        //$query3 = "insert tblitem set (boxlocation = '$location2' where boxid = '$boxid' ";
        mysqli_query($mysqli, $query3);
        
            if ($mysqli->connect_errno)
                {
                    echo 'connection failed'.$mysqli->connect_error;
                    exit();
                }
                echo '<script language="javascript">';
                echo 'alert("Box Edited Properly")';
                echo '</script>';
                
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
      <div class="content2" style="padding: 20px;">
    <h2 style="color: white">Delete Box</h2>
    <table class="table" style="color: white;">
                <thead>
                    <tr>
                        <th scope="col">Box ID</th>
                        <th scope="col">Location</th>
                        <th scope="col">Amount of Items</th>
                    </tr>
                </thead>
                <tbody>
                        <td scope="row"><?php echo $boxid ?></td>
                        <td scope="row"><?php echo $location ?></td>
                        <td scope="row"><?php echo $number ?></td>
                </tbody>
                
                  </table>
    <form name="form1" method="post" onsubmit="return validateForm()" >
                        <div class="col-md-6">
                            <h2 style="color: white">Insert Item</h2>
                            <p style="color: white;">Description</p>
                            <input type="text" name="description" id="description" class="form-control" placeholder="Description" value="" />
                            <p></p>
                            <div class="col-md-18">
                            <p style="color: white;">Status</p>
                            <select class="form-control col-md-2" id="status" name="status" >
                                <option>In Box</option>
                                <option>In Use</option>
                              </select>
                        </div>
                            <div class="col-md-18">
                                <p></p>
                                <a href="index.php" class="btn btn-outline-danger" >Go Home</a>
                            <input type="submit" class="btn btn-outline-success" name="submit" value="Insert" style="align-content: center;" />
                            </div>
                    </form>
        </div>
</div>
<script>
function validateForm() {
  var x = document.forms["form1"]["description"].value;
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