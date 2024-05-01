<?php include('../commitee/includes/menuCom.php'); ?>

<?php
session_start();
require_once ('../Database/database.php');

// check if admin ID is provided in the URL
$paperScheduleID   = $_GET['paperScheduleID  '];

// Make DELETE query.
$query = "DELETE FROM plasticschedule WHERE paperScheduleID  ='$paperScheduleID  '";
$result = @mysqli_query($dbc, $query); // Run the query.

if ($result == true) {
    // query has been executed successfully and schedule is deleted
    // create a session variable to display message
    $_SESSION['delete'] = "<div class='success'> Schedule deleted Successfully </div>";
} else {
    // fail to delete admin
    $_SESSION['delete'] = "<div class='error'>Failed to delete Schedule </div>";
}

// Redirect to manage schedule page
header('Location: http://localhost/php-projects/CommuniHub/commitee/manage-schedule');
exit();
?>

<?php include('../commitee/includes/footerCom.php'); ?>
