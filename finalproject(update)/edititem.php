<?php
session_start();

$usr = $_SESSION['username'];
    if (!isset($usr)) 
    {
      header('Location: login.php');
     exit();
    }
include 'functions/dbconnect.php';
include 'navbar.html';
include 'sidebar.php';
    
$itemid = "";

 $itemid = filter_input(INPUT_GET, 'id'); 
 $location = filter_input(INPUT_GET, 'location');
 $boxid = filter_input(INPUT_GET, 'boxid');
 
 
 
 
 $boxidpost = filter_input(INPUT_POST, 'boxid');
 $status = filter_input(INPUT_POST, 'status');
 $desc = filter_input(INPUT_POST, 'description');
 
 $querybox = "select distinct boxid from tblitem";
 if($res2 = $mysqli->query($querybox)) {
         $ret2 = [];
        while($row2 = $res2->fetch_assoc()) {
          $ret2[] = $row2;
         }
            $boxidpull = ($ret2[0]['boxid']);
         } else {
              echo $mysqli->error;
         }
         
         
$mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');
$query = "select * from tblitem where ID = '$itemid' ";

if($res = $mysqli->query($query)) {
         $ret = [];
        while($row = $res->fetch_assoc()) {
          $ret[] = $row;
         }
            $boxid2 = ($ret[0]['boxid']);
            $status2 = ($ret[0]['status']);
            $desc2 = ($ret[0]['description']);
         } else {
              echo $mysqli->error;
         }
if ($mysqli->connect_errno)
    {
        echo 'connection failed'.$mysqli->connect_error;
        exit();
    }
    
    if (isset($_POST['submit'])) {
        $query3 = "update tblitem set status = '$status', description = '$desc' where ID = '$itemid'";
        $query4 = "update tblitem set boxid = '$boxidpost' where ID = '$itemid'";
        //$query5 = "update tblitem set description = '$desc', status = '$status' where ID = '$itemid'";
        mysqli_query($mysqli, $query3) or die(mysqli_error($mysqli));
        mysqli_query($mysqli, $query4) or die(mysqli_error($mysqli));
        
        
            if ($mysqli->connect_errno)
                {
                    echo 'connection failed'.$mysqli->connect_error;
                    exit();
                }
                echo '<script language="javascript">';
                echo 'alert("Item Edited Properly")';
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
    <h2 style="color: white">Edit Item</h2>
    <form name="form1" method="post" onsubmit="return validateForm()" >
                        <div class="col-md-1">
                            <p style="color: white">Item ID</p>
                            <input type="text" name="itemid" disabled="true" id="itemid" class="form-control" placeholder="<?php echo $itemid;?>" value="" />
                        </div>
                        <div class="col-md-3">
                            <p style="color: white">Status</p>
                            <select class="form-control col-md-5" id="status" name="status" id="status" >
                                <option><?php echo $status2;?></option>
                                <option>
                                    <?php if ($status2 == 'In Box') {
                                            echo 'In Use';
                                        } else  {
                                            echo 'In Box';
                                                    }?>
                                </option>
                              </select>
                            <p style="color: white">Description</p>
                            <input type="text" name="description" id="description" class="form-control"  onfocus="this.value=''" value="<?php echo $desc2;?>" />
                            <p style="color: white">Box ID</p>
                            <select class="form-control col-md-4" id="boxid" name="boxid" >
                                <option><?php echo $boxid; ?>(actual)</option>
                                <?php if(isset($res2)) foreach ($res2 as $row2): ?>
                                <option><?php echo $row2['boxid']; ?></option>
                                <?php endforeach; ?>
                              </select>
                        </div>
                        <div class="col-md-2">
                            <p></p>
                            <input type="submit" class="btn btn-outline-success btn-lg" name="submit" value="Save" style="align-content: center;" />
                            <p></p>
                            <a href="index.php" class="btn btn-outline-success btn-lg" >Go Home</a>
                        </div>
                    </form>
        </div>
</div>
<script>
function validateForm() {
  var x = document.forms["form1"]["location"].value;
  var y = document.forms["form1"]["status"].value;
  if (x == "" || y == "") {
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