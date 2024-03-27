<?php
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    // Database connection parameters
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

    // Retrieve data from AJAX request
    $userID = $_SESSION['user-id'];
    $fName = $_POST['first_name'];
    $lName = $_POST['last_name'];
    $email = $_POST['email'];


    // Update data in the database
    $sql = "UPDATE `admin` SET `first-name` ='$fName' , `last-name` = '$lName' , `email` = '$email' WHERE phone = $userID";

    if ($conn->query($sql) === TRUE) {
        echo  "New record Update successfully";

        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // Close connection
    $conn->close();
    
}
else{
    echo "User Not Login";
}
?>
