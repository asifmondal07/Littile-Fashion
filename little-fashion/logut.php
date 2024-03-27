
<?php
// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy all session data
session_destroy();

// Redirect to the home page
header("Location: sign-in.html"); 
exit;
?>

