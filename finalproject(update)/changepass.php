<?php
session_start();

include 'functions/functions_1.php';
include 'functions/dbconnect.php';
include 'navbar.html';

$usr= "";
$usr = $_SESSION['username'];



    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $newpassword = filter_input(INPUT_POST, 'newpassword');
    
    $query = "SELECT * FROM tblusers where username = '$usr' ";
    
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
    
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
            $oldpass = ($ret[0]['password']);
            $id = ($ret[0]['ID']);
         } else {
              echo $mysqli->error;
         }
 
    if (isPostRequest()) {
        if ($password == $oldpass) {
            $mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
            $query2 = "update tblusers set password = '$newpassword' where ID = '$id' ";
            
            if (mysqli_query($mysqli, $query2)) {
                echo '<script language="javascript">';
                echo 'alert("Password Changed Succesfully")';
                echo '</script>';
                header('location: settings.php');
               }
        } else {
                echo '<script language="javascript">';
                echo 'alert("Error Changing the Password")';
                echo '</script>';
               }
    }

?>
<html>
<link rel="stylesheet" type="text/css" href="style/loginstyle.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Login</h3>
                    <form name="form1" method="post" onsubmit="return validateForm()">
                        <div class="form-group">
                            <p style="color: white">Username</p>
                            <input type="text" name="username" disabled="true" id="username" class="form-control" placeholder="<?php echo $usr;?>" value="" />
                        </div>
                        <div class="form-group">
                            <p style="color: white">Old Password</p>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Old password" value="" />
                        </div>
                        <div class="form-group">
                            <p style="color: white">New Password</p>
                            <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="New Password" value="" />
                        </div>
                        <div class="form-group">
                            <p style="color: white">Confirm Password</p>
                            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirm Password" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-outline-danger" value="Change Password" style="align-content: center;" />
                        </div>
                    </form>
                </div>
            </div>
</div>

<script>
function validateForm() {
  var z = document.forms["form1"]["confirmpassword"].value;
  var x = document.forms["form1"]["newpassword"].value;
  var y = document.forms["form1"]["password"].value
  if (x != z) {
      
    alert("New Password must match");
    return false;
}
  
  if (x == "" || y == "") {
    alert("all fields must be filled out");
    return false;
  }
  if (x != "" || y != "") {
    var ans = confirm('Are you sure you want to change the password?');
    if (ans == false) {
            return false;
        }
    }
}
</script>
</html>