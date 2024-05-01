<?php include('include/header.php'); ?>
</div>
<br>
<br>
<!-- join activity section -->

<?php
session_start();
$UserID = $_SESSION['UserID'];
require_once('../Database/database.php');

if (isset($_GET['ActivityID']) && isset($_GET['DateJoined'])) {
    $ActivityID = $_GET['ActivityID'];
    $DateJoined = $_GET['DateJoined'];

    // Sanitize input if necessary

    $query = "INSERT INTO activitiesjoined (ActivityID, UserID, DateJoined) VALUES ('$ActivityID', '$UserID', '$DateJoined')";
    $result = mysqli_query($dbc, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($dbc));
    } else {
        // echo "You have successfully joined the activity.";
        header('location: join-activity-success.php');
    }
} else {
    header('location: join-activity-failed.php');
}
?>

<!-- end join activity section -->


  <!-- end join activity section -->

  <?php include('include/footer.php'); ?>
