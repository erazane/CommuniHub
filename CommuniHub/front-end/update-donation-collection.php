<?php
require_once('../Database/database.php');

function updateDonationCollectionAmount($donationId) {
    global $dbc; // Assuming $dbc is your database connection object

    try {
        // Calculate total donation amount for the specific donation
        $query = "SELECT SUM(DonationTotal) AS total_amount FROM donationjoined WHERE DonationID = $donationId";
        $result = mysqli_query($dbc, $query);
        $totalAmount = mysqli_fetch_assoc($result)['total_amount'];

        // Update donationcollectionamount in the donations table
        $updateQuery = "UPDATE donations SET donationcollectionamount = $totalAmount WHERE DonationID = $donationId";
        mysqli_query($dbc, $updateQuery);

        echo "Donation collection amount updated successfully for DonationID: $donationId";
    } catch (Exception $e) {
        echo "Error updating donation collection amount: " . $e->getMessage();
    }
}
?>
