<?php include('includes/menu.php'); ?>

<?php

session_start();
require_once ('../Database/database.php');

//check if admin ID is provided in the URL

$AdminID=$_GET['adminID'];

// Make DELETE query.
$query = "DELETE FROM admin WHERE adminID='$AdminID'";		
$result = @mysqli_query ($dbc,$query); // Run the query.

if($result==true){

    //query has been executed successfully and admin is deleted
   //create a session variable to display message

   $_SESSION['delete']=" <div class'success'> Admin Deleted Successfully </div>";

   //redicted to manage admin page
   header('Location: http://localhost/php-projects/CommuniHub/admin/manage-admin.php');

}
else{
    //fail to delete admin
    $_SESSION['delete']="<div class'error'>Failed to delete admin </div>";
    header('Location: http://localhost/php-projects/CommuniHub/admin/manage-admin.php');

    exit();
}
?>



<?php include('includes/footer.php'); ?> 