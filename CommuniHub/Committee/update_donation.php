<?php
session_start();
require_once('../Database/database.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch POST data
    $DonationID = $_POST['DonationID'];
    $DonationName = $_POST['DonationName'];
    $DonationDesc = $_POST['DonationDesc'];
    $DonationTarget = $_POST['DonationTarget'];
    $DonationStartDate = $_POST['DonationStartDate'];
    $DonationEndDate = $_POST['DonationEndDate'];
    $DonationStatus = $_POST['DonationStatus'];
    $status = $_POST['status'];

    // Perform update query
    $query = "UPDATE donation SET 
                DonationName = '$DonationName',
                DonationDesc = '$DonationDesc',
                DonationTarget = '$DonationTarget',
                DonationStartDate = '$DonationStartDate',
                DonationEndDate = '$DonationEndDate',
                DonationStatus = '$DonationStatus',
                status = '$status'
              WHERE DonationID = $DonationID";

    $result = mysqli_query($dbc, $query);

    if ($result) {
        // Update successful
        echo json_encode(['success' => true, 'message' => 'Donation updated successfully']);
    } else {
        // Update failed
        echo json_encode(['success' => false, 'message' => 'Failed to update donation']);
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
