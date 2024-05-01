<?php
session_start();
require_once('../Database/database.php'); // Connect to the db.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $GlassPickupday = isset($_POST['GlassPickupday']) ? $_POST['GlassPickupday'] : "";
    $Time = isset($_POST['Time']) ? $_POST['Time'] : "";
    $DateUpdated = isset($_POST['DateUpdated']) ? $_POST['DateUpdated'] : "";

    // Check for empty input
    if (!empty($GlassPickupday) && !empty($Time) && !empty($DateUpdated)) {
        // Insert new glassschedule
        $query = "INSERT INTO glassschedule (GlassPickupday, Time, DateUpdated) 
                  VALUES ('$GlassPickupday', '$Time', '$DateUpdated')";
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
