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
    echo '<script>swal("Success!", "' . $_SESSION['status'] . '", "' . $_SESSION['status_code'] . '");</script>';
    // Unset the session variables
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserFirstName = isset($_POST['UserFirstName']) ? $_POST['UserFirstName'] : "";
    $UserLastName = isset($_POST['UserLastName']) ? $_POST['UserLastName'] : "";
    $UserUserName = isset($_POST['UserUserName']) ? $_POST['UserUserName'] : "";
    $UserAge = isset($_POST['UserAge']) ? $_POST['UserAge'] : "";
    $UserMartialStatus = isset($_POST['UserMartialStatus']) ? $_POST['UserMartialStatus'] : "";
    $UserOccupation = isset($_POST['UserOccupation']) ? $_POST['UserOccupation'] : "";
    $UserContactDetails = isset($_POST['UserContactDetails']) ? $_POST['UserContactDetails'] : "";
    $UserType = isset($_POST['UserType']) ? $_POST['UserType'] : "";

    // Check for empty input
    if (!empty($UserFirstName) && !empty($UserLastName) && !empty($UserUserName) && !empty($UserAge) && !empty($UserMartialStatus)
     && !empty($UserOccupation) && !empty($UserContactDetails) && !empty($UserType) )  {
        // Insert new user
        $query = "INSERT INTO user (UserFirstName, UserLastName, UserUserName, UserAge, UserMartialStatus, UserOccupation, UserContactDetails) 
                  VALUES ('$UserFirstName', '$UserLastName', '$UserUserName', '$UserAge', '$UserMartialStatus', '$UserOccupation', '$UserContactDetails' , '$UserType')";
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
                            <h4><strong>Fill out the form below to add a new user.</strong></h4>
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
                                <label for="UserFirstName">First Name:</label>
                                <input type="text" class="form-control" id="UserFirstName" name="UserFirstName" required>
                            </div>
                            <div class="form-group">
                                <label for="UserLastName">Last Name:</label>
                                <input type="text" class="form-control" id="UserLastName" name="UserLastName" required>
                            </div>
                            <div class="form-group">
                                <label for="UserUserName">Username:</label>
                                <input type="text" class="form-control" id="UserUserName" name="UserUserName" required>
                            </div>
                            <div class="form-group">
                                <label for="UserAge">Age:</label>
                                <input type="text" class="form-control" id="UserAge" name="UserAge" required>
                            </div>
                            <div class="form-group">
                                <label for="UserMartialStatus">Martial Status:</label>
                                <select class="form-control" id="UserMartialStatus" name="UserMartialStatus" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Married">Married</option>
                                    <option value="Unmarried">Unmarried</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="UserOccupation">Occupation:</label>
                                <input type="text" class="form-control" id="UserOccupation" name="UserOccupation" required>
                            </div>
                            <div class="form-group">
                                <label for="UserContactDetails">Contact Details:</label>
                                <input type="text" class="form-control" id="UserContactDetails" name="UserContactDetails" required>
                            </div>
                            <div class="form-group">
                                <label for="UserType">User Type:</label>
                                    <select class="form-control" id="UserType" name="UserType" required>
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="Resident">Resident</option>
                                    </select>
                            </div>
                            <div class="text-right">
                                <button type="button" onclick="addUser();" class="btn btn-primary btn-lg">Confirm</button>
                            </div>
                            <script>
                                function addUser() {
                                    var UserFirstName = document.getElementById("UserFirstName").value.trim();
                                    var UserLastName = document.getElementById("UserLastName").value.trim();
                                    var UserUserName = document.getElementById("UserUserName").value.trim();
                                    var UserAge = document.getElementById("UserAge").value.trim();
                                    var UserMartialStatus = document.getElementById("UserMartialStatus").value.trim();
                                    var UserOccupation = document.getElementById("UserOccupation").value.trim();
                                    var UserContactDetails = document.getElementById("UserContactDetails").value.trim(); 
                                    var UserType = document.getElementById("UserType").value.trim();

                                    if (
                                        UserFirstName === "" || UserLastName === "" ||
                                        UserUserName === "" || UserAge === "" ||
                                        UserMartialStatus === "" || UserOccupation === "" ||
                                        UserContactDetails === "" || UserType==="" ){
                                    
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
                                                title: "Add this user?",
                                                text: "Click confirm if you would like to add this user",
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
