<?php
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    // Set your database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "admin";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);


    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the customer's first name from the database using the logged-in user's ID
    $userID =$_SESSION["user-id"];
    $sql = "SELECT `first-name` FROM `admin` WHERE phone = '$userID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if(isset($row['first-name'])) {
            echo $row['first-name'];
        } else {
            echo "Error: First name not found";
        }
    } else {
        echo "Error: User not found";
    }

    $conn->close();
} else {
    echo "Error: User not logged in";
}
?>
