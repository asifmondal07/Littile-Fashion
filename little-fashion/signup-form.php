<?php
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are set and not empty
    if (($_POST["password"])==($_POST["cpassword"])){
        // Sanitize user input to prevent SQL injection or other attacks
        $first_name=($_POST["first_name"]);
        $last_name=($_POST["last_name"]);
        $email = ($_POST["email"]);
        $phone = ($_POST["phone"]);
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

        // Prepare and execute SQL statement
        $sql = "INSERT INTO `admin` (`first-name`,`last-name`,`email`,`phone`, `password`) VALUES ('$first_name','$last_name','$email','$phone', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo  "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        // Close connection
        $conn->close();
    } else {
        echo "Error: Password does't match.";
    }
} else {
    // If the request method is not POST, return an error message
    echo "Error: Invalid request method.";
}
?>
