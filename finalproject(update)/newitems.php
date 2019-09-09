<?php 
session_start();

$usr = $_SESSION['username'];
    if (!isset($usr)) 
    {
      header('Location: login.php');
      exit();
    }
    $boxid = "";
    $location = "";
    
    $boxid = $_GET['boxid'];
    $location = $_GET['location'];
    
include 'functions/functions_1.php';
include 'functions/dbconnect.php';
include 'navbar.html';
include 'sidebar.php';

?>

<?php 
if (isPostRequest()) {
    $db = getDatabase();
    
    
    $item = filter_input(INPUT_POST, 'item');
    
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
            $query = "INSERT INTO tblbox set boxid = '$boxid', boxlocation = '$location' ";
            $query2 = "INSERT INTO tblitem set description = '$item', status = 'In Box', boxid = '$boxid' ";
            $result = mysqli_query($mysqli, $query);
            $result2 = mysqli_query($mysqli, $query2);
             
            echo '<script language="javascript">';
            echo 'alert("Box and Item Inserted Correctly")';
            echo '</script>';
            header("location: index.php");
            } /*else {
            echo '<script language="javascript">';
            echo 'alert("Box and Item Not Inserted Correctly, please check")';
            echo '</script>';
            echo $mysqli->error;
 }*/

?>

<html>
    <head>
        <title>Boxit</title>
    </head>
<link rel="stylesheet" type="text/css" href="style/loginstyle.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="content2">
<div class="container col-md-6" style="margin-left: 35%; margin-top: 5%; ">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Insert New Item</h3>
                    <form name="form1" method="post" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label style="color: white; font-family: sans-serif;">Box ID</label>
                            <input type="text" disabled="true" name="boxid" id="boxid" class="form-control" placeholder="<?php echo $boxid;?>" value="" />
                        </div> 
                        <div class="form-group">
                            <label style="color: white; font-family: sans-serif;">Box Location</label>
                            <input type="text" disabled="true" name="boxid" id="boxid" class="form-control" placeholder="<?php echo $location;?>" value="" />
                        </div>
                        <div class="form-group">
                            <label style="color: white; font-family: sans-serif;">New Item Description</label>
                            <input type="text" name="item" id="item" class="form-control" placeholder="Item" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Insert Item" />
                        </div>
                    </form>
                </div>
                </div>
</div>
</div>
<script>
function validateForm() {
  var x = document.forms["form1"]["item"].value;
  if (x == "" ) {
    alert("all fields must be filled out");
    return false;
  }
}
</script>
</html>
