<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->
<?php
require_once('../Database/database.php');

// Make the query to retrieve activity details
$query = "
    SELECT a.ActivityID, a.Activityname, a.ActivityDate, a.ActivityTime, a.ActivityType,
           COUNT(aj.UserID) AS NumJoined
    FROM activities a
    LEFT JOIN activitiesJoined aj ON a.ActivityID = aj.ActivityID WHERE a.Status = 'Ongoing'
    GROUP BY a.ActivityID, a.Activityname, a.ActivityDate, a.ActivityTime, a.ActivityType
";

$result = mysqli_query($dbc, $query); // Run the query

// Check for query execution errors
if (!$result) {
    die('Error: ' . mysqli_error($dbc));
}

?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Activity Dashboard</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="manage-activities.php">Current Activities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="activities-joined.php"> Activities joined</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-activities.php">Add Activities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="activities-history.php">History</a>
                        </li>
                     
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div id="accordion">
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="card">
                            <div class="card-header" id="heading<?php echo $row['ActivityID']; ?>">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $row['ActivityID']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $row['ActivityID']; ?>">
                                        <?php echo $row['Activityname']; ?>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapse<?php echo $row['ActivityID']; ?>" class="collapse" aria-labelledby="heading<?php echo $row['ActivityID']; ?>" data-parent="#accordion">
                                <div class="card-body">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">User ID</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Make the query to retrieve user details who have joined this activity
                                            $userQuery = "
                                                SELECT u.UserID, u.UserUserName, u.UserEmail
                                                FROM user u
                                                INNER JOIN activitiesJoined aj ON u.UserID = aj.UserID
                                                WHERE aj.ActivityID = {$row['ActivityID']}
                                            ";
                                            $userResult = mysqli_query($dbc, $userQuery); // Run the query

                                            // Check for query execution errors
                                            if (!$userResult) {
                                                die('Error: ' . mysqli_error($dbc));
                                            }

                                            // Display user details
                                            while ($userRow = mysqli_fetch_assoc($userResult)) :
                                            ?>
                                                <tr>
                                                    <td><?php echo $userRow['UserID']; ?></td>
                                                    <td><?php echo $userRow['UserUserName']; ?></td>
                                                    <td><?php echo $userRow['UserEmail']; ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
