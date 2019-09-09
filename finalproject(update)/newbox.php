<?php 
session_start();

$usr = "";
$usr = $_SESSION['username'];
    if (!isset($usr)) 
    {
      header('Location: login.php');
      exit();
    }
    $boxid = "";
    $location = "";
    
include 'functions/functions_1.php';
include 'functions/dbconnect.php';
include 'navbar.html';
include 'sidebar.php';

?>

<?php 
/*if (isset($_GET['submit'])) {
    try
    {
    $db = getDatabase();
    
    $boxid = filter_input(INPUT_GET, 'boxid');
    
    $location = filter_input(INPUT_GET, 'location');
    
    
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
           $query = "INSERT INTO tblbox set boxid = '$boxid', boxlocation = '$location' ";
            $result = mysqli_query($mysqli, $query);
    
            //header("location: newitems.php?$boxid");
            
    }
    catch (Exception $ex)
    {
         echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
     
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
                    <h3>Create New Box</h3>
                    <form name="form1" method="GET" action="newitems.php?<?php echo $boxid.' '.$location?>" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label style="color: white; font-family: sans-serif;">Box ID</label>
                            <input type="text" name="boxid" id="boxid" class="form-control" placeholder="Box ID" value="" />
                        </div>
                        <div class="form-group">
                            <label style="color: white; font-family: sans-serif;">Box Location</label>
                            <input type="text" name="location" id="location" class="form-control" placeholder="Location" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="btnSubmit" value="Create Box" />
                        </div>
                    </form>
                </div>
                </div>
</div>
    </div>
<script>
function validateForm() {
  var x = document.forms["form1"]["boxid"].value;
  var y = document.forms["form1"]["location"].value
  if (x == "" || y == "") {
    alert("all fields must be filled out");
    return false;
  }
}
</script>
</html>
