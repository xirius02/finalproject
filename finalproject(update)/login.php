<?php
if (isset($_SESSION['username'])) {
    session_destroy();
}

include 'functions/functions_1.php';
include 'functions/dbconnect.php';

?>
<html>

<link rel="stylesheet" type="text/css" href="style/loginstyle.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php 
if (isPostRequest()) {
    try
    {
    $db = getDatabase();
    $message = "";
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $stmt = $db->prepare("select username, password from tblusers where username = :username and password = :password");
    $results = array();
    $binds = array(
        ":username" => $username,
        ":password" => $password
    );
    if ($stmt->execute($binds)) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    if (count($results) < 1) {
        $message = "invalid Username or Password";
        
    }else if ($username == $results[0]['username'] && $password == $results[0]['password']) 
                    {
        
        session_start();
        $_SESSION['username'] = $results[0]['username'];
        header('location: index.php');
                    }
    }
    catch (Exception $ex)
    {
         echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    
}

?>
<div class="container login-container">
                <div class="col-lg-6 login-form-1"  style="margin-left: 25%; margin-right: 25%; ">
                    <h3>Login</h3>
                    <form name="form1" method="post" onsubmit="return validateForm()">
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="" />
                        </div>
                        <div class="mess" style="text-align: center">
                        <?php if (isPostRequest()) { echo "<p><font color=white align>".$message."</font> </p>";                   }?>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                            <a href="forgotpass.php" class="btnForgetPwd">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            <a href="newuser.php" class="btnNewUsr">Create New User</a>
                        </div>
                    
                    </form>
                </div>
                </div>

<script>
function validateForm() {
  var x = document.forms["form1"]["username"].value;
  var y = document.forms["form1"]["password"].value
  if (x == "" || y == "") {
    alert("all fields must be filled out");
    return false;
  }
}
</script>
<style>
    
</style>
</html>
