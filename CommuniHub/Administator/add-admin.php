<?php
session_start();
include('include/header.php');
 ?>

<!-- end header section -->
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
    $NewAdminName = isset($_POST['NewAdminName']) ? $_POST['NewAdminName'] : ""; // Initialize variables with form data if available
    $AdminUsername = isset($_POST['AdminUsername']) ? $_POST['AdminUsername'] : "";
    $AdminPassword = isset($_POST['AdminPassword']) ? $_POST['AdminPassword'] : "";

    $AdminPassword = crypt($_POST['AdminPassword'], 'ahookdemok');

    // Check for empty input
    if (!empty($NewAdminName) && !empty($AdminUsername) && !empty($AdminPassword)) {
        // Check for previous registration
        $query = "SELECT adminID FROM admin WHERE adminName='$NewAdminName'";
        $result = mysqli_query($dbc, $query);

        if (mysqli_num_rows($result) == 0) {
            // Insert new admin
            $query = "INSERT INTO admin (adminName, adminUserName, adminPwd) 
                      VALUES ('$NewAdminName', '$AdminUsername', '$AdminPassword')";
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
    } else {
        echo "Please fill out all required fields.";
    }
}

?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Add Administrator</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="manage-admin.php">Active Administrator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="add-admin.php">Add Administrator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">History</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <h4><strong>Fill out the form below to add a new administrator.</strong></h4>
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
                                <label for="NewAdminName">First Name:</label>
                                <input type="text" class="form-control" id="NewAdminName" name="NewAdminName" required>
                            </div>
                            <div class="form-group">
                                <label for="AdminUsername">Username:</label>
                                <input type="text" class="form-control" id="AdminUsername" name="AdminUsername" required>
                            </div>
                            <div class="form-group">
                                <label for="AdminPassword">Password:</label>
                                <input type="password" class="form-control" id="AdminPassword" name="AdminPassword" required>
                            </div>
                            <div class="text-right">
                                <button type="button" onclick="AddAdmin();" class="btn btn-primary btn-lg">Confirm</button>
                            </div>

                            <script>
                                function AddAdmin() {
                                    console.log("Function called"); // Check if function is being called
                                    // Validate form fields
                                    var NewAdminName = document.getElementById("NewAdminName").value.trim();
                                    var AdminUsername = document.getElementById("AdminUsername").value.trim();
                                    var AdminPassword = document.getElementById("AdminPassword").value.trim();

                                    console.log(NewAdminName, AdminUsername, AdminPassword); // Check form field values

                                    if (NewAdminName === "" || AdminUsername === "" || AdminPassword === "" ) {
                                        // If any of the required fields are empty, show an error message
                                        swal(
                                            "Error!",
                                            "Please fill out all required fields.",
                                            "error");
                                        return; // Stop further execution
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
