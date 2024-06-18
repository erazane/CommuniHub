<?php
session_start();
require_once('../Database/database.php');

// Check if DiscussionRepliesID is provided in the URL
if (isset($_GET['DiscussionRepliesID'])) {
    // Sanitize the input
    $DiscussionRepliesID = mysqli_real_escape_string($dbc, $_GET['DiscussionRepliesID']);

    // Delete the discussion
    $query = "DELETE FROM discussionreplies WHERE DiscussionRepliesID='$DiscussionRepliesID'";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        $_SESSION['delete'] = "Reply deleted successfully!";
        $_SESSION['delete_data'] = "success";
    } else {
        $_SESSION['delete'] = "Failed to delete discussion. Error: " . mysqli_error($dbc);
        $_SESSION['delete_data'] = "error";
    }
} else {
    $_SESSION['delete'] = "DiscussionRepliesID not provided.";
    $_SESSION['delete_data'] = "error";
}

// Redirect back to the manage-discussions.php page
header("Location: manage-discussions.php");
exit();
