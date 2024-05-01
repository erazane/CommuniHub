<?php include('includes/menu.php'); ?>

<?php

session_start();
require_once ('../Database/database.php');

//check if user ID is provided in the URL

$UserID=$_GET['UserID'];

// Make DELETE query.
$query = "DELETE FROM user WHERE UserID='$UserID'";		
$result = @mysqli_query ($dbc,$query); // Run the query.

if($result==true){

    //query has been executed successfully and admin is deleted
   //create a session variable to display message

   $_SESSION['delete']=" <div class'success'> User Deleted Successfully </div>";

   //redicted to manage admin page
   header('Location: http://localhost/php-projects/CommuniHub/admin/manage-user.php');

}
else{
    //fail to delete admin
    $_SESSION['delete']="<div class'error'>Failed to delete user </div>";
    header('Location: http://localhost/php-projects/CommuniHub/admin/manage-user.php');

    exit();
}
?>



<?php include('includes/footer.php'); ?> 