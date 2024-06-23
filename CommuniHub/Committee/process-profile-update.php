<?php
session_start();
require_once('../Database/database.php');

// Check if the UserID is provided and valid
$UserID = isset($_GET['UserID']) ? intval($_GET['UserID']) : 0;

if ($UserID <= 0) {
    $_SESSION['error'] = 'Invalid User ID.';
    header('Location: dashboard.php');
    exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the input data
    $UserFirstName = mysqli_real_escape_string($dbc, $_POST['UserFirstName']);
    $UserLastName = mysqli_real_escape_string($dbc, $_POST['UserLastName']);
    $UserUserName = mysqli_real_escape_string($dbc, $_POST['UserUserName']);
    $UserAge = intval($_POST['UserAge']);
    $UserMartialStatus = mysqli_real_escape_string($dbc, $_POST['UserMartialStatus']);
    $UserOccupation = mysqli_real_escape_string($dbc, $_POST['UserOccupation']);
    $UserContactDetails = mysqli_real_escape_string($dbc, $_POST['UserContactDetails']);
    $UserEmail = mysqli_real_escape_string($dbc, $_POST['UserEmail']);
    $profilePicture = $_FILES['profile_picture']['name'];
    
    // Handle profile picture upload if a file was uploaded
    if ($profilePicture) {
        $profilePictureTemp = $_FILES['profile_picture']['tmp_name'];
        $profilePictureDir = '../Committee/images/profile-pictures/';
        $profilePicturePath = $profilePictureDir . basename($profilePicture);

        // Validate the uploaded file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($profilePictureTemp);

        if (!in_array($fileType, $allowedTypes)) {
            $_SESSION['error'] = 'Invalid file type. Please upload a JPG, PNG, or GIF image.';
            header("Location: index.php?UserID=$UserID");
            exit();
        }

        if (move_uploaded_file($profilePictureTemp, $profilePicturePath)) {
            $profilePictureSQL = ", profile_picture = '$profilePicture'";
        } else {
            $_SESSION['error'] = 'Error uploading the profile picture.';
            header("Location: index.php?UserID=$UserID");
            exit();
        }
    } else {
        $profilePictureSQL = "";
    }

    // Prepare the update query
    $update_query = "UPDATE user SET 
                    UserFirstName = '$UserFirstName',
                    UserLastName = '$UserLastName',
                    UserUserName = '$UserUserName',
                    UserAge = $UserAge,
                    UserMartialStatus = '$UserMartialStatus',
                    UserOccupation = '$UserOccupation',
                    UserContactDetails = '$UserContactDetails',
                    UserEmail = '$UserEmail'
                    $profilePictureSQL
                    WHERE UserID = '$UserID'";

    // Execute the update query
    if (mysqli_query($dbc, $update_query)) {
        $_SESSION['status'] = "Profile updated successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error updating profile: " . mysqli_error($dbc);
        $_SESSION['status_code'] = "error";
    }

    // Redirect back to the profile page or dashboard
    header("Location: index.php?UserID=$UserID");
    exit();
} else {
    $_SESSION['error'] = 'Invalid request method.';
    header('Location: index.php');
    exit();
}
?>
