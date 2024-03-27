<?php
session_start();
include "database_connect.php";

if(isset($_POST['cartID'])) {
    $cartID = $_POST['cartID'];

    $sql="DELETE FROM shoppingcart WHERE cart_id = $cartID";
    if(mysqli_query($conn,$sql)){
        echo 1;
    }else{
        echo 0;
    }
}
?>