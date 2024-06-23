<?php

use LDAP\Result;

session_start();
require_once "include/header.php";
?>
<!-- end header section -->
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
require_once "../Database/database.php";

if (
    isset($_SESSION["password_status"]) &&
    isset($_SESSION["password_status_code"])
) {
    echo '<script>swal("Success!", "' .
        htmlspecialchars($_SESSION["password_status"]) .
        '", "' .
        htmlspecialchars($_SESSION["password_status_code"]) .
        '");</script>';
    unset($_SESSION["password_status"]);
    unset($_SESSION["password_status_code"]);
}

// Check if profile status session variables are set
if (
    isset($_SESSION["profile_status"]) &&
    isset($_SESSION["profile_status_code"])
) {
    echo '<script>swal("Profile Update!", "' .
        htmlspecialchars($_SESSION["profile_status"]) .
        '", "' .
        htmlspecialchars($_SESSION["profile_status_code"]) .
        '");</script>';
    unset($_SESSION["profile_status"]);
    unset($_SESSION["profile_status_code"]);
    echo '<script>swal("Error!", "Data cannot be inserted.", "error");</script>';
}

// Get user ID
$UserID = $_SESSION["UserID"];

// query for activity joined
$query = "SELECT COUNT(*) AS activity_count FROM activitiesJoined WHERE UserID = $UserID";
$result = mysqli_query($dbc, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $activityCount = $row["activity_count"];
} else {
    $activityCount = 0;
}

// query for activity joined that has been completed
// $query = "SELECT COUNT(*) AS history_count FROM activities a JOIN activitiesJoined aj ON a.ActivityID = aj.ActivityID  WHERE aj.UserID = $UserID AND a.Status = 'Completed'";
// $result = mysqli_query($dbc, $query);

// if ($result) {
//     $row = mysqli_fetch_assoc($result);
//     $history_count = $row["history_count"];
// } else {
//     $history_count = 0;
// }

// query for donations joined
// $query = "SELECT COUNT(*) AS DonationCount FROM donations d JOIN donationJoined dj ON d.donationID = dj.donationID WHERE dj.UserID = $UserID";
// $result = mysqli_query($dbc, $query);

// if ($result) {
//     $row = mysqli_fetch_assoc($result);
//     $DonationCount = $row["DonationCount"];
// } else {
//     $DonationCount = 0;
// }


// query for complaints pending
$query = "    SELECT COUNT(*) AS pendingComplaintCount FROM complaint c LEFT JOIN respondComplaint r ON c.ComplaintID = r.ComplaintID WHERE r.ComplaintID IS NULL AND c.UserID = '$UserID' ";
$result = mysqli_query($dbc, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $pendingComplaintCount = $row["pendingComplaintCount"];
} else {
    $pendingComplaintCount = 0;
}

// query for resolved complaints
// $query = "    SELECT COUNT(*) AS HistoryComplaintCount FROM complaint c JOIN respondComplaint r ON c.ComplaintID = r.ComplaintID WHERE r.status = 'Completed' AND c.UserID = '$UserID'";
// $result = mysqli_query($dbc, $query);

// if ($result) {
//     $row = mysqli_fetch_assoc($result);
//     $HistoryComplaintCount = $row["HistoryComplaintCount"];
// } else {
//     $HistoryComplaintCount = 0;
// }

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
?>

<section class="service_section layout_padding wider_section">
<div class="container" style="max-width: 1500px;">
    <div class="row">
      <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-body">
            <div class="heading_container heading_center">
              <h3 class="text-center mb-4">User Profile</h3>
                <hr style="width: 350px; text-align: center">
              
            </div>

            <!-- Display uploaded profile picture -->
            <div class="profile_picture_container text-center mb-4" style="padding: 10%;">
            <img src="images/profile-picture/<?php echo $row["image"]
                ? $row["image"]
                : "default_profile_picture.png"; ?>" alt="Profile Picture" style="max-width: 250px; max-height:250px;" class="img-fluid rounded-circle">
            </div>

            <div class="card p-3">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>First Name: <?php echo isset(
                                            $UserFirstName
                                        )
                                            ? $UserFirstName
                                            : ""; ?></h5>
                                    </div>
                                    <div class="form-group">
                                        <h5>Last Name:<?php echo isset(
                                            $UserLastName
                                        )
                                            ? $UserLastName
                                            : ""; ?></h5>
                                    </div>
                                    <div class="form-group">
                                        <h5>Occupation: <?php echo isset(
                                            $UserOccupation
                                        )
                                            ? $UserOccupation
                                            : ""; ?></h5>
                                    </div>
                                    <div class="form-group">
                                        <h5>Email: <?php echo isset(
                                            $UserEmail
                                        )
                                            ? $UserEmail
                                            : ""; ?></h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Username:<?php echo isset(
                                            $UserUserName
                                        )
                                            ? $UserUserName
                                            : ""; ?></h5>
                                    </div>
                                    <div class="form-group">
                                        <h5>Martial Status: <?php echo isset(
                                            $UserMartialStatus
                                        )
                                            ? $UserMartialStatus
                                            : ""; ?></strong></h5>
                                    </div>
                                    <div class="form-group">
                                        <h5>Age: <?php echo isset(
                                            $UserAge
                                        )
                                            ? $UserAge
                                            : ""; ?></h5>
                                    </div>
                                    <div class="form-group">
                                        <h5>Contact Details: <?php echo isset(
                                            $UserContactDetails
                                        )
                                            ? $UserContactDetails
                                            : ""; ?></h5>
                                    </div>
                                </div>
                            </div>
                       </div>
                     <br>
                  <div class="text-center md-2">
                   <!-- Button trigger modal -->
                   <br>
                   <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#editProfileModal">
                      Edit Profile
                    </button>
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#editPasswordModal">
                          Change Password
                      </button>
                    <!-- Modal -->
                    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> <!-- Adjusted modal-dialog class -->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <section class="user_profile_section layout_padding">
                              <div class="container">
                                <div class="row justify-content-center">
                                  <div class="col-md-10"> <!-- Adjusted column width for form -->
                                    <div class="user_profile_container">
                                      <form action="update_profile.php" method="POST" enctype="multipart/form-data"> 
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
                                                      
                    
                                        <!-- Hidden input field to send user ID for updating -->
                                        <input type="hidden" name="user_id" value="<?php echo $UserID; ?>">
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="submitForm()">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <script>
                      // Function to submit the form data
                      function submitForm() {
                        // Submit the form
                        $('#editProfileModal form').submit();
                      }
                    </script>
                  </div>
                  <!-- end modal -->
                                
                  <!-- !-- start password modal -->
                  <div class="text-center">
                      
                      <!-- Modal -->
                      <div class="modal fade" id="editPasswordModal" tabindex="-1" role="dialog" aria-labelledby="editPasswordModalTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> <!-- Adjusted modal-dialog class -->
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="editPasswordModalTitle">Change Password</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <section class="user_profile_section layout_padding">
                                          <div class="container">
                                              <div class="row justify-content-center">
                                                  <div class="col-md-10"> <!-- Adjusted column width for form -->
                                                      <div class="user_profile_container">
                                                          <form action="update-password.php" method="POST" enctype="multipart/form-data"> 
                                                              <div class="form-group">
                                                                  <label for="currentPassword">Current Password:</label>
                                                                  <input type="password" class="form-control" id="currentPassword" name="currentPassword" value="<?php if (
                                                                      isset(
                                                                          $currentPassword
                                                                      )
                                                                  ); ?>" required>
                                                              </div>
                                                              <div class="form-group">
                                                                  <label for="newPassword">New Password:</label>
                                                                  <input type="password" class="form-control" id="newPassword" name="newPassword" value="<?php if (
                                                                      isset(
                                                                          $newPassword
                                                                      )
                                                                  ); ?>" required>
                                                              </div>
                                                              <div class="form-group">
                                                                  <label for="confirmPassword">Confirm Password:</label>
                                                                  <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="<?php if (
                                                                      isset(
                                                                          $confirmPassword
                                                                      )
                                                                  ); ?>" required>
                                                              </div>
                                                              <!-- Hidden input field to send user ID for updating -->
                                                              <input type="hidden" name="user_id" value="<?php echo $UserID; ?>">
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </section>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary" onclick="submitPasswordForm()">Save changes</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  </div>
                      
                  <script>
                      function submitPasswordForm() {
                          // $('#editProfileModal form').submit();
                          $('#editPasswordModal form').submit();
                      }
                  </script>

            <!-- end password modal  -->
           
    
          </div>
        </div>
      
      <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-body">
            <div class="heading_container heading_center">
              <h4 class="text-center mb-4">Activity History</h4>
            </div>
            <div class="card">
              <div class="col-md-12">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <h5><a href="activities-joined.php" >
                  <i class="fa fa-bookmark" aria-hidden="true"></i>
                    Upcoming Activities
                  </a>
                  <div class="card" style="float: right; padding: 10px;">
                    
                    <span><?php echo $activityCount; ?></span>
                  </div>
                    </h5>
                </li>

                <li class="list-group-item">
                  <h5>
                  <a href="activity-history.php">
                  <i class="fa fa-history" aria-hidden="true"></i>
                    History
                  </a>
                  <!-- <div class="card" style="float: right; padding: 10px;">
                    
                    <span><?php echo $history_count; ?></span>
                  </div> -->
                </li>
                    </h5>
              </ul>
            </div>
            </div>

          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div class="heading_container heading_center">
              <h4 class="text-center mb-4">Donations Made</h4>
            </div>
            <div class="card">
              <div class="col-md-12">
              <ul class="list-group list-group-flush">
                <h5>
                <li class="list-group-item">
                  <a href="donation-joined.php">
                  <i class="fa fa-history" aria-hidden="true"></i>
                    History
                  </a>
                  <!-- <div class="card" style="float: right; padding: 10px;">
                    
                    <span><?php echo $DonationCount; ?></span>
                  </div> -->
                    </h5>
                </li>
              </ul>
            </div>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div class="heading_container heading_center">  
              <h4 class="text-center mb-4">Complaints</h4>
            </div>
            <div class="card">
              <div class="col-md-12">
              <ul class="list-group list-group-flush">
                <h5>
                <li class="list-group-item">
                  <a href="AddComplaint.php">
                  <i class="fa fa-flag" aria-hidden="true"></i>
                    Make Complaint
                  </a>
                  <!-- <div class="card" style="float: right; padding: 10px;">
                    <span>6</span>
                    <span><?php echo $activityCount; ?></span>
                  </div> -->
                    </h5>
                </li>

                <li class="list-group-item">
                  <h5>
                  <a href="pending-complaints.php">
                  <i class="fa fa-clock-o" aria-hidden="true"></i>
                    Pending Complaints
                  </a>
                  <div class="card" style="float: right; padding: 10px;">
                    <span><?php echo $pendingComplaintCount; ?></span>
                  </div>
                    </h5>
                </li>

                <li class="list-group-item">
                  <h5>
                  <a href="resolved-complaints.php">
                  <i class="fa fa-history" aria-hidden="true"></i>
                    History
                  </a>
                  <!-- <div class="card" style="float: right; padding: 10px;">
                    <span><?php echo $HistoryComplaintCount; ?></span>
                  </div> -->
                    </h5>
                </li>

              </ul>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    
  <!-- end service section -->

  <?php include "include/footer.php"; ?>
