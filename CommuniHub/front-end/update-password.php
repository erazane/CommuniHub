<?php
session_start();
require_once('../Database/database.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID
    $UserID = $_SESSION["UserID"];

    // Get form data
    $newPassword = crypt($_POST['newPassword'], 'ahookdemok');
    $confirmPassword = crypt($_POST['confirmPassword'], 'ahookdemok');
    $currentPassword = crypt($_POST['currentPassword'], 'ahookdemok');

    // Query to fetch user's current password
    $query = "SELECT UserPwd FROM user WHERE UserID = '$UserID'";
    $result = mysqli_query($dbc, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['UserPwd'];

        // Verify if the current password matches the one in the database
        if ($currentPassword === $hashedPassword) {
            // Verify if new password and confirm password match
            if ($newPassword === $confirmPassword) {
                // Update query
                $update_query = "UPDATE user SET UserPwd = '$newPassword' WHERE UserID = '$UserID'";

                // Execute update query
                $update_result = mysqli_query($dbc, $update_query);
                if ($update_result) {
                    $_SESSION['password_status'] = "Password updated successfully!";
                    $_SESSION['password_status_code'] = "success";
                } else {
                    $_SESSION['password_status'] = "Failed to update password";
                    $_SESSION['password_status_code'] = "error";
                }
            } else {
                $_SESSION['password_status'] = "New password and confirm password do not match";
                $_SESSION['password_status_code'] = "error";
            }
        } else {
            $_SESSION['password_status'] = "Incorrect current password";
            $_SESSION['password_status_code'] = "error";
        }
    } else {
        $_SESSION['password_status'] = "User not found";
        $_SESSION['password_status_code'] = "error";
    }
}

header('Location: UserProfile-read.php');
exit();

?>
