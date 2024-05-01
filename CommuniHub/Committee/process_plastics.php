<?php
session_start();
require_once('../Database/database.php'); // Connect to the db.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plasticPickupDay = isset($_POST['PlasticPickupDay']) ? $_POST['PlasticPickupDay'] : "";
    $Time = isset($_POST['Time']) ? $_POST['Time'] : "";
    $DateUpdated = isset($_POST['DateUpdated']) ? $_POST['DateUpdated'] : "";

    // Check for empty input
    if (!empty($plasticPickupDay) && !empty($Time) && !empty($DateUpdated)) {
        // Insert new plasticschedule
        $query = "INSERT INTO plasticschedule (PlasticPickupDay, Time, DateUpdated) 
                  VALUES ('$plasticPickupDay', '$Time', '$DateUpdated')";
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