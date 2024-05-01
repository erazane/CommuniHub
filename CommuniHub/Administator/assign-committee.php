<?php 
session_start();
include('include/header.php');
?>
</div>  

<?php
require_once ('../Database/database.php');

if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
    // Display success message using SweetAlert
    echo '<script>swal("Success!", "' . $_SESSION['status'] . '", "' . $_SESSION['status_code'] . '");</script>';
    // Unset the session variables
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserID = isset($_POST['UserID']) ? $_POST['UserID'] : "";
    $CommiteePost = isset($_POST['CommiteePost']) ? $_POST['CommiteePost'] : "";
    $commStartDate = isset($_POST['commStartDate']) ? $_POST['commStartDate'] : "";
    $commEndDate = isset($_POST['commEndDate']) ? $_POST['commEndDate'] : "";
   
    // Check for empty input
    if (!empty($UserID) && !empty($CommiteePost) && !empty($commStartDate) && !empty($commEndDate)){
        // Insert new user
        $query = "INSERT INTO commitee (UserID, CommiteePost, commStartDate, commEndDate) VALUES ('$UserID', '$CommiteePost', '$commStartDate', '$commEndDate')";
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
                echo "Data is already in database";
            }
     }
    

?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Add User</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="manage-user.php">Active Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="add-user.php">Add User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="committee.php">Committee</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <h4><strong>Fill out the form below to assign a user as a committee.</strong></h4>
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
                                <label for="UserID">User ID:</label>
                                <input type="text" name="UserID" id="<?php htmlspecialchars($_GET["UserID"]) ?>" value="<?php echo htmlspecialchars($_GET["UserID"]) ?>">

                            </div>
                            <div class="form-group">
                                <label for="CommiteePost">Position :</label>
                                <select class="form-control" id="CommiteePost" name="CommiteePost" required>

                                    <option value="" disabled selected>Select Status</option>
                                    <option value="President">President</option>
                                    <option value="Vice President">Vice President</option>
                                    <option value="Secretary">Secretary</option>
                                    <option value="Vice Secretary">Vice Secretary</option>
                                    <option value="Treasurer">Treasurer</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Technical">Technical</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="commStartDate">Start Date :</label>
                                <input type="date" class="form-control" id="commStartDate" name="commStartDate" required>
                            </div>
                            <div class="form-group">
                                <label for="commEndDate">End Date :</label>
                                <input type="date" class="form-control" id="commEndDate" name="commEndDate" required>
                            </div>
                            <div class="text-right">
                                <button type="button" onclick="addComm();" class="btn btn-primary btn-lg">Confirm</button>
                            </div>
                            <script>
                                function addComm() {
                                    // var UserID = document.getElementById("UserID").value.trim();
                                    var CommiteePost = document.getElementById("CommiteePost").value.trim();
                                    var commStartDate = document.getElementById("commStartDate").value.trim();
                                    var commEndDate = document.getElementById("commEndDate").value.trim();

                                    if (
                                        // UserID === "" ||
                                         CommiteePost === "" ||
                                        commStartDate === "" || commEndDate === ""){
                                    
                                        swal(
                                            "Error!",
                                             "Please fill out all required fields.",
                                             "error"
                                              );
                                            return;
                                             } 
                                            // Check if swal is called
                                            console.log("SweetAlert called");
                                            swal({
                                                title: "Assign this user?",
                                                text: "Click confirm if you would like this user to be a committee",
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
