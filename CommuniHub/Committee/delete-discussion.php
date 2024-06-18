<?php
session_start();
require_once('../Database/database.php');

// Check if DiscussionID is provided in the URL
if (isset($_GET['DiscussionID'])) {
    // Sanitize the input
    $DiscussionID = mysqli_real_escape_string($dbc, $_GET['DiscussionID']);

    // Delete the discussion
    $query = "DELETE FROM discussion WHERE DiscussionID='$DiscussionID'";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        $_SESSION['delete'] = "Discussion deleted successfully!";
        $_SESSION['delete_data'] = "success";
    } else {
        $_SESSION['delete'] = "Failed to delete discussion. Error: " . mysqli_error($dbc);
        $_SESSION['delete_data'] = "error";
    }
} else {
    $_SESSION['delete'] = "DiscussionID not provided.";
    $_SESSION['delete_data'] = "error";
}

// Redirect back to the manage-discussions.php page
header("Location: manage-discussions.php");
exit();
