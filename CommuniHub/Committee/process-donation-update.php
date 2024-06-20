<?php
session_start();
require_once('../Database/database.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $DonationID = intval($_POST['DonationID']);
    $DonationName = mysqli_real_escape_string($dbc, $_POST['DonationName']);
    $DonationDesc = mysqli_real_escape_string($dbc, $_POST['DonationDesc']);
    $DonationTarget = mysqli_real_escape_string($dbc, $_POST['DonationTarget']);
    $DonationStartDate = mysqli_real_escape_string($dbc, $_POST['DonationStartDate']);
    $DonationEndDate = mysqli_real_escape_string($dbc, $_POST['DonationEndDate']);
    $DonationStatus = mysqli_real_escape_string($dbc, $_POST['DonationStatus']);
    $status = mysqli_real_escape_string($dbc, $_POST['status']);
    
    // Fetch existing donation data to get the current image
    $query = "SELECT image FROM donation WHERE DonationID = '$DonationID'";
    $result = mysqli_query($dbc, $query);
    
    if (!$result) {
        $_SESSION['status'] = "Error fetching existing donation data: " . mysqli_error($dbc);
        $_SESSION['status_code'] = "error";
        header('Location: manage-donation.php');
        exit();
    }
    
    $donation = mysqli_fetch_assoc($result);
    $newImageName = $donation['image']; // Default to the existing image name

    // Image upload handling
    if ($_FILES["image"]["error"] != 4) {
        $filename = $_FILES["image"]["name"];
        $filesize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            $_SESSION['status'] = "Invalid image extension.";
            $_SESSION['status_code'] = "error";
            header('Location: manage-donation.php');
            exit();
        } elseif ($filesize > 1000000) {
            $_SESSION['status'] = "Image size too large.";
            $_SESSION['status_code'] = "error";
            header('Location: manage-donation.php');
            exit();
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            if (!move_uploaded_file($tmpName, '../Committee/images/donations/' . $newImageName)) {
                $_SESSION['status'] = "Error uploading image.";
                $_SESSION['status_code'] = "error";
                header('Location: manage-donation.php');
                exit();
            }
        }
    }

    // Perform update query
    $updateQuery = "UPDATE donation SET 
                    DonationName = '$DonationName',
                    DonationDesc = '$DonationDesc',
                    DonationTarget = '$DonationTarget',
                    DonationStartDate = '$DonationStartDate',
                    DonationEndDate = '$DonationEndDate',
                    DonationStatus = '$DonationStatus',
                    status = '$status',
                    image = '$newImageName'
                    WHERE DonationID = $DonationID";

    if (mysqli_query($dbc, $updateQuery)) {
        $_SESSION['status'] = "Donation updated successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error updating donation: " . mysqli_error($dbc);
        $_SESSION['status_code'] = "error";
    }

    // Redirect to manage-donation.php
    header('Location: manage-donation.php');
    exit();
}

// If not a POST request, redirect back to manage-donation.php
header('Location: manage-donation.php');
exit();
?>
