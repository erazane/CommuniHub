<?php

//authorization--access control
//check whether the user is logged in or not

if(!isset($_SESSION['user']))   //if user session is not set
{
//user is not logged in

//redirect to login pae with a message
$_SESSION['no-login-message'] ="<div class'error text-center'>Please login to access the Admin Panel</div>";
header('Location: http://localhost/php-projects/CommuniHub/admin/adminLogin.php');
exit();
}

?>