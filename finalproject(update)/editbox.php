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
        $query3 = "update tblbox set boxlocation = '$location2' where boxid = '$boxid' ";
        mysqli_query($mysqli, $query3);
        
            if ($mysqli->connect_errno)
                {
                    echo 'connection failed'.$mysqli->connect_error;
                    exit();
                }
                echo '<script language="javascript">';
                echo 'alert("Box Edited Properly")';
                echo '</script>';
                
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
<div class="content2">
    <h2 style="color: white">Delete Box</h2>
    <form name="form1" method="post" onsubmit="return validateForm()" >
                        <div class="col-md-1">
                            <p style="color: white">Box ID</p>
                            <input type="text" name="boxid" disabled="true" id="boxid" class="form-control" placeholder="<?php echo $boxid;?>" value="" />
                        </div>
                        <div class="col-md-3">
                            <p style="color: white">Location</p>
                            <p style="color: white">(Only this field is available to change)</p>
                            <input type="text" name="location" id="location" class="form-control"  onfocus="this.value=''" value="<?php echo $location;?>" />
                        </div>
                        <div class="col-md-2">
                            <p style="color: white">Amount Of Items</p>
                            <input type="text" name="number" disabled="true" id="number" class="form-control" placeholder="<?php echo $number;?>" value="" />
                            <p></p>
                            <input type="submit" class="btn btn-outline-success" name="submit" value="Save" style="align-content: center;" />
                            <p></p>
                            <a href="index.php" class="btn btn-outline-success btn-lg" >Go Home</a>
                        </div>
                    </form>
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