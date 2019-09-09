<?php



$usr= "";

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
?>
<html>
    <head>
        <style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
    float: left;
  height: 100vh;
  width: 20%;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  /*padding: 6px 8px 6px 16px;*/
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  margin-left: 31%;
}
.sidenav p {
  /*padding: 6px 8px 6px 16px;*/
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  margin-left: 31%;
}
.sidenav img{
    margin-left: 28%;
    border: 1px solid black;
    border-radius: 10%;
}
img:hover {
    opacity: 0.5;
  filter: alpha(opacity=50);
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
.sidenav a:hover {
  color: #f1f1f1;
}

.content{
                width: 80%;
                height: 100vh;
                float: left;
                background: #212529;
        }
.content1{
                width: 80%;
                border: 3px solid ;
                float: left;
                background: #212529;
        }
        .content2{
               width: 80%;
                height: 100vh;
                float: left;
                background: #212529;
        }
        .content3{
                width: 100%;
                height: 77%;
                float: left;
                background: #212529;
        }

.content img{
            
        }
.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="sidenav" style="height: 100vh;">
            <img src="images/thumbs/<?php echo $pic; ?>.png" alt="" style="width: 150px" />
            <p><?php echo 'Hello '.$usr; ?></p>
            <a href="settings.php">Settings</a>
        </div>
    </body>
</html>

