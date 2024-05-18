<?php 
session_start();
$_SESSION['ownerId'] = "";
$_SESSION['ownerUser'] = "";
header("Location:cp_login.php");
?>






