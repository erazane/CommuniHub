<?php
session_start();
require_once('../Database/database.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $activityID = isset($_POST['activityID']) ? intval($_POST['activityID']) : 0;
    $activityName = isset($_POST['ActivityName']) ? mysqli_real_escape_string($dbc, $_POST['ActivityName']) : '';
    $activityLocation = isset($_POST['ActivityLocation']) ? mysqli_real_escape_string($dbc, $_POST['ActivityLocation']) : '';
    $activityDate = isset($_POST['ActivityDate']) ? mysqli_real_escape_string($dbc, $_POST['ActivityDate']) : '';
    $activityTime = isset($_POST['ActivityTime']) ? mysqli_real_escape_string($dbc, $_POST['ActivityTime']) : '';
    $activityType = isset($_POST['ActivityType']) ? mysqli_real_escape_string($dbc, $_POST['ActivityType']) : '';
    $status = isset($_POST['status']) ? mysqli_real_escape_string($dbc, $_POST['status']) : '';

    // Update query
    $updateQuery = "UPDATE activities 
                    SET ActivityName = '$activityName',
                        ActivityLocation = '$activityLocation',
                        ActivityDate = '$activityDate',
                        ActivityTime = '$activityTime',
                        ActivityType = '$activityType',
                        Status = '$status'
                    WHERE ActivityID = $activityID";

    // Perform the update
    $result = mysqli_query($dbc, $updateQuery);

    if ($result) {
        // Set success message
        $_SESSION['status'] = "Activity updated successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        // Set error message if update fails
        $_SESSION['status'] = "Error updating activity: " . mysqli_error($dbc);
        $_SESSION['status_code'] = "error";
    }

    // Redirect to manage-activities.php
    header('Location: manage-activities.php');
    exit();
} else {
    // Redirect if accessed directly without POST request
    header('Location: manage-activities.php');
    exit();
}
