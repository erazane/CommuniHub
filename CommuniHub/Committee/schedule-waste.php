<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->

<?php
require_once('../Database/database.php'); // Connect to the db.
global $dbc;

// Make the query for the latest schedule.
$query = "SELECT ScheduleID, GarbageDay, Time,  DateUpdated
         FROM schedule
         ORDER BY ScheduleID DESC
         LIMIT 1";
$result = @mysqli_query($dbc, $query);

$row = mysqli_fetch_assoc($result); // Fetching data from the database row
$latestScheduleID = $row['ScheduleID'];
$latestGarbageDay = $row['GarbageDay'];
$latestTime = $row['Time'];
$latestDateUpdated = $row['DateUpdated'];

// Make the query for the schedule history.
$queryHistory = "SELECT ScheduleID, GarbageDay, Time, DateUpdated
                FROM schedule
                WHERE ScheduleID != $latestScheduleID
                ORDER BY ScheduleID DESC";
$resultHistory = @mysqli_query($dbc, $queryHistory);

if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
    // Display success message using SweetAlert
    echo '<script>swal("Success!", "' . $_SESSION['status'] . '", "' . $_SESSION['status_code'] . '");</script>';
    // Unset the session variables
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $GarbageDay = isset($_POST['GarbageDay']) ? $_POST['GarbageDay'] : "";
    $Time = isset($_POST['Time']) ? $_POST['Time'] : "";
    $DateUpdated = isset($_POST['DateUpdated']) ? $_POST['DateUpdated'] : "";

    // Check for empty input
    if (!empty($GarbageDay) && !empty($Time) && !empty($DateUpdated)) {
        // Insert new schedule
        $query = "INSERT INTO schedule (GarbageDay, Time, DateUpdated) 
                  VALUES ('$GarbageDay', '$Time', '$DateUpdated')";
        $insertResult = mysqli_query($dbc, $query);

        if ($insertResult) {
            $_SESSION['status'] = "Inserted successfully!";
            $_SESSION['status_code'] = "success";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($dbc);
        }
    } else {
        $_SESSION['status'] = "Unable to insert data";
        $_SESSION['status_code'] = "error";
        echo "Admin with the same name already exists!";
    }
       
    }



?>
<section class="service_section layout_padding">
    <div class="container">
    <div class="heading_container heading_center">
            <h2>General Waste </h2>
            <hr>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="schedule-waste.php" class="btn btn-primary active">Current</a>
                <a href="history-waste.php" class="btn btn-secondary">History</a>
            </div>


        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4><strong>Update current schedule</strong></h4>
                        <hr>
                        <!-- Form for adding new schedule -->
                        <form id="scheduleForm" action="#" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="GarbageDay">Garbage Day:</label>
                                <select class="form-control" id="GarbageDay" name="GarbageDay" required>
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Resident">Sunday</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="Time">Time:</label>
                                <input type="time" class="form-control" id="Time" name="Time" required>
                            </div>
                            <div class="form-group">
                                <label for="DateUpdated">DateUpdated:</label>
                                <input type="date" class="form-control" id="DateUpdated" name="DateUpdated" required>
                            </div>
                        </form>
                        <!-- Button to trigger form submission -->
                        <div class="text-right">
                            <button type="button" onclick="updateSchedule();" class="btn-primary btn-lg">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4><strong>Current Schedule</strong></h4>
                        <hr>
                        <!-- Display current schedule -->
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Day</th>
                                    <th scope="col">Time Updated</th>
                                    <th scope="col">Date Updated</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $latestGarbageDay; ?></td>
                                    <td><?php echo $latestTime; ?></td>
                                    <td><?php echo $latestDateUpdated; ?></td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function updateSchedule() {
        // Get form data
        var formData = new FormData(document.getElementById('scheduleForm'));

        // Check if all required fields are filled
        var GarbageDay = formData.get('GarbageDay');
        var time = formData.get('Time');
        var dateUpdated = formData.get('DateUpdated');

        if (!GarbageDay || !time || !dateUpdated) {
            // If any of the fields are empty, show a SweetAlert
            swal("Error!", "Please fill in all fields", "error");
            return; // Stop the function execution
        }

        // Send form data asynchronously using AJAX
        $.ajax({
            type: 'POST',
            url: 'process_schedule.php', // Update this with the actual PHP processing file
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success response
                swal("Success!", response, "success");
                // Optionally update the current schedule display
            },
            error: function(xhr, status, error) {
                // Handle error response
                swal("Error!", "An error occurred: " + error, "error");
            }
        });
    }
    header("Refresh:0");
</script>

<?php include('include/footer.php'); ?>
