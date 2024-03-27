<?php
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if email and password are set and not empty
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
        
        // Sanitize user input to prevent SQL injection or other attacks
        $pname=($_POST["pname"]);
        $desc=($_POST["desc"]);
        $price = ($_POST["price"]);
        $cat = ($_POST["Category"]);
        

         // File upload handling
        $image=$_FILES['image'];
        $image_loc = $_FILES['image']['tmp_name']; // Temporary location of the uploaded file
        $image_name = $_FILES['image']['name'];
        $image_des="uploading/".$image_name;
        move_uploaded_file($image_loc,"uploading/".$image_name);

        
        
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
        $sql = "INSERT INTO `product` (`pname`,`description`,`image`,`price`,`category`) VALUES ('$pname','$desc','$image_des','$price', '$cat')";

        if ($conn->query($sql) === TRUE) {
            echo  "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        // Close connection
        $conn->close();
    }else{
        echo"you login First";
    }
} else {
    // If the request method is not POST, return an error message
    echo "Error: Invalid request method.";
}
?>
