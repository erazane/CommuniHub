<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->
<?php
require_once('../Database/database.php');

$filterOrder = isset($_GET['filterOrder']) ? $_GET['filterOrder'] : 'DESC';
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
        <div class="row justify-content-between align-items-center mt-3">
            <div class="col-md-3">
                <a class="btn btn-primary" href="activities-joined.php">Upcoming</a>
                <a class="btn btn-primary active" href="activity-history.php">History</a>
            </div>
            <div class="col-md-9">
                <!-- Filter Form -->
                <form class="form-inline justify-content-end" method="GET" action="">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="filterOrder" class="mr-2">Order:</label>
                        <select class="form-control" id="filterOrder" name="filterOrder">
                            <option value="ASC" <?php if ($filterOrder == 'ASC') echo 'selected'; ?>>Ascending</option>
                            <option value="DESC" <?php if ($filterOrder == 'DESC') echo 'selected'; ?>>Descending</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Apply Filters</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Location</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter=1;
                         while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $counter++ ?></td>
                                <td><?php echo $row['Activityname']; ?></td>
                                <td style="text-align: justify;"><?php echo $row['ActivityLocation']; ?></td>
                                <td><?php echo $row['ActivityDate']; ?></td>
                                <td><?php echo $row['ActivityTime']; ?></td>
                                <td><?php echo $row['ActivityType']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <hr>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary me-md-2" href="UserProfile-read.php">Back</a>
                </div>
                <!-- <a class="nav-link btn btn-secondary" href="UserProfile-read.php">Back</a> -->
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
