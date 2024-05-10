<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->
<?php
require_once('../Database/database.php');

// Get user ID
$UserID = $_SESSION["UserID"];

// Make the query to retrieve the user's joined activities history
$query = "
    SELECT a.ActivityID, a.Activityname, a.ActivityLocation, a.ActivityDate, a.ActivityTime, a.ActivityType
    FROM activities a
    JOIN activitiesJoined aj ON a.ActivityID = aj.ActivityID
    WHERE aj.UserID = $UserID
    AND a.Status = 'Completed'
";

$result = mysqli_query($dbc, $query); // Run the query

// Check if query was successful
if (!$result) {
    // Display error message and exit if query fails
    echo "Error: " . mysqli_error($dbc);
    exit();
}

?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Activity History</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Location</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['Activityname']; ?></td>
                                <td style="text-align: justify;"><?php echo $row['ActivityLocation']; ?></td>
                                <td><?php echo $row['ActivityDate']; ?></td>
                                <td><?php echo $row['ActivityTime']; ?></td>
                                <td><?php echo $row['ActivityType']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <a class="nav-link btn btn-secondary" href="UserProfile-read.php">Back</a>
                <a class="nav-link btn btn-secondary" href="activities-joined">Upcoming Activities</a>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
