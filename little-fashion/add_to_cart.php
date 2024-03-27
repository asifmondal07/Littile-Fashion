<?php
session_start();
include 'database_connect.php'; // Assuming this file includes database connection information

// Assuming you have a session variable to store the cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    echo"NO CART DATA HERE";
}

// Check if USER LOGGED IN is set in the SESSION request and it's true
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    // Check if user-id is set in the session
    if (isset($_SESSION["user-id"])) {
        $userID = $_SESSION["user-id"];

        // Check if product_id and quantity are set in the POST request
        if (isset($_POST['product_id'], $_POST['quantity'])) {
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            // Assuming you have a function to fetch product details from database by product_id
            $product = getProductDetails($product_id);
            if ($product) {
                // Adding product to the cart array in the session
                $_SESSION['cart'][] = [
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'product_price' => $product['price'], // Or any other relevant information from the product table
                    'product_name' => $product['pname'],
                    'product_name' => $product['pname']
                ];

                // Fetch product name and price from the database
                $result1 = mysqli_query($conn, "SELECT * FROM product WHERE sno=$product_id");
                $totalAmount = 0;
                if ($row = mysqli_fetch_assoc($result1)) {
                    $product_name = $row['pname'];
                    $product_image = $row['image'];
                    $product_price = $row['price'];

                    $totalAmount += $product_price * $quantity;

                    
                    // Insert the data into the shopping cart table
                    $result = mysqli_query($conn, "INSERT INTO `shoppingcart` (`user_id`, `product_id`, `quantity`, `product_price`,`total-price`,`product_name`, `product_image`) VALUES ('$userID', '$product_id', '$quantity',$product_price,'$totalAmount', '$product_name', '$product_image')");

                    if ($result) {
                        // Query executed successfully
                        echo"success";
                        
                    } else {
                        // Query execution failed, show the error message
                        echo "Error: " . mysqli_error($conn);
                    }
                    
                } else {
                    echo "Error fetching product details.".$result1;
                }
            } else {
                echo "Product not found.";
            }
        } else {
            echo "Product ID and quantity are required.";
        }
    } else {
        echo "User ID is not set.";
    }
} else {
    echo "YOU NEED TO LOGIN FIRST";
}

// Function to fetch product details from the database
function getProductDetails($product_id)
{
    global $conn; // Assuming $conn is your database connection variable
    // Fetch product details from the database using $product_id
    $query = "SELECT * FROM product WHERE sno = $product_id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}
?>
