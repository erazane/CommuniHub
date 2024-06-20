<?php
session_start();
include('include/header.php');

?>
</div>
<!-- end header section -->

<?php
require_once ('../Database/database.php');

if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
    // Display success message using SweetAlert
    echo '<script>swal("Success!", "' . htmlspecialchars($_SESSION['status']) . '", "' . htmlspecialchars($_SESSION['status_code']) . '");</script>';
    // Unset the session variables
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}

// Check if form is submitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ActivityName = isset($_POST['ActivityName']) ? $_POST['ActivityName'] : "";
    $ActivityLocation = isset($_POST['ActivityLocation']) ? $_POST['ActivityLocation'] : "";
    $ActivityDate = isset($_POST['ActivityDate']) ? $_POST['ActivityDate'] : "";
    $ActivityTime = isset($_POST['ActivityTime']) ? $_POST['ActivityTime'] : "";
    $ActivityType = isset($_POST['ActivityType']) ? $_POST['ActivityType'] : "";
    $Status = isset($_POST['Status']) ? $_POST['Status'] : "";

    // // Image upload handling
    // if ($_FILES["image"]["error"] != 4) {
    //     $filename = $_FILES["image"]["name"];
    //     $filesize = $_FILES["image"]["size"];
    //     $tmpName = $_FILES["image"]["tmp_name"];

    //     $validImageExtension = ['jpg', 'jpeg', 'png'];
    //     $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    //     if (!in_array($imageExtension, $validImageExtension)) {
    //         echo "<script>alert('Invalid Image Extension');</script>";
    //     } elseif ($filesize > 1000000) {
    //         echo "<script>alert('Image Size Too large');</script>";
    //     } else {
    //         $newImageName = uniqid() . '.' . $imageExtension;
    //         move_uploaded_file($tmpName, '../Committee/images/Activities/' . $newImageName);
    //     }
    // }
    
    // Check for empty input
    if (!empty($ActivityName) && !empty($ActivityLocation) && !empty($ActivityDate) && !empty($ActivityTime) && !empty($ActivityType)) {
        $escapedActivityName = mysqli_real_escape_string($dbc, $ActivityName);
        // Insert new donation with image filename
        $query = "INSERT INTO activities (ActivityName, ActivityLocation, ActivityDate, ActivityTime, ActivityType, Status ) 
            VALUES ('$escapedActivityName', '$ActivityLocation', '$ActivityDate', '$ActivityTime', '$ActivityType', '$Status' )";
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
    }
}
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Add Activities</h2>
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
                            <a class="nav-link" href="activities-joined.php"> Activities joined</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="add-activities.php">Add Activities</a>
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
                    <form id="addActivitiesForm" action="#" method="POST" enctype="multipart/form-data">
                            <h4><strong>Fill out the form below to add a new donation.</strong></h4>
                            <hr>
                            <?php
                                // Check if success message is set
                                if (isset($_SESSION['success'])) {
                                    // Display success message using SweetAlert
                                    echo '<script>swal("Success!", "' . $_SESSION['success'] . '", "success");</script>';
                                    // Unset the session variable
                                    unset($_SESSION['success']);
                                }
                            ?>
                            <div class="form-group">
                                <label for="ActivityName">Title:</label>
                                <input type="text" class="form-control" id="ActivityName" name="ActivityName" required>
                            </div>
                            <div class="form-group">
                                <label for="ActivityLocation">Location:</label>
                                <textarea class="form-control" id="ActivityLocation" name="ActivityLocation" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ActivityDate">Date:</label>
                                <input type="date" class="form-control" id="ActivityDate" name="ActivityDate" required>
                            </div>
                            <div class="form-group">
                                <label for="ActivityTime">Time:</label>
                                <input type="time" class="form-control" id="ActivityTime" name="ActivityTime" required>
                            </div>
                            <div class="form-group">
                                <label for="ActivityType">Activity Type:</label>
                                <select class="form-control" id="ActivityType" name="ActivityType" required>
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Clean-up Day">Clean-up Day</option>
                                    <option value="Block-Party">Block Party</option>
                                    <option value="Community-Garden">Community Garden</option>
                                    <option value="Fitness-Classes">Fitness Classes</option>
                                    <option value="Holiday-Celebrations">Holiday Celebrations</option>
                                    <option value="Workshops">Workshops</option>
                                    <option value="Other">Others..</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Status">Status:</label>
                                <select class="form-control" id="Status" name="Status" required>
                                    <option value="" disabled selected>Select status</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="image">Image:</label>
                                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="">
                            </div> -->
                            
                            
                            <div class="text-right">
                                <button type="button" onclick="addActivities();" class="btn btn-primary btn-lg">Confirm</button>
                            </div>
                            
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                               function addActivities() {
                                    var ActivityName = document.getElementById("ActivityName").value.trim();
                                    var ActivityLocation = document.getElementById("ActivityLocation").value.trim();
                                    var ActivityDate = document.getElementById("ActivityDate").value.trim();
                                    var ActivityTime = document.getElementById("ActivityTime").value.trim();
                                    var ActivityType = document.getElementById("ActivityType").value.trim();
                                    var Status = document.getElementById("Status").value.trim(); 
                                    // var image = document.getElementById("image").files[0]; // Get the file object  || !image

                                    if (
                                        ActivityName === "" || ActivityLocation === "" ||
                                        ActivityDate === "" || ActivityTime === "" ||
                                        ActivityType === ""   ) {

                                        swal("Error!", "Please fill out all required fields.", "error");
                                        return;
                                    }
                                            // Check if swal is called
                                            console.log("SweetAlert called");
                                        Swal.fire({
                                        title: "Add this activity?",
                                                text: "Click confirm if you would like to add this activity",
                                                icon: "info",
                                                showCancelButton: true,
                                                confirmButtonText: 'Confirm',
                                                cancelButtonText: 'Cancel',
                                                reverseButtons: true
                                             }).then((willJoin) => {
                                                if (willJoin) {
                                                    // If user confirms, submit the form
                                                    document.querySelector('form').submit();
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
