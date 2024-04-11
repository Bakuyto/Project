<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Debugging: Output a message to confirm session destruction
echo "Session destroyed successfully.";

// Redirect to the login page
header("Location: ../common/login.php");
exit; // Ensure script execution stops after redirection
?>

