<?php
session_start();
require_once('include/header.php'); 
require_once('../Database/database.php');



if (isset($_POST['ComplainTitle']) && isset($_POST['ComplaintDesc']) && isset($_POST['ComplaintType'])) {
    $UserID = $_SESSION["UserID"];  // Assuming the UserID is stored in the session
    $ComplainTitle = $_POST['ComplainTitle'];
    $ComplaintDesc = $_POST['ComplaintDesc'];
    $ComplaintDate = date("Y-m-d H:i:s");  // Get the current date and time
    $ComplaintType = $_POST['ComplaintType'];

    $newImageName = null;
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
            move_uploaded_file($tmpName, '../front-end/images/complaint/' . $newImageName);
        }
    }

    if (!empty($ComplainTitle) && !empty($ComplaintDesc) && !empty($ComplaintType)) {
        $query = "INSERT INTO complaint (UserID, ComplainTitle, ComplaintDesc, ComplaintDate, ComplaintType, image)
                  VALUES ('$UserID', '$ComplainTitle', '$ComplaintDesc', '$ComplaintDate', '$ComplaintType', '$newImageName')";

        $insertResult = mysqli_query($dbc, $query);

        if ($insertResult) {
            $_SESSION['status'] = "Complaint Successful";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Error: " . mysqli_error($dbc);
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "Unable to insert data";
        $_SESSION['status_code'] = "error";
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Add Complaint</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Fill Out the Form Below to Add a New Complaint</h4>
                        <h5>How to Make a Complaint:</h5>
                        <br>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">
                                <strong>Give a Descriptive Title:</strong> Choose a clear and descriptive title for your complaint.
                            </li>
                            <li class="list-group-item">
                                <strong>Give a Short Description:</strong> Provide a brief description of the issue (max 1000 characters).
                            </li>
                            <li class="list-group-item">
                                <strong>Select a Type of Complaint:</strong>
                                <ul class="pl-3">
                                    <li><strong>Safety & Wellbeing:</strong> Concerns related to neighborhood safety and the well-being of residents.</li>
                                    <li><strong>Infrastructure:</strong> Issues related to roads, sidewalks, street lighting, and other public infrastructure.</li>
                                    <li><strong>Noise:</strong> Complaints about loud noises, disturbances, and related nuisances.</li>
                                    <li><strong>Public Services:</strong> Issues regarding public services like garbage collection, water supply, and other municipal services.</li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <strong>Upload an Image:</strong> If relevant, upload an image that helps illustrate your complaint.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form id="addComplaint" action="#" method="POST" enctype="multipart/form-data">
                            <h4><strong>Fill out the form below to add a new complaint.</strong></h4>
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
                                <label for="ComplainTitle">Title:</label>
                                <input type="text" class="form-control" id="ComplainTitle" name="ComplainTitle" required>
                            </div>
                            <div class="form-group">
                                <label for="ComplaintDesc">Description:</label>
                                <textarea class="form-control" id="ComplaintDesc" name="ComplaintDesc" rows="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ComplaintType">Type:</label>
                                <select class="form-control" id="ComplaintType" name="ComplaintType" required>
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Safety & Wellbeing">Safety & Wellbeing</option>
                                    <option value="Infrastructure">Infrastructure</option>
                                    <option value="Noise">Noise</option>
                                    <option value="Public Services">Public Services</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                            </div>

                            <div class="text-right">
                                <button type="button" onclick="addComplaint();" class="btn btn-primary btn-lg">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h5>Your voice matters to make our community a better place.</h5>
                        <div class="text-right">
                            <a href="UserProfile-read.php" class="btn btn-secondary btn-lg">Back</a>
                            <a href="pending-complaints.php" class="btn btn-primary btn-lg">Pending</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function addComplaint() {
        var ComplaintTitle = document.getElementById("ComplainTitle").value.trim();
        var ComplaintDesc = document.getElementById("ComplaintDesc").value.trim();
        var ComplaintType = document.getElementById("ComplaintType").value.trim();

        if (ComplaintTitle === "" || ComplaintDesc === "" || ComplaintType === "") {
            swal("Error!", "Please fill out all required fields.", "error");
            return;
        }

        swal({
            title: "Would you like to make this complaint?",
            text: "Click confirm if you wish to proceed",
            icon: "info",
            buttons: true,
            dangerMode: true,
        }).then((willProceed) => {
            if (willProceed) {
                document.getElementById("addComplaint").submit();
            } else {
                console.log("User cancelled.");
            }
        });
    }
</script>

<?php include('include/footer.php'); ?>
