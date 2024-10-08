<?php
// Include your database connection file
require_once('../Database/database.php');

$CardNumberKey = "cardNumberKey";
$CVVKey = "CVVKey";

if (
    isset($_POST["UserID"]) && isset($_POST["DonationID"]) &&
    isset($_POST["CardHolder"]) && isset($_POST["cardType"]) &&
    isset($_POST["CardNumber"]) && isset($_POST["expmonth"]) &&
    isset($_POST["CVV"]) && isset($_POST["DonationTotal"]) &&
    isset($_POST["DonationMessage"])
) {
    // Retrieve data from the POST request
    $UserID = $_POST["UserID"];
    $DonationID = $_POST["DonationID"];
    $DonationTotal = $_POST["DonationTotal"];
    $DonationMessage = $_POST["DonationMessage"];
    $CardHolder = $_POST["CardHolder"];
    $CardNumber = crypt($_POST["CardNumber"], $CardNumberKey);
    $cardType = $_POST["cardType"];
    $expmonth = $_POST["expmonth"];
    $CVV = crypt($_POST["CVV"], $CVVKey);

    // Prepare and execute the SQL query to insert the data into the donationjoined table
    $insertQuery = "INSERT INTO donationjoined (UserID, DonationID, CardHolder, CardNumber, cardType, expmonth, CVV, DonationTotal, DonationMessage)
                    VALUES ('$UserID', '$DonationID', '$CardHolder', '$CardNumber', '$cardType', '$expmonth', '$CVV', '$DonationTotal', '$DonationMessage')";

    if (mysqli_query($dbc, $insertQuery)) {
        // If insertion is successful, send a success response
        echo json_encode(["success" => true]);
    } else {
        // If insertion fails, send an error response
        echo json_encode(["success" => false, "error" => mysqli_error($dbc)]);
    }
} else {
    // If UserID, DonationID, DonationTotal, or DonationMessage is not set in the POST request, send an error response
    echo json_encode(["success" => false, "error" => "Required parameters are missing."]);
}
?>
