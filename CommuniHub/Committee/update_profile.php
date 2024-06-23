<?php
session_start();
include('include/header.php');

// Check if UserID is provided in GET or POST data
$UserID = isset($_GET['UserID']) ? intval($_GET['UserID']) : (isset($_POST['UserID']) ? intval($_POST['UserID']) : 0);

require_once('../Database/database.php');

// Fetch existing user data
$query = "SELECT * FROM user WHERE UserID = '$UserID'";
$result = mysqli_query($dbc, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    die('Invalid User ID or User not found.');
}

// Handle form submission to update user profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $UserFirstName = mysqli_real_escape_string($dbc, $_POST['UserFirstName']);
    $UserLastName = mysqli_real_escape_string($dbc, $_POST['UserLastName']);
    $UserUserName = mysqli_real_escape_string($dbc, $_POST['UserUserName']);
    $UserAge = intval($_POST['UserAge']);
    $UserMartialStatus = mysqli_real_escape_string($dbc, $_POST['UserMartialStatus']);
    $UserOccupation = mysqli_real_escape_string($dbc, $_POST['UserOccupation']);
    $UserContactDetails = mysqli_real_escape_string($dbc, $_POST['UserContactDetails']);
    $UserEmail = mysqli_real_escape_string($dbc, $_POST['UserEmail']);
    $profilePicture = $_FILES['profile_picture']['name'];
    
    if ($profilePicture) {
        $profilePictureTemp = $_FILES['profile_picture']['tmp_name'];
        $profilePictureDir = '../Committee/images/profile-pictures/';
        $profilePicturePath = $profilePictureDir . basename($profilePicture);
        move_uploaded_file($profilePictureTemp, $profilePicturePath);
        $profilePictureSQL = ", profile_picture = '$profilePicture'";
    } else {
        $profilePictureSQL = "";
    }

}
?>
</div>
<br>
<br>
<div class="container" style="max-width: 1500px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="heading_container heading_center">
                <h2>Update Profile: <?php echo htmlspecialchars($user['UserFirstName']) . " " . htmlspecialchars($user['UserLastName']); ?></h2>
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

                                <!-- Form for updating user details -->
                                <form id="UpdateProfile" action="process-profile-update.php?UserID=<?php echo $UserID; ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="UserFirstName">First Name:</label>
                                        <input type="text" class="form-control" id="UserFirstName" name="UserFirstName" value="<?php echo htmlspecialchars($user['UserFirstName']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="UserLastName">Last Name:</label>
                                        <input type="text" class="form-control" id="UserLastName" name="UserLastName" value="<?php echo htmlspecialchars($user['UserLastName']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="UserUserName">Username:</label>
                                        <input type="text" class="form-control" id="UserUserName" name="UserUserName" value="<?php echo htmlspecialchars($user['UserUserName']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="UserOccupation">Occupation:</label>
                                        <input type="text" class="form-control" id="UserOccupation" name="UserOccupation" value="<?php echo htmlspecialchars($user['UserOccupation']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="UserMartialStatus">Marital Status:</label>
                                        <select class="form-control" id="UserMartialStatus" name="UserMartialStatus">
                                            <option value="" disabled>Select Status</option>
                                            <option value="Married" <?php if ($user['UserMartialStatus'] == 'Married') echo 'selected'; ?>>Married</option>
                                            <option value="Unmarried" <?php if ($user['UserMartialStatus'] == 'Unmarried') echo 'selected'; ?>>Unmarried</option>
                                            <option value="Divorced" <?php if ($user['UserMartialStatus'] == 'Divorced') echo 'selected'; ?>>Divorced</option>
                                            <option value="Widowed" <?php if ($user['UserMartialStatus'] == 'Widowed') echo 'selected'; ?>>Widowed</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="UserAge">Age:</label>
                                        <input type="text" class="form-control" id="UserAge" name="UserAge" value="<?php echo htmlspecialchars($user['UserAge']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="UserContactDetails">Contact Details:</label>
                                        <input type="text" class="form-control" id="UserContactDetails" name="UserContactDetails" value="<?php echo htmlspecialchars($user['UserContactDetails']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="UserEmail">Email:</label>
                                        <input type="email" class="form-control" id="UserEmail" name="UserEmail" value="<?php echo htmlspecialchars($user['UserEmail']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="profile_picture">Profile Picture:</label>
                                        <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" accept="image/*">
                                    </div>
                                    <div class="text-right">
                                        <a href="index.php" class="btn btn-secondary btn-lg">Back</a>
                                        <button type="button" onclick="UpdateProfile();" class="btn btn-primary btn-lg">Confirm</button>
                                    </div>
                                </form>
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
    function UpdateProfile() {
        Swal.fire({
            title: "Would you like to update your profile?",
            text: "Click confirm if you wish to proceed",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
        }).then((willProceed) => {
            if (willProceed.isConfirmed) {
                document.getElementById("UpdateProfile").submit();
            } else {
                console.log("User cancelled.");
            }
        });
    }
</script>

<?php include('include/footer.php'); ?>
