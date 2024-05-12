<?php
session_start();
require_once('../Database/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $ActivityID = mysqli_real_escape_string($dbc, $_POST['ActivityID']);
    $ActivityName = mysqli_real_escape_string($dbc, $_POST['ActivityName']);
    $ActivityLocation = mysqli_real_escape_string($dbc, $_POST['ActivityLocation']);
    $ActivityDate = mysqli_real_escape_string($dbc, $_POST['ActivityDate']);
    $ActivityTime = mysqli_real_escape_string($dbc, $_POST['ActivityTime']);
    $ActivityType = mysqli_real_escape_string($dbc, $_POST['ActivityType']);
    $Status = mysqli_real_escape_string($dbc, $_POST['Status']);

    // Query for update
    $query = "UPDATE activities 
              SET ActivityName = '$ActivityName', 
                  ActivityLocation = '$ActivityLocation', 
                  ActivityDate = '$ActivityDate', 
                  ActivityTime = '$ActivityTime', 
                  ActivityType = '$ActivityType', 
                  Status = '$Status' 
              WHERE ActivityID = $ActivityID";
    
    $updateResult = mysqli_query($dbc, $query);

    if ($updateResult) {
        $_SESSION['status'] = "Updated successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error updating record: " . mysqli_error($dbc);
        $_SESSION['status_code'] = "error";
    }
} else {
    $_SESSION['status'] = "Unable to update data";
    $_SESSION['status_code'] = "error";
}

header("Location: manage-activities.php");
exit();
?>
