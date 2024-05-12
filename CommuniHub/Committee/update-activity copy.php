<?php
session_start();
include('include/header.php');

?>
</div>
<!-- end header section -->

<?php
require_once ('../Database/database.php');

if (isset($_GET["ActivityID"])) {
    $ActivityID = $_GET["ActivityID"];

    if (!isset($_SESSION["ActivityID"])) {
        $_SESSION["ActivityID"] = $ActivityID; // Set ActivityID in session if it's not already set
    }
}

if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
    // Display success message using SweetAlert
    echo '<script>swal("Success!", "' . htmlspecialchars($_SESSION['status']) . '", "' . htmlspecialchars($_SESSION['status_code']) . '");</script>';
    // Unset the session variables
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}

$ActivityName = $ActivityLocation = $ActivityDate = $ActivityTime = $ActivityType = $Status = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted 
    $query = "SELECT * FROM activities WHERE ActivityID = $ActivityID";
    $result = mysqli_query($dbc, $query);

    // Check if there is a result
    if (mysqli_num_rows($result) > 0) {
        // Fetch the activity data
        $activityData = mysqli_fetch_assoc($result);
        $ActivityName = $activityData['ActivityName'];
        $ActivityLocation = $activityData['ActivityLocation'];
        $ActivityDate = $activityData['ActivityDate'];
        $ActivityTime = $activityData['ActivityTime'];
        $ActivityType = $activityData['ActivityType'];
        $Status = $activityData['Status'];
        
        // Check for empty input
        if (!empty($ActivityName) && !empty($ActivityLocation) && !empty($ActivityDate) && !empty($ActivityTime) && !empty($ActivityType)) {
            $escapedActivityName = mysqli_real_escape_string($dbc, $ActivityName);
            // Update activity details in the database
            $query = "UPDATE activities 
                      SET ActivityName = '$escapedActivityName', 
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
                echo "Error: " . $query . "<br>" . mysqli_error($dbc);
            }
        } else {
            $_SESSION['status'] = "Unable to update data";
            $_SESSION['status_code'] = "error";
        }
    }
}
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Update Activities</h2>
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
                            <a class="nav-link " href="add-activities.php">Add Activities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="activities-history.php">History</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form id="updateActivitiesForm" action="#" method="POST" enctype="multipart/form-data">
                            <h4><strong>Fill out the form below to update current activity</strong></h4>
                            <hr>
                            <div class="form-group">
                                <label for="ActivityName">Title:</label>
                                
                                <input type="text" class="form-control" id="ActivityName" name="ActivityName" value="<?php echo htmlspecialchars($ActivityName); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="ActivityLocation">Location:</label>
                                <textarea class="form-control" id="ActivityLocation" name="ActivityLocation" rows="5"><?php echo isset($ActivityLocation) ? $ActivityLocation : ''; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ActivityDate">Date:</label>
                                <input type="date" class="form-control" id="ActivityDate" name="ActivityDate" value="<?php echo isset($ActivityDate) ? $ActivityDate : ''; ?>" >
                            </div>
                            <div class="form-group">
                                <label for="ActivityTime">Time:</label>
                                <input type="time" class="form-control" id="ActivityTime" name="ActivityTime" value="<?php echo isset($ActivityTime) ? $ActivityTime : ''; ?>" >
                            </div>
                            <div class="form-group">
                                <label for="ActivityType">Activity Type:</label>
                                <select class="form-control" id="ActivityType" name="ActivityType">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Clean-up Day" <?php echo ($ActivityType == 'Clean-up Day') ? 'selected' : ''; ?>>Clean-up Day</option>
                                    <option value="Block-Party" <?php echo ($ActivityType == 'Block-Party') ? 'selected' : ''; ?>>Block Party</option>
                                    <option value="Community-Garden" <?php echo ($ActivityType == 'Community-Garden') ? 'selected' : ''; ?>>Community Garden</option>
                                    <option value="Fitness-Classes" <?php echo ($ActivityType == 'Fitness-Classes') ? 'selected' : ''; ?>>Fitness Classes</option>
                                    <option value="Holiday-Celebrations" <?php echo ($ActivityType == 'Holiday-Celebrations') ? 'selected' : ''; ?>>Holiday Celebrations</option>
                                    <option value="Workshops" <?php echo ($ActivityType == 'Workshops') ? 'selected' : ''; ?>>Workshops</option>
                                    <option value="Other" <?php echo ($ActivityType == 'Other') ? 'selected' : ''; ?>>Others..</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Status">Status:</label>
                                <select class="form-control" id="Status" name="Status" required>
                                    <option value="" disabled selected>Select status</option>
                                    <option value="Ongoing" <?php echo ($Status == 'Ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                                    <option value="Completed" <?php echo ($Status == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                </select>
                            </div>
                            <div class="text-right">
                                <button type="button" onclick="updateActivities();" class="btn btn-primary btn-lg">Confirm</button>
                            </div>
                            <script>
                                function updateActivities() {
                                    var ActivityName = document.getElementById("ActivityName").value.trim();
                                    var ActivityLocation = document.getElementById("ActivityLocation").value.trim();
                                    var ActivityDate = document.getElementById("ActivityDate").value.trim();
                                    var ActivityTime = document.getElementById("ActivityTime").value.trim();
                                    var ActivityType = document.getElementById("ActivityType").value.trim();
                                    var Status = document.getElementById("Status").value.trim(); 

                                    if (ActivityName === "" || ActivityLocation === "" ||
                                        ActivityDate === "" || ActivityTime === "" ||
                                        ActivityType === "" || Status === "") {

                                        swal("Error!", "Please fill out all required fields.", "error");
                                        return;
                                    }

                                    swal({
                                        title: "Update this activity?",
                                        text: "Click confirm if you would like to update this activity",
                                        icon: "info",
                                        showCancelButton: true,
                                        confirmButtonText: 'Confirm',
                                        cancelButtonText: 'Cancel',
                                        reverseButtons: true
                                    }).then((willUpdate) => {
                                        if (willUpdate) {
                                            // If user confirms, submit the form
                                            document.getElementById('updateActivitiesForm').submit();
                                        } else {
                                            // If user cancels, do nothing
                                            console.log("User cancelled.");
                                        }
                                    });
                                }
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
