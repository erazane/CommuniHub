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

// Make the query to retrieve activity details
$query = "
SELECT a.ActivityID, a.Activityname, a.ActivityLocation, a.ActivityDate, a.ActivityTime, a.ActivityType
FROM activitiesJoined aj
JOIN activities a ON aj.ActivityID = a.ActivityID
WHERE aj.UserID = $UserID
AND a.Status != 'Completed';
";

$result = mysqli_query($dbc, $query); // Run the query

// Check for query execution errors
if (!$result) {
    die('Error: ' . mysqli_error($dbc));
}

?>
<!-- Display joined activities in a table -->
<section class="service_section layout_padding wider_section">
    <div class="container">
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
                            <th scope="col"> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['Activityname']; ?></td>
                                <td><?php echo $row['ActivityLocation']; ?></td>
                                <td><?php echo $row['ActivityDate']; ?></td>
                                <td><?php echo $row['ActivityTime']; ?></td>
                                <td><?php echo $row['ActivityType']; ?></td>

                                <td>
                                <div class="btn-group" style="padding: 5;">
                                    <br><br>
                                    
                                    <button type="button" class="btn btn-warning" onclick="unjoin(<?php echo $row['ActivityID']; ?>)">Unjoin </button>
                                    
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <a class="nav-link btn btn-secondary" href="UserProfile-read.php">Back</a>
                <a class="nav-link btn btn-secondary" href="activity-history.php">History</a>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
