<?php 
///connect to db 
require_once ('../Database/database.php'); 
//destroy session
session_destroy();  //unset the user session
//redirect to login page
header('Location:http://localhost/php-projects/CommuniHub/front-end/index.php');
exit();
?>