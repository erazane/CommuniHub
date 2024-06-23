<?php
session_start(); // Start the session at the top
include('include/header.php');
require_once('../Database/database.php');

// Get user ID from the session
$UserID = $_SESSION["UserID"];

// Query to fetch user information
$query = "SELECT * FROM user WHERE UserID = '$UserID'";
$result = @mysqli_query($dbc, $query);

// Check if the query executed successfully
if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $profileImage = $row["UserImg"];
    $UserFirstName = $row["UserFirstName"];
    $UserLastName = $row["UserLastName"];
    $UserUserName = $row["UserUserName"];
    $UserPwd = $row["UserPwd"];
    $UserAge = $row["UserAge"];
    $UserMartialStatus = $row["UserMartialStatus"];
    $UserOccupation = $row["UserOccupation"];
    $UserContactDetails = $row["UserContactDetails"];
    $UserEmail = $row["UserEmail"];
    $image = $row["image"];
} else {
    exit();
}

// Fetch statistics
$query_users = "SELECT COUNT(*) as user_count FROM user";
$query_activity = "SELECT COUNT(*) as activity_count FROM activities";
$query_donations = "SELECT COUNT(*) as donation_count FROM donation";
$query_complaints = "SELECT COUNT(*) as complaint_count FROM complaint";

$result_users = mysqli_query($dbc, $query_users);
$result_activity = mysqli_query($dbc, $query_activity);
$result_donations = mysqli_query($dbc, $query_donations);
$result_complaints = mysqli_query($dbc, $query_complaints);

$user_count = $result_users ? mysqli_fetch_assoc($result_users)['user_count'] : 0;
$activity_count = $result_activity ? mysqli_fetch_assoc($result_activity)['activity_count'] : 0;
$donation_count = $result_donations ? mysqli_fetch_assoc($result_donations)['donation_count'] : 0;
$complaint_count = $result_complaints ? mysqli_fetch_assoc($result_complaints)['complaint_count'] : 0;
?>

</div>
<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
    <div class="heading_container heading_center">
            <h2>User Dashboard</h2>
            <hr style="width: 350px; text-align: center">
        </div>
        <div class="row">
            <!-- User Profile Section -->
            <div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="profile_picture_container text-center mb-4" style="padding: 10%;">
                <img src="./images/profile-pictures/5927577.jpg" alt="Profile Picture" style="max-width: 200px; max-height: 200px;" class="img-fluid rounded-circle">
            </div>
            <form id="UpdateProfile" action="update_profile.php" enctype="multipart/form-data">
                <div class="card mb-4 p-3 shadow-sm rounded">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-left mb-2">
                                <h6 class="mb-0">First Name:</h6>
                                <p class="text-muted mb-0"><?php echo htmlspecialchars($UserFirstName); ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Last Name:</h6>
                                <p class="text-muted mb-0"><?php echo htmlspecialchars($UserLastName); ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Occupation:</h6>
                                <p class="text-muted mb-0"><?php echo htmlspecialchars($UserOccupation); ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Email:</h6>
                                <p class="text-muted mb-0"><?php echo htmlspecialchars($UserEmail); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-left mb-2">
                                <h6 class="mb-0">Username:</h6>
                                <p class="text-muted mb-0"><?php echo htmlspecialchars($UserUserName); ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Marital Status:</h6>
                                <p class="text-muted mb-0"><?php echo htmlspecialchars($UserMartialStatus); ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Age:</h6>
                                <p class="text-muted mb-0"><?php echo htmlspecialchars($UserAge); ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Contact Details:</h6>
                                <p class="text-muted mb-0"><?php echo htmlspecialchars($UserContactDetails); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


            <!-- Statistics Section -->
            <div class="col-md-6">
                <h3>Statistics</h3>
                <hr>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-4 text-center">
                                <i class="fa fa-user fa-3x"></i>
                            </div>
                            <div class="col-8">
                                <h4 class="mb-0">Current Users: <?php echo $user_count; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-4 text-center">
                                <i class="fa fa-calendar-check-o fa-3x"></i>
                            </div>
                            <div class="col-8">
                                <h4 class="mb-0">Current Activities: <?php echo $activity_count; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-4 text-center">
                                <i class="fa fa-handshake-o fa-3x"></i>
                            </div>
                            <div class="col-8">
                                <h4 class="mb-0">Current Donations: <?php echo $donation_count; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-4 text-center">
                                <i class="fa fa-exclamation-triangle fa-3x"></i>
                            </div>
                            <div class="col-8">
                                <h4 class="mb-0">Current Complaints: <?php echo $complaint_count; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center md-2">
                <button type="button" class="btn btn-primary " onclick="confirmEditProfile(<?php echo $UserID; ?>)">
                    Edit Profile
                </button>
            </div>
            </div>
        </div>
        <br>

       
    </div>
    <br>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Function to confirm edit profile
        function confirmEditProfile(UserID) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will be redirected to edit your profile.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to edit profile page with UserID
                    window.location.href = 'update_profile.php?UserID=' + UserID;
                }
            });
        }
    </script>

<?php include('include/footer.php'); ?>
