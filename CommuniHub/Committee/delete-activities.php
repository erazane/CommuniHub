<?php
session_start();
require_once ('../Database/database.php');

// Check if DonationID is provided in the URL
if(isset($_GET['ActivityID'])) {
    // Sanitize the input
    $ActivityID = mysqli_real_escape_string($dbc, $_GET['ActivityID']);

    // Make DELETE query.
    $query = "DELETE FROM activities WHERE ActivityID='$ActivityID'";
    $result = mysqli_query($dbc, $query); // Run the query.

    if ($result) {
        $_SESSION['delete'] = "Data deleted successfully!";
        $_SESSION['delete_data'] = "success";
    } else {
        $_SESSION['delete'] = "Failed to delete.";
        $_SESSION['delete_data'] = "error";
        // Log or echo mysqli_error($dbc) to see the specific error message
    }
} else {
    $_SESSION['delete'] = "ActivityID not provided.";
    $_SESSION['delete_data'] = "error";
}
// Unset the session variables
unset($_SESSION['delete']);
unset($_SESSION['delete_data']);

// Redirect back to the manage-activity.php page
header("Location: manage-activities.php");
exit();
?>
