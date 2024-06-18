<?php
session_start();
include('include/header.php');
?>

<?php
require_once('../Database/database.php');


// Get user ID
$UserID = $_SESSION["UserID"];
// Fetch user data from session or database
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
 <!-- Slider Section -->
 <section class="slider_section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="detail-box">
              <h1>One Step Solution To<br>Suburban Management</h1>
              <h3>A better community will create better lives.</h3>
            </div>
          </div>
          <div class="col-md-6">
            <div class="img-box">
              <img src="images/communityCircle.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
    <!-- Dashboard Section -->
    <section class="service_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Dashboard</h2>
                <hr style="width: 350px; text-align:center">
            </div>
            <div class="row">
                <!-- User Profile -->
                <div class="col-md-12 mb-4">
                    <div class="card p-3">
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <img src="images/profile-picture/<?php echo $UserProfileImage ?: 'default_profile_picture.png'; ?>" alt="Profile Picture" style="max-width: 250px; max-height:250px;" class="img-fluid rounded-circle">
                            </div>
                            <div class="col-md-8">
                                <h5>First Name: <?php echo $UserFirstName; ?></h5>
                                <h5>Last Name: <?php echo $UserLastName; ?></h5>
                                <h5>Occupation: <?php echo $UserOccupation; ?></h5>
                                <h5>Email: <?php echo $UserEmail; ?></h5>
                                <h5>Username: <?php echo $UserUserName; ?></h5>
                                <h5>Marital Status: <?php echo $UserMartialStatus; ?></h5>
                                <h5>Age: <?php echo $UserAge; ?></h5>
                                <h5>Contact Details: <?php echo $UserContactDetails; ?></h5>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                            <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#editPasswordModal">Change Password</button>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Statistics -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4 text-center">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-8">
                                    <h3 class="mb-0">Current Users: <?php echo $user_count; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4 text-center">
                                    <i class="fa fa-calendar-check-o fa-5x"></i>
                                </div>
                                <div class="col-8">
                                    <h3 class="mb-0">Current Activity: <?php echo $activity_count; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4 text-center">
                                    <i class="fa fa-handshake-o fa-5x"></i>
                                </div>
                                <div class="col-8">
                                    <h3 class="mb-0">Current Donations: <?php echo $donation_count; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4 text-center">
                                    <i class="fa fa-exclamation-triangle fa-5x"></i>
                                </div>
                                <div class="col-8">
                                    <h3 class="mb-0">Current Complaints: <?php echo $complaint_count; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?php echo $UserID; ?>">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $UserFirstName; ?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $UserLastName; ?>">
                        </div>
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo $UserOccupation; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $UserEmail; ?>">
                        </div>
                        <div class="form-group">
                            <label for="marital_status">Marital Status</label>
                            <input type="text" class="form-control" id="marital_status" name="marital_status" value="<?php echo $UserMartialStatus; ?>">
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="<?php echo $UserAge; ?>">
                        </div>
                        <div class="form-group">
                            <label for="contact_details">Contact Details</label>
                            <input type="text" class="form-control" id="contact_details" name="contact_details" value="<?php echo $UserContactDetails; ?>">
                        </div>
                        <div class="form-group">
                            <label for="profile_image">Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <?php include('include/footer.php'); ?>


        