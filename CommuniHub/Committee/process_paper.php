<?php
session_start();
require_once('../Database/database.php'); // Connect to the db.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $PaperPickupDay = isset($_POST['PaperPickupDay']) ? $_POST['PaperPickupDay'] : "";
    $Time = isset($_POST['Time']) ? $_POST['Time'] : "";
    $DateUpdated = isset($_POST['DateUpdated']) ? $_POST['DateUpdated'] : "";

    // Check for empty input
    if (!empty($PaperPickupDay) && !empty($Time) && !empty($DateUpdated)) {
        // Insert new paperschedule
        $query = "INSERT INTO paperschedule (PaperPickupDay, Time, DateUpdated) 
                  VALUES ('$PaperPickupDay', '$Time', '$DateUpdated')";
        $insertResult = mysqli_query($dbc, $query);

        if ($insertResult) {
            echo "Inserted successfully!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($dbc);
        }
    } else {
        echo "Unable to insert data: Empty fields";
    }
} else {
    echo "Invalid request method";
}
?>