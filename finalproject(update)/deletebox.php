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
        $delquery = "delete from tblitem where boxid = '$boxid' ";
        $itemdeletequery = "delete from tblbox where boxid = '$boxid' ";
        $mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
        mysqli_query($mysqli, $delquery);
        mysqli_query($mysqli, $itemdeletequery);
         if ($mysqli->connect_errno)
            {
                echo 'connection failed'.$mysqli->connect_error;
                exit();
            }
            header('location: index.php');
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
                        <div class="col-md-1">
                            <p style="color: white">Box ID</p>
                            <input type="text" name="username" disabled="true" id="username" class="form-control" placeholder="<?php echo $boxid;?>" value="" />
                        </div>
                        <div class="col-md-3">
                            <p style="color: white">Location</p>
                            <input type="text" name="username" disabled="true" id="username" class="form-control" placeholder="<?php echo $location;?>" value="" />
                        </div>
                        <div class="col-md-2">
                            <p style="color: white">Amount Of Items</p>
                            <input type="text" name="username" disabled="true" id="username" class="form-control" placeholder="<?php echo $number;?>" value="" />
                            <p></p>
                        </div>
                            <div class="col-md-18">
                                <p></p>
                            <a href="index.php" class="btn btn-outline-success btn-lg" >Go Home</a>
                            <p></p>
                            <input type="submit" class="btn btn-outline-danger" name="submit" value="Delete Box" style="align-content: center;" />
                            </div>
                        <div class="col-md-2">
                            <p></p>
                        </div>
                    </form>
        </div>
</div>
<script>
function deletefunction() {
  var r = confirm("This will permanently delete the box and its items");
  if (r == true) {
      document.getElementById("form1").submit();
  } else {
            return false;
  }
}
</script>
</body>
</html>