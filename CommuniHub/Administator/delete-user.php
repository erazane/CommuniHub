<?php
session_start();
require_once ('../Database/database.php');

// Check if UserID is provided in the URL
if (!isset($_GET['UserID'])) {
    // Redirect back with error message if UserID is not provided
    $_SESSION['delete'] = "UserID not provided.";
    $_SESSION['delete_user'] = "error";
    header("Location: manage-user.php");
    exit();
}

$UserID = $_GET['UserID'];

// Print out the SQL query for debugging
echo "DELETE FROM user WHERE UserID='$UserID'";

// Make DELETE query.
$query = "DELETE FROM user WHERE UserID='$UserID'";
$result = mysqli_query($dbc, $query); // Run the query.

if ($result) {
    // User deleted successfully
    $_SESSION['delete'] = "User deleted successfully!";
    $_SESSION['delete_user'] = "success";
} else {
    // Error occurred while deleting user
    $_SESSION['delete'] = "Failed to delete user.";
    $_SESSION['delete_user'] = "error";
    // Print out SQL error message for debugging
    echo "Error: " . mysqli_error($dbc);
}

// Unset the session variables
unset($_SESSION['delete']);
unset($_SESSION['delete_user']);

// Redirect back to the manage-user.php page
header("Location: manage-user.php");
exit();
?>
