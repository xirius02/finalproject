<?php
session_start();

var_dump($_SESSION);

$usr= "";

$usr = $_SESSION['username'];
    if (!isset($usr)) 
    {
      header('Location: login.php');
    }
    
    echo $usr;
?>
