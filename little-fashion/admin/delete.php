<?php

$id=$_POST['id'];
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "admin";
 $conn = new mysqli($servername, $username, $password, $dbname);
 $sql="DELETE FROM product WHERE sno = $id";
 if(mysqli_query($conn,$sql)){
    echo 1;
 }else{
    echo 0;
 }
 ?>