<?php
$email = "";
$email = filter_input(INPUT_POST, 'email');
 $mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
 $query = "SELECT * FROM tblusers where email = '$email' ";

    $result = mysqli_query($mysqli, $query);

if (isset($email)) {
    if ($mysqli->connect_errno)
    {
        echo 'connection failed'.$mysqli->connect_error;
        exit();
    }
    if (mysqli_num_rows($result) != 0) {
        if($res = $mysqli->query($query)) {
         $ret = [];
        while($row = $res->fetch_assoc()) {
          $ret[] = $row;
         }
            $mail = ($ret[0]['email']);
            $pass = ($ret[0]['password']);
            
            echo '<script type="text/javascript">alert(" Your Password is: '.$pass.'");</script>';
         } else {
              echo $mysqli->error;
         }
         
    } else {
       echo '<script language="javascript">';
                echo 'alert("Email not found, try again")';
                echo '</script>';
    }
    
}

    
   
?>
<head>
    <title>Boxit</title>
</head>
<link rel="stylesheet" type="text/css" href="style/loginstyle.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Password Request</h3>
                    <form name="form1" method="post" onsubmit="return validateForm()">
                        <div class="form-group">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Request Password" />
                        </div>
                    
                    </form>
                    
                        <div class="form-group">
                            <button type="text" class="btnSubmit" value="login" onclick="window.location.href='login.php'">Login Page</button>
                        </div>
                </div>
                </div>
</div>
