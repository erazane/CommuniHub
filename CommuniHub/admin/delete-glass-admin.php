<?php include('../commitee/includes/menuCom.php'); ?>

<?php
session_start();
require_once ('../Database/database.php');

// check if admin ID is provided in the URL
$glassScheduleID = $_GET['glassScheduleID'];

// Make DELETE query.
$query = "DELETE FROM glassschedule WHERE glassScheduleID='$glassScheduleID'";
$result = @mysqli_query($dbc, $query); // Run the query.

if($result==true){

    //query has been executed successfully and admin is deleted
   //create a session variable to display message

   $_SESSION['delete']=" <div class'success'> Schedule Deleted Successfully </div>";

   //redicted to manage admin page
   header('Location: http://localhost/php-projects/CommuniHub/admin/manage-schedule-admin.php');

}
else{
    //fail to delete admin
    $_SESSION['delete']="<div class'error'>Failed to delete schedule </div>";
    header('Location: http://localhost/php-projects/CommuniHub/admin/manage-schedule-admin.php');

    exit();
}
?>

<?php include('../commitee/includes/footerCom.php'); ?>
