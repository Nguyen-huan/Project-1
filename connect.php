<?php 
  $serverName = "localhost";
  $userName = "root";
  $password = "";
  $db_name = "dsuser";
  $conn = mysqli_connect($serverName, $userName, $password, $db_name);
  if(!$conn){
    echo "connect failed";
  }
?>