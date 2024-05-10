<?php 
session_start();
require_once('include/header.php'); 
?>
<!-- end header section -->
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




<!-- User Profile Form -->

<?php
require_once ('../Database/database.php');

    if (isset($_SESSION['password_status']) && isset($_SESSION['password_status_code'])) {
      // Display success message using SweetAlert
      echo '<script>swal("Success!", "' . htmlspecialchars($_SESSION['password_status']) . '", "' . htmlspecialchars($_SESSION['password_status_code']) . '");</script>';
      // Unset the session variables
      unset($_SESSION['password_status']);
      unset($_SESSION['password_status_code']);
    // } else {
    //   // Display error message for password not set correctly
    //   echo '<script>swal("Error!", "Password not set correctly.", "error");</script>';
    }

    // Check if profile status session variables are set
    if (isset($_SESSION['profile_status']) && isset($_SESSION['profile_status_code'])) {
      // Display success message using SweetAlert
      echo '<script>swal("Profile Update!", "' . htmlspecialchars($_SESSION['profile_status']) . '", "' . htmlspecialchars($_SESSION['profile_status_code']) . '");</script>';
      // Unset the session variables
      unset($_SESSION['profile_status']);
      unset($_SESSION['profile_status_code']);
    // } else {
    //   // Display error message for data cannot be inserted
    //   echo '<script>swal("Error!", "Data cannot be inserted.", "error");</script>';
    }
  
    
    // Get user ID
    $UserID = $_SESSION["UserID"];

    // Query to fetch user information
    $query = "SELECT * FROM user WHERE UserID = '$UserID'";
    $result = @mysqli_query($dbc, $query);

    // Check if the query executed successfully
    if ($result && mysqli_num_rows($result) == 1) {
        // Fetch user information
        $row = mysqli_fetch_assoc($result);
        $profileImage = $row["UserImg"];
        $UserFirstName = $row['UserFirstName'];
        $UserLastName = $row['UserLastName'];
        $UserUserName = $row['UserUserName'];
        $UserPwd = $row['UserPwd'];
        $UserAge = $row['UserAge'];
        $UserMartialStatus = $row['UserMartialStatus'];
        $UserOccupation = $row['UserOccupation'];
        $UserContactDetails = $row['UserContactDetails'];
        $UserEmail = $row['UserEmail'];
        $image = $row['image'];

    } else {
        // Redirect or show error message if no data found
        // header('Location: UserProfile.php');
        exit();
    }

    $query = "SELECT COUNT(*) AS activity_count FROM activitiesJoined WHERE UserID = $UserID";
    $result = mysqli_query($dbc, $query);

    if($result){
      $row = mysqli_fetch_assoc($result);
       $activityCount=$row['activity_count'];
    }else{
      $activityCount = 0;  //setting default is zero
    }

    $query = "SELECT COUNT(*) AS history_count
    FROM activities a
    JOIN activitiesJoined aj ON a.ActivityID = aj.ActivityID
    WHERE aj.UserID = $UserID
    AND a.Status = 'Completed'";

    $result = mysqli_query($dbc, $query);

    if($result){
      $row = mysqli_fetch_assoc($result);
       $history_count=$row['history_count'];
    }else{
      $history_count = 0;  //setting default is zero
    }

?>

<section class="service_section layout_padding wider_section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-body">
            <div class="heading_container heading_center">
              <h2 class="text-center mb-4">User Profile</h2>
              
            </div>

            <!-- Display uploaded profile picture -->
            <div class="profile_picture_container text-center mb-4" style="padding: 10%;">
            <img src="images/profile-picture/<?php echo $row['image'] ? $row['image'] : "default_profile_picture.png"; ?>" alt="Profile Picture" style="max-width: 250px; max-height:250px;" class="img-fluid rounded-circle">
            </div>

            <div class="container" style="padding: 2%;"> 
              <div class="row " style="padding: 2%; border:1px solid black">
                <div class="col-md-6" style="padding: 4%;">
                  <div class="form-group" style="padding: 1px;">
                    <p><strong>First Name:</strong> <?php echo isset($UserFirstName) ? $UserFirstName : ''; ?></p>
                  </div>
                  <div class="form-group" style="padding: 1px;">
                    <p><strong>Username:</strong> <?php echo isset($UserUserName) ? $UserUserName : ''; ?></p>
                  </div>
                  <div class="form-group" style="padding: 1px;">
                    <p><strong>Martial Status:</strong> <?php echo isset($UserMartialStatus) ? $UserMartialStatus : ''; ?></p>
                  </div>
                  <div class="form-group" style="padding: 1px;">
                    <p><strong>Age:</strong> <?php echo isset($UserAge) ? $UserAge : ''; ?></p>
                  </div>
                </div>
                <div class="col-md-6" style="padding: 2%;">
                  <div class="form-group" style="padding: 1px;">
                    <p><strong>Last Name:</strong> <?php echo isset($UserLastName) ? $UserLastName : ''; ?></p>
                  </div>
                  <div class="form-group" style="padding: 1px;">
                    <p><strong>Occupation:</strong> <?php echo isset($UserOccupation) ? $UserOccupation : ''; ?></p>
                  </div>
                  <div class="form-group" style="padding: 1px;">
                    <p><strong>Contact Details:</strong> <?php echo isset($UserContactDetails) ? $UserContactDetails : ''; ?></p>
                  </div>
                  <div class="form-group" style="padding: 1px;">
                    <p><strong>Email:</strong> <?php echo isset($UserEmail) ? $UserEmail : ''; ?></p>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="text-center md-2">
             <!-- Button trigger modal -->
             <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#editProfileModal">
                Edit Profile
              </button>
               <!-- Button trigger modal -->
               <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#editPasswordModal">
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
                                  <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $UserFirstName ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="first_name">Last Name:</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php if (isset($UserLastName)) echo $UserLastName; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="first_name">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php if (isset($UserUserName)) echo $UserUserName; ?>"  required>
                                  </div>
                                  <div class="form-group">
                                    <label for="first_name">Occupation:</label>
                                    <input type="text" class="form-control" id="occupation" name="occupation" value="<?php if (isset($UserOccupation)) echo $UserOccupation; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="first_name">Martial Status:</label>
                                    <select class="form-control" id="marital_status" name="marital_status">
                                      <option value="" disabled selected>Select Status</option>
                                                <option value="Married" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Married') echo 'selected="selected"'; ?>>Married</option>
                                                <option value="Unmmaried" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Unmmaried') echo 'selected="selected"'; ?>>Unmmaried</option>
                                                <option value="Divorced" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Divorced') echo 'selected="selected"'; ?>>Divorced</option>
                                                <option value="Widowed" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Widowed') echo 'selected="selected"'; ?>>Widowed</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="Age">Age:</label>
                                    <input type="text" class="form-control" id="age" name="age" value="<?php echo $UserAge?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="contact_details">Contact Details:</label>
                                     <input type="text" class="form-control" id="contact_details" name="contact_details" value="<?php if (isset($UserContactDetails)) echo $UserContactDetails; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="UserEmail">Email:</label>
                                    <input type="text" class="form-control" id="UserEmail" name="UserEmail" value="<?php if (isset($UserEmail)) echo $UserEmail; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="profile_picture">Profile Picture: </label>
                                    <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" accept="image/*"></label>
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

           <!-- start password modal -->
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
                                                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" value="<?php if(isset($currentPassword)) ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="newPassword">New Password:</label>
                                                            <input type="password" class="form-control" id="newPassword" name="newPassword" value="<?php if (isset($newPassword))  ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="confirmPassword">Confirm Password:</label>
                                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="<?php if (isset($confirmPassword)) ?>" required>
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
              <h2 class="text-center mb-4">Activity History</h2>
            </div>
            <div class="card" style="width: 32rem;">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <a href="activities-joined.php">
                  <i class="fa fa-bookmark" aria-hidden="true"></i>
                    Upcoming Activities
                  </a>
                  <div class="card" style="float: right; padding: 10px;">
                    
                    <span><?php echo $activityCount; ?></span>
                  </div>
                </li>

                <li class="list-group-item">
                  <a href="activity-history.php">
                  <i class="fa fa-history" aria-hidden="true"></i>
                    History
                  </a>
                  <div class="card" style="float: right; padding: 10px;">
                    
                    <span><?php echo $history_count; ?></span>
                  </div>
                </li>
              </ul>
            </div>

          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div class="heading_container heading_center">
              <h2 class="text-center mb-4">Donations Made</h2>
            </div>
            <div class="card" style="width: 32rem;">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <a href="activities-joined.php">
                  <i class="fa fa-history" aria-hidden="true"></i>
                    History
                  </a>
                  <div class="card" style="float: right; padding: 10px;">
                    <span>6</span>
                    <!-- <span><?php echo $activityCount; ?></span> -->
                  </div>
                </li>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div class="heading_container heading_center">  
              <h2 class="text-center mb-4">Complaints</h2>
            </div>
            <div class="card" style="width: 32rem;">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <a href="activities-joined.php">
                  <i class="fa fa-clock-o" aria-hidden="true"></i>
                    Pending Complaints
                  </a>
                  <div class="card" style="float: right; padding: 10px;">
                    <span>6</span>
                    <!-- <span><?php echo $activityCount; ?></span> -->
                  </div>
                </li>

                <li class="list-group-item">
                  <a href="activities-joined.php">
                  <i class="fa fa-history" aria-hidden="true"></i>
                    History
                  </a>
                  <div class="card" style="float: right; padding: 10px;">
                    <span>6</span>
                    <!-- <span><?php echo $activityCount; ?></span> -->
                  </div>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    
  <!-- end service section -->

  <?php include('include/footer.php'); ?>
