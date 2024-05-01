<?php include('includes/menu.php'); ?>

<?php
session_start();
require_once ('../Database/database.php');

//check if user ID is provided in the URL

$CommiteeID=$_GET['CommiteeID'];

// Make DELETE query.
$query = "DELETE FROM commitee WHERE CommiteeID='$CommiteeID'";

// Run the query.
$result = @mysqli_query ($dbc,$query);

if($result==true){

    //query has been executed successfully and admin is deleted
   //create a session variable to display message

   $_SESSION['delete']=" <div class='success'> Committee Deleted Successfully </div>";

   //redicted to manage committee page
   header('Location: http://localhost/php-projects/CommuniHub/admin/register-committee.php');

}
else{
    //fail to delete committee
    $_SESSION['delete']="<div class'error'>Failed to delete committee </div>";
    header('Location: http://localhost/php-projects/CommuniHub/admin/register-committee.php');

    exit();
}
?>



<?php include('includes/footer.php'); ?> 