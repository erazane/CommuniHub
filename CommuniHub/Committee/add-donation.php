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
    $DonationName = isset($_POST['DonationName']) ? $_POST['DonationName'] : "";
    $DonationDesc = isset($_POST['DonationDesc']) ? $_POST['DonationDesc'] : "";
    $DonationTarget = isset($_POST['DonationTarget']) ? $_POST['DonationTarget'] : "";
    $DonationStartDate = isset($_POST['DonationStartDate']) ? $_POST['DonationStartDate'] : "";
    $DonationEndDate = isset($_POST['DonationEndDate']) ? $_POST['DonationEndDate'] : "";
    $DonationStatus = isset($_POST['DonationStatus']) ? $_POST['DonationStatus'] : "";
    $status = isset($_POST['status']) ? $_POST['status'] : "";
    
    // Image upload handling
    if ($_FILES["image"]["error"] != 4) {
        $filename = $_FILES["image"]["name"];
        $filesize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid Image Extension');</script>";
        } elseif ($filesize > 1000000) {
            echo "<script>alert('Image Size Too large');</script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            move_uploaded_file($tmpName, '../Committee/images/donations/' . $newImageName);
        }
    }
    
    // Check for empty input
    if (!empty($DonationName) && !empty($DonationDesc) && !empty($DonationTarget) && !empty($DonationStartDate) && !empty($DonationEndDate) && !empty($DonationStatus) && !empty($status)) {
        $escapedDonationDesc = mysqli_real_escape_string($dbc, $DonationDesc);

         $query = "INSERT INTO donation (DonationName, DonationDesc, DonationTarget, DonationStartDate, DonationEndDate, DonationStatus, status , image) 
            VALUES ('$DonationName', '$escapedDonationDesc', '$DonationTarget', '$DonationStartDate', '$DonationEndDate', '$DonationStatus', '$status' ,'$newImageName')";
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
            <h2>Add Donation</h2>
            <hr>
        </div>
        <div class="row">
        <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="manage-donation.php">Current Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="donation-joined.php">Donations Joined</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="add-donation.php">Add Donations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="donation-history.php">History</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                    <form id="addDonationForm" action="#" method="POST" enctype="multipart/form-data">
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
                                <label for="DonationName">Title:</label>
                                <input type="text" class="form-control" id="DonationName" name="DonationName" required>
                            </div>
                            <div class="form-group">
                                <label for="DonationDesc">Description:</label>
                                <textarea class="form-control" id="DonationDesc" name="DonationDesc" rows="5" required oninput="countWords()"></textarea>
                                <!-- <small id="wordCount" class="form-text text-muted">Word count: 0 / 1000</small> -->
                            </div>

                            <div class="form-group">
                                <label for="DonationTarget">Target:</label>
                                <input type="text" class="form-control" id="DonationTarget" name="DonationTarget" required>
                            </div>
                            <div class="form-group">
                                <label for="DonationStartDate">Start Date:</label>
                                <input type="date" class="form-control" id="DonationStartDate" name="DonationStartDate" required>
                            </div>
                            <div class="form-group">
                                <label for="DonationEndDate">End Date:</label>
                                <input type="date" class="form-control" id="DonationEndDate" name="DonationEndDate" required>
                            </div>
                            <div class="form-group">
                                <label for="DonationStatus">Priority:</label>
                                <select class="form-control" id="DonationStatus" name="DonationStatus" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="High">High Priority</option>
                                    <option value="Medium">Medium Priority</option>
                                    <option value="Low">Low Priority</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Completed">Completed</option>
                                
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="DonationEndDate">Image:</label>
                                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="">
                            </div>
                            
                            
                            <div class="text-right">
                                <button type="button" onclick="addDonation();" class="btn btn-primary btn-lg">Confirm</button>
                            </div>
                            <script>
                               function addDonation() {
                                    var DonationName = document.getElementById("DonationName").value.trim();
                                    var DonationDesc = document.getElementById("DonationDesc").value.trim();
                                    var DonationTarget = document.getElementById("DonationTarget").value.trim();
                                    var DonationStartDate = document.getElementById("DonationStartDate").value.trim();
                                    var DonationEndDate = document.getElementById("DonationEndDate").value.trim();
                                    var DonationStatus = document.getElementById("DonationStatus").value.trim();
                                    var status = document.getElementById("status").value.trim();
                                    var image = document.getElementById("image").files[0]; // Get the file object

                                    if (
                                        DonationName === "" || DonationDesc === "" ||
                                        DonationTarget === "" || DonationStartDate === "" ||
                                        DonationEndDate === "" || DonationStatus === "" || status==="" || !image  ) {

                                        swal("Error!", "Please fill out all required fields and select an image.", "error");
                                        return;
                                    }
                                            // Check if swal is called
                                            console.log("SweetAlert called");
                                    swal({
                                        title: "Add this donation?",
                                                text: "Click confirm if you would like to add this donation",
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
