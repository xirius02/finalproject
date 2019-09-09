<?php
if (isset($_SESSION['username'])) {
    session_destroy();
}
include 'functions/functions_1.php';
include 'functions/dbconnect.php';

?>
<html>
    <head>
        <title>Boxit</title>
    </head>

<link rel="stylesheet" type="text/css" href="style/loginstyle.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php 
if (isPostRequest()) {
    try
    {
    $db = getDatabase();
    $username = filter_input(INPUT_POST, 'username');
    
    $password = filter_input(INPUT_POST, 'password');
    $email = filter_input(INPUT_POST, 'email');
    
    
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
            $query = "SELECT * FROM tblusers where username = '$username' ";
            $query2 = "SELECT * FROM tblusers where email = '$email' ";
            $result = mysqli_query($mysqli, $query);
            $result2 = mysqli_query($mysqli, $query2);
            
            $insertion = "INSERT INTO tblusers SET username = '$username', password = '$password',  picture = '1.png' , email = '$email'";
            
            if (mysqli_num_rows($result) != 0 || mysqli_num_rows($result2) != 0) {
                echo '<script language="javascript">';
                echo 'alert("The Email or Username is already in use, please try again.")';
                echo '</script>';
            } else {
                mysqli_query($mysqli, $insertion);
                echo '<script language="javascript">';
                echo 'alert("User created succesfully")';
                echo '</script>';
            }
            
    }
    catch (Exception $ex)
    {
         echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
     
 }

?>
<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Create New User</h3>
                    <form name="form1" method="post" onsubmit="return validateForm()">
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Create User" />
                        </div>
                    </form>
                        <div class="form-group">
                            <button type="text" class="btnSubmit" value="login" onclick="window.location.href='login.php'">Login Page</button>
                        </div>
                </div>
                </div>
</div>

<script>
function validateForm() {
  var x = document.forms["form1"]["username"].value;
  var y = document.forms["form1"]["password"].value;
  var z = document.forms["form1"]["email"].value;
  if (x == "" || y == "" || z == "") {
    alert("all fields must be filled out");
    return false;
  }
}
</script>
</html>
