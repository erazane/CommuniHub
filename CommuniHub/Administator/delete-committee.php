<?php
session_start();
require_once ('../Database/database.php');

// Check if CommiteeID is provided in the URL
if (!isset($_GET['CommiteeID'])) {
    // Redirect back with error message if CommiteeID is not provided
    $_SESSION['delete'] = "CommiteeID not provided.";
    $_SESSION['delete_user'] = "error";
    header("Location: manage-user.php");
    exit();
}

$CommiteeID = $_GET['CommiteeID'];

// Print out the SQL query for debugging
echo "DELETE FROM commitee WHERE CommiteeID='$CommiteeID'";

// Make DELETE query.
$query = "DELETE FROM commitee WHERE CommiteeID='$CommiteeID'";
$result = mysqli_query($dbc, $query); // Run the query.

if ($result) {
    // User deleted successfully
    $_SESSION['delete'] = "Unassigned committee successfully!";
    $_SESSION['delete_user'] = "success";
} else {
    // Error occurred while deleting user
    $_SESSION['delete'] = "Failed to unassigned committee .";
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
