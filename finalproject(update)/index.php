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
$id2 = "";
$id = "";

$usr= "";

    
    /*$back = wholeuser($usr);
    
    
    if(isset($back)) foreach ($back as $row)
                       { 
                        
                                $myid = $row['ID'];
                        echo $myid;
                       }*/
$query = "SELECT * FROM tblbox order by ID";
$query2 = "select count(*) from tblitem where boxid = '$id' ";
$mysqli = new mysqli('127.0.0.1', 'root', '', 'se266_erick');

//$id2 = mysqli_query($mysqli, $query2);
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
            $id = ($ret[0]['ID']);
         } else {
              echo $mysqli->error;
         }
         
          /*if($res2 = $mysqli->query($query2)) {
         $ret2 = [];
        while($row2 = $res2->fetch_assoc()) {
          $ret2[] = $row2;
         }
            $id2 = ($ret2[0]['ID']);
         } else {
              echo $mysqli->error;
         }*/
                       
?>
<html>
    
<link rel="stylesheet" type="text/css" href="style/loginstyle.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <head>
        <title>Boxit</title>
    </head>
    <body>
        <div class="content1" style="padding: 20px;">
            <h4 style="color: white;"><input type="image" style="margin-left: 20px; border-radius: 20px;" src="images/buttons/add2.png" width="70" height="70" onclick=window.location.href="newbox.php" /> New Box</h4>
            </div>
        <form name="form1" method="get">
            <div class="content2" style="padding: 20px;">
            <h2 style="text-align: center; color: white;">List Of Boxes</h2>
            <table class="table table-hover table-dark" style="color: white;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Box ID</th>
                        <th scope="col">Location</th>
                        <th scope="col">Actions</th>
                        <th scope="col">Amount of Items</th>
                    </tr>
                </thead>
                <tbody>
            <?php if(isset($res)) foreach ($res as $row): ?>
                    <tr>
                        <td scope="row"><?php echo $row['ID'] ?></td>
                        <td scope="row"><?php echo $row['boxid'] ?></td>
                        <td scope="row"><?php echo $row['boxlocation'] ?></td>
                       
                        <td>
                            <a href="viewbox.php?id=<?php echo $row['boxid'];?>&location=<?php echo $row['boxlocation'];?>" class="btn btn-outline-success btn-xs" data-title="add" data-toggle="modal" data-target="#add" >View Box</a>
                            <a href="additems.php?id=<?php echo $row['boxid'];?>&location=<?php echo $row['boxlocation'];?>" class="btn btn-outline-success btn-xs" data-title="add" data-toggle="modal" data-target="#add" >Add Items</a>
                            <a href="editbox.php?id=<?php echo $row['boxid'];?>&location=<?php echo $row['boxlocation'];?>" class="btn btn-outline-success btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >Edit Box</a>
                            <a href="deletebox.php?id=<?php echo $row['boxid'];?>&location=<?php echo $row['boxlocation'];?>" class="btn btn-outline-danger" data-title="Delete" data-toggle="modal" data-target="#delete" >Delete Box</a>
                        </td>
                <?php
                            $number = "";
                            $changeid = $row['boxid'];
                            $query2 = "select count('boxid') as count  from tblitem where boxid = '$changeid' ";
                            $amount = mysqli_query($mysqli, $query2);
                            $row2 = $amount->fetch_object();
                            $number = $row2->count;
                            ?>
                        <td scope="row"><?php echo $number; ?></td>
            <?php endforeach; ?>
                    </tr>
                </tbody>
                  </table>
        </div>
    </body>
    </form>
</html>