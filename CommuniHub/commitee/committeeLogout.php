<?php 
// Start the session
session_start();

// Connect to the database 
require_once('../Database/database.php'); 

// Destroy the session
session_destroy();  

// Redirect to the login page
header('Location: http://localhost/php-projects/CommuniHub/front-end/index.php');
exit();
?>
