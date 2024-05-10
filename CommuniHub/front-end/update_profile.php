<?php
session_start();
require_once('../Database/database.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID
    $UserID = $_SESSION["UserID"];

    // Get form data
    $UserFirstName = mysqli_real_escape_string($dbc, $_POST['first_name']);
    $UserLastName = mysqli_real_escape_string($dbc, $_POST['last_name']);
    $UserAge = mysqli_real_escape_string($dbc, $_POST['age']);
    $UserMartialStatus = mysqli_real_escape_string($dbc, $_POST['marital_status']);
    $UserUserName = mysqli_real_escape_string($dbc, $_POST['username']);
    $UserOccupation = mysqli_real_escape_string($dbc, $_POST['occupation']);
    $UserContactDetails = mysqli_real_escape_string($dbc, $_POST['contact_details']);
    $UserEmail = mysqli_real_escape_string($dbc, $_POST['UserEmail']);

    // Update query for text fields
    $update_query = "UPDATE user SET
                    UserFirstName = '$UserFirstName',
                    UserLastName = '$UserLastName',
                    UserAge = '$UserAge',
                    UserMartialStatus = '$UserMartialStatus',
                    UserUserName = '$UserUserName',
                    UserOccupation = '$UserOccupation',
                    UserContactDetails = '$UserContactDetails',
                    UserEmail = '$UserEmail'
                    WHERE UserID = '$UserID'";

    // Execute update query for text fields
    $update_result = mysqli_query($dbc, $update_query);

    // Check if the update was successful
    if ($update_result) {
        // Handle file upload
        if ($_FILES["profile_picture"]["error"] == UPLOAD_ERR_OK) {
            $filename = $_FILES["profile_picture"]["name"];
            $filesize = $_FILES["profile_picture"]["size"];
            $tmpName = $_FILES["profile_picture"]["tmp_name"];

            // Check file size and extension
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (!in_array($imageExtension, $validImageExtension)) {
                echo "<script>alert('Invalid Image Extension');</script>";
            } elseif ($filesize > 1000000) { // Adjust file size limit if needed
                echo "<script>alert('Image Size Too large');</script>";
            } else {
                // Generate a unique name for the image and move it to the desired location
                $newImageName = uniqid() . '.' . $imageExtension;
                move_uploaded_file($tmpName, '../front-end/images/profile-picture/' . $newImageName);

                // Update the database with the new image name
                $update_image_query = "UPDATE user SET image = '$newImageName' WHERE UserID = '$UserID'";
                $update_image_result = mysqli_query($dbc, $update_image_query);
                if (!$update_image_result) {
                    echo "<script>alert('Failed to update image in the database');</script>";
                }
            }
        }

        // Redirect back to the profile page with a success message
        $_SESSION['profile_status'] = "Profile updated successfully!";
        $_SESSION['profile_status_code'] = "success";
        header('Location: UserProfile-read.php?success=1');
        exit();
    } else {
        // Redirect back to the profile page with an error message
        $_SESSION['profile_status'] = "Profile cannot be updated";
        $_SESSION['profile_status_code'] = "error";
        header('Location: UserProfile-read.php?error=1');

        exit();
    }
} else {
    // If the form wasn't submitted, redirect back to the profile page
    header('Location: UserProfile-read.php');
    exit();
}
?>
