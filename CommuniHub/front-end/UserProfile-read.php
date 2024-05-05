<?php 
session_start();
require_once('include/header.php'); 
?>

    <!-- end header section -->
  </div>



<!-- User Profile Form -->

<?php
    
    require_once ('../Database/database.php');
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
?>

<section class="service_section layout_padding wider_section">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="card mb-3">
          <div class="card-body">
            <div class="heading_container heading_center">
              <h2 class="text-center mb-4">User Profile</h2>
            </div>

            <!-- Display uploaded profile picture -->
            <div class="profile_picture_container text-center mb-4">
            <img src="images/profile-picture/<?php echo $row['image'] ? $row['image'] : "default_profile_picture.png"; ?>" alt="Profile Picture" style="max-width: 200px; max-height:200px" class="img-fluid rounded-circle">
            </div>

            <div class="container"> 
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <p><strong>First Name:</strong> <?php echo isset($UserFirstName) ? $UserFirstName : ''; ?></p>
                  </div>
                  <div class="form-group">
                    <p><strong>Username:</strong> <?php echo isset($UserUserName) ? $UserUserName : ''; ?></p>
                  </div>
                  <div class="form-group">
                    <p><strong>Martial Status:</strong> <?php echo isset($UserMartialStatus) ? $UserMartialStatus : ''; ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <p><strong>Last Name:</strong> <?php echo isset($UserLastName) ? $UserLastName : ''; ?></p>
                  </div>
                  <div class="form-group">
                    <p><strong>Occupation:</strong> <?php echo isset($UserOccupation) ? $UserOccupation : ''; ?></p>
                  </div>
                  <div class="form-group">
                    <p><strong>Contact Details:</strong> <?php echo isset($UserContactDetails) ? $UserContactDetails : ''; ?></p>
                  </div>
                  <div class="form-group">
                    <p><strong>Email:</strong> <?php echo isset($UserEmail) ? $UserEmail : ''; ?></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="text-center">
             <!-- Button trigger modal -->
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">
                Edit Profile
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
                                <form action="update_profile.php" method="POST" enctype="multipart/form-data"> <!-- Action to handle profile updates -->
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
                                    <label for="first_name">Age:</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $UserFirstName ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="first_name">Contact Details:</label>
                                     <input type="text" class="form-control" id="contact_details" name="contact_details" value="<?php if (isset($UserContactDetails)) echo $UserContactDetails; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="first_name">Email:</label>
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
                  $('form').submit();
                }
              </script>


              <!-- end modal -->
              <!-- change password modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changePasswordModal">
                Change Password
              </button>
              <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="container" style="border: solid black 1px;">
                        <div class="row">
                        <div class="col-md-6"> <!-- Adjusted column width for form -->
                              <div class="user_profile_container">
                                <form action="update_password.php" method="POST" enctype="multipart/form-data"> 
                                  <div class="form-group">
                                      <label for="current-password">Current Password:</label>
                                      <input type="text" class="form-control" id="current-password" name="current-password" value="<?php echo $UserFirstName ?>" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="Updated-password">New Password:</label>
                                    <input type="text" class="form-control" id="Updated-password" name="Updated-password" value="<?php echo $UserFirstName ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="Confirm-password">Confirm Password:</label>
                                    <input type="text" class="form-control" id="Confirm-password" name="Confirm-password" value="<?php echo $UserFirstName ?>" required>
                                  </div>
                                </form>
                              </div>
                        </div>
                        </div>
                      </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>

                      <script>
                        // Function to submit the form data
                        function submitForm() {
                          // Submit the form
                          $('form').submit();
                        }
                      </script>

                    </div>
                  </div>
                </div>
            </div>


          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="heading_container heading_center">
              <h2 class="text-center mb-4">Activities Joined</h2>
            </div>
            <p class="text-center">Display number of activities joined</p>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div class="heading_container heading_center">
              <h2 class="text-center mb-4">Donations Made</h2>
            </div>
            <p class="text-center">Display number of donations made</p>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div class="heading_container heading_center">  
              <h2 class="text-center mb-4">Complaints</h2>
            </div>
            <p class="text-center">Display number of complaints</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    
  <!-- end service section -->

  <?php include('include/footer.php'); ?>
