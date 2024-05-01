<?php
session_start();
require_once ('../Database/database.php');

// Check if admin ID is provided in the URL
$AdminID = $_GET['adminID'];

// Make DELETE query.
$query = "DELETE FROM admin WHERE adminID='$AdminID'";
$result = mysqli_query($dbc, $query); // Run the query.

if ($result) {
    $_SESSION['delete'] = "Admin deleted successfully!";
    $_SESSION['delete_admin'] = "success";
} else {
    $_SESSION['delete'] = "Failed to delete admin.";
    $_SESSION['delete_admin'] = "error";
}

// Unset the session variables
unset($_SESSION['delete']);
unset($_SESSION['delete_admin']);

// Redirect back to the manage-admin.php page
header("Location: manage-admin.php");
exit();
?>
