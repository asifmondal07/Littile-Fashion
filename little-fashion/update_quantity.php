<?php
session_start();
include 'database_connect.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if productId and quantity are set in the POST data
    if (isset($_POST["cart_id"]) && isset($_POST["quantity"])) {
        // Sanitize input
        $cart_id = $_POST["cart_id"];
        $quantity = $_POST["quantity"];
        $total_price=0;
        $result1=mysqli_query($conn,"SELECT * FROM `shoppingcart` WHERE cart_id =$cart_id");
        if($row=mysqli_fetch_assoc($result1)){
            $product_price=$row['product_price'];
        

        $total_price += $quantity*$product_price;

        // Prepare and execute the SQL update statement
        $sql = "UPDATE `shoppingcart` SET `quantity` = '$quantity', `total-price` = '$total_price' WHERE `shoppingcart`.`cart_id` = $cart_id";
        if($result=mysqli_query($conn,$sql)){
            echo "success";
        } else {
            // Return error message
            echo "error";
        }

        // Close statement
        $conn->close();
        }
    } else {
        // Return error message if productId or quantity are not set
        echo "error.productId or quantity are not set";
    }
} else {
    // Return error message if request method is not POST
    echo "error.request method is not POST";
}
?>