<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->
<?php
require_once('../Database/database.php');

// Make the query
$query = "
    SELECT a.ActivityID, a.Activityname, a.ActivityLocation , a.ActivityDate, a.ActivityTime, a.ActivityType,
           COUNT(aj.UserID) AS NumJoined
    FROM activities a
    LEFT JOIN activitiesJoined aj ON a.ActivityID = aj.ActivityID WHERE a.Status = 'Ongoing'
    GROUP BY a.ActivityID, a.Activityname, a.ActivityLocation , a.ActivityDate, a.ActivityTime, a.ActivityType
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
            <h2>Activity Dashboard</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="manage-activities.php">Current Activities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="activities-joined.php"> Activities joined</a>
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
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Location</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Type</th>
                            <th scope="col">Participation</th>
                            <th scope="col">Action</th>
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
                            <td><?php echo $row['NumJoined']; ?></td>
                            
                            
                            
                            <td>
                                <div class="btn-group" style="padding: 5;">
                                    <br><br>
                                    
                                    <button type="button" class="btn btn-warning" onclick="deleteActivity(<?php echo $row['ActivityID']; ?>)">Delete </button>
                                    <a class="nav-link btn btn-secondary" href="update-activity.php?ActivityID=<?php echo $row['ActivityID']; ?>">Update</a>

                                    <!-- <a class="nav-link btn btn-secondary" href="update-activity.php?ActivityID=<?php echo $ActivityID; ?>">Update</a> -->


                                    <!-- <button type="button" class="btn btn-secondary" onclick="updateActivity(<?php echo $row['ActivityID']; ?>)">Update </button> -->
                                    

                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<?php include('include/footer.php'); ?>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function deleteActivity(ActivityID) {
        console.log("Deleting activity with ID: " + ActivityID);
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete-activities.php with ActivityID
                window.location.href = 'delete-activities.php?ActivityID=' + ActivityID;
            }
        });
    }

    
</script>
