<?php
session_start();
include('include/header.php');
?>
</div>
<?php
require_once('../Database/database.php');

// Get activityID from the GET request or POST data
$ActivityID = isset($_GET['ActivityID']) ? intval($_GET['ActivityID']) : 0;

// Fetch existing activity data
$query = "SELECT * FROM activities WHERE ActivityID = '$ActivityID'";
$result = mysqli_query($dbc, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $activity = mysqli_fetch_assoc($result);
} else {
    die('Invalid activity ID or activity not found.');
}
?>
<br>
<br>
<div class="container" style="max-width: 1500px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="heading_container heading_center">
                <h2>Update : <?php echo htmlspecialchars($activity['ActivityName']); ?></h2>
                <hr style="width: 350px; text-align: center">
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <!-- Form for updating activity details -->
                                <form id="UpdateActivity" action="process-activities-update.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="activityID" value="<?php echo $ActivityID; ?>">
                                    <div class="form-group">
                                        <label for="ActivityName">Title:</label>
                                        <input type="text" class="form-control" id="ActivityName" name="ActivityName" value="<?php echo htmlspecialchars($activity['ActivityName']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ActivityLocation">Location:</label>
                                        <textarea class="form-control" id="ActivityLocation" name="ActivityLocation" rows="5" required><?php echo htmlspecialchars($activity['ActivityLocation']); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="ActivityDate">Date:</label>
                                        <input type="text" class="form-control" id="ActivityDate" name="ActivityDate" value="<?php echo htmlspecialchars($activity['ActivityDate']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ActivityTime">Time:</label>
                                        <input type="time" class="form-control" id="ActivityTime" name="ActivityTime" value="<?php echo htmlspecialchars($activity['ActivityTime']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ActivityType">Activity Type:</label>
                                        <select class="form-control" id="ActivityType" name="ActivityType" required>
                                            <option value="" disabled>Select Type</option>
                                            <option value="Clean-up Day" <?php if ($activity['ActivityType'] == 'Clean-up Day') echo 'selected'; ?>>Clean-up Day</option>
                                            <option value="Block-Party" <?php if ($activity['ActivityType'] == 'Block-Party') echo 'selected'; ?>>Block Party</option>
                                            <option value="Community-Garden" <?php if ($activity['ActivityType'] == 'Community-Garden') echo 'selected'; ?>>Community Garden</option>
                                            <option value="Fitness-Classes" <?php if ($activity['ActivityType'] == 'Fitness-Classes') echo 'selected'; ?>>Fitness Classes</option>
                                            <option value="Holiday-Celebrations" <?php if ($activity['ActivityType'] == 'Holiday-Celebrations') echo 'selected'; ?>>Holiday Celebrations</option>
                                            <option value="Workshops" <?php if ($activity['ActivityType'] == 'Workshops') echo 'selected'; ?>>Workshops</option>
                                            <option value="Other" <?php if ($activity['ActivityType'] == 'Other') echo 'selected'; ?>>Others..</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="" disabled>Select status</option>
                                            <option value="Ongoing" <?php if ($activity['Status'] == 'Ongoing') echo 'selected'; ?>>Ongoing</option>
                                            <option value="Completed" <?php if ($activity['Status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                                        </select>
                                    </div>
                                </form>
                                <div class="text-right">
                                    <a href="manage-activities.php" class="btn btn-secondary btn-lg">Back</a>
                                    <button type="button" onclick="UpdateActivity();" class="btn btn-primary btn-lg">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function UpdateActivity() {
        var ActivityName = document.getElementById("ActivityName").value.trim();
        var ActivityLocation = document.getElementById("ActivityLocation").value.trim();
        var ActivityDate = document.getElementById("ActivityDate").value.trim();
        var ActivityTime = document.getElementById("ActivityTime").value.trim();
        var ActivityType = document.getElementById("ActivityType").value.trim();
        var status = document.getElementById("status").value.trim(); 

        Swal.fire({
            title: "Would you like to update this activity?",
            text: "Click confirm if you wish to proceed",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
        }).then((willProceed) => {
            if (willProceed.isConfirmed) {
                document.getElementById("UpdateActivity").submit();
            } else {
                console.log("User cancelled.");
            }
        });
    }
</script>
<br>
<br>
<?php include('include/footer.php'); ?>
