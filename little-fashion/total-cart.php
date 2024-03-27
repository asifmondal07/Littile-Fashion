<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $userID = $_SESSION['user-id'];

    include 'database_connect.php';
    $result = mysqli_query($conn, "SELECT  COUNT(`product_id`) AS NumberOfProducts  FROM shoppingcart WHERE user_id= $userID ");
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        echo $row['NumberOfProducts'];
    }
    
}
?>
