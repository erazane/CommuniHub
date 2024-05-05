<?php
session_start();
require_once('../Database/database.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID
    $UserID = $_SESSION["UserID"];

    // Get form data
    $currentPassword = mysqli_real_escape_string($dbc, $_POST['current-password']);
    $newPassword = mysqli_real_escape_string($dbc, $_POST['new-password']);
    $confirmPassword = mysqli_real_escape_string($dbc, $_POST['confirm-password']);

    // Verify if new password and confirm password match
    if ($newPassword != $confirmPassword) {
        // Redirect back to the change password modal with an error message
        header('Location: UserProfile.php?error=password_mismatch');
        exit();
    }

    // Query to fetch user's current password
    $query = "SELECT UserPwd FROM user WHERE UserID = '$UserID'";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['UserPwd'];

        // Verify if the current password matches the one in the database
        if (password_verify($currentPassword, $hashedPassword)) {
            // Hash the new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update query
            $update_query = "UPDATE user SET UserPwd = '$hashedNewPassword' WHERE UserID = '$UserID'";

            // Execute update query
            $update_result = mysqli_query($dbc, $update_query);

            if ($update_result) {
                // Redirect back to the profile page with a success message
                header('Location: UserProfile.php?success=password_updated');
                exit();
            } else {
                // Redirect back to the change password modal with an error message
                header('Location: UserProfile.php?error=update_failed');
                exit();
            }
        } else {
            // Redirect back to the change password modal with an error message
            header('Location: UserProfile.php?error=incorrect_password');
            exit();
        }
    } else {
        // Redirect back to the change password modal with an error message
        header('Location: UserProfile.php?error=query_failed');
        exit();
    }
} else {
    // If the form wasn't submitted, redirect back to the profile page
    header('Location: UserProfile.php');
    exit();
}
?>
