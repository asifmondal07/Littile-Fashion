<?php
// Start a session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are set and not empty
    if (isset($_POST["user-id"]) && isset($_POST["password"]) && !empty($_POST["user-id"]) && !empty($_POST["password"])) {
        // Sanitize user input to prevent SQL injection or other attacks
        $user = ($_POST["user-id"]);
        $user_password = $_POST["password"]; 
        $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);

        // Set your database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "admin";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to select user based on email
        $sql = "SELECT * FROM `admin` WHERE `email`='$user' OR `phone`='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found, verify password
            $row = $result->fetch_assoc();
            if (password_verify($user_password, $row['password'])) {
                echo "Login success";
                // Password verified, set session variable to indicate user is logged in
                $_SESSION["loggedin"] = true;
                $_SESSION["user-id"]=$row['phone'];
               // Redirect user to home page
            } else {
                // Invalid password
                echo "Error:Invalid password.".$user_password;
            }
        } else {
            // User not found
            echo "Error: User not found.";
        }

        // Close connection
        $conn->close();
    } else {
        // If email or password is not set or empty, return an error message
        echo "Error: Email and password are required.";
    }
} else {
    // If the request method is not POST, return an error message
    echo "Error: Invalid request method.";
}
?>
