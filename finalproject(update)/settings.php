<?php
session_start();

include 'functions/functions.php';
include 'functions/dbconnect.php';
include 'navbar.html';
include 'sidebar.php';

$usr= "";
$pass = "";

$usr = $_SESSION['username'];

$mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
            $query = "SELECT * FROM tblusers where username = '$usr' ";
            if($res = $mysqli->query($query)) {
         $ret = [];
        while($row = $res->fetch_assoc()) {
          $ret[] = $row;
         }
            $pic = ($ret[0]['picture']);
         } else {
              echo $mysqli->error;
         }
    
    
    if(isset($back)) foreach ($back as $row)
                       { 
                        
                                $myid = $row['ID'];
                        echo $myid;
                       }
    
?>

<?php
 if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
    if (isset ($_FILES['file1'])) 
        {
        try
        {
            $target_dir = "images/thumbs/";
        $tmp_name = $_FILES['file1']['tmp_name'];
        $path = getcwd() .DIRECTORY_SEPARATOR . 'images/thumbs/';
        $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['file1']['name'];
        move_uploaded_file($tmp_name, $new_name);
       
        
                echo '<script language="javascript">';
                echo 'alert("Picture Changed Succesfully")';
                echo '</script>';
            
        } catch (Exception $ex) 
            {
            echo $ex->getMessage();
            }
        
        }
    }

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<html>
    <body>
        <div class="content" style="padding: 40px;">
            <div class="row" style="margin-left: 25%;">
                <div class="col-md-6 ">
                    <h3 style="color: white;">Settings</h3>
                    <form name="form1" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                            <div class="form-group" id="di" >
                                <input type="file" name="file1" id="file1">
                            <input type="submit" name="file1" value="Upload">
                            <br>
                            <a style="color: white;">Select The desired file</a>
                            </div>
                        <img src="images/thumbs/<?php echo $pic ?>.png"/>
                    <p></p>
                        <div class="form-group col-md-6">
                        <p style="color: white;">Username:<input type="text" disabled="true" name="username" id="username" class="form-control" placeholder="<?php echo $usr;?>" value="" /></p>
                        </div>
                    
                    </form>
                        <div class="form-group">
                            <button class="btn btn-outline-danger" onclick="window.location.href='changepass.php';">Change Password</button>
                        </div>
                </div>
            </div>
        </div>
    </body>
</html>