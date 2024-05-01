<?php
session_start();
include('include/header.php');

?>
</div>

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
     $UserEmail= $row['UserEmail'];
 } else {
     // Redirect or show error message if no data found
     // header('Location: UserProfile.php');
     exit();
 }
    ?>

<section class="user-profile-section layout-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="detail-box">
        <div class="card">
          <div class="card-body">
            <div class="heading-container heading-center">
              <h2>User Profile</h2>
            </div>

            <!-- Nested Child Card -->
            <div class="card">
              <div class="card-body">
                <!-- Display uploaded profile picture -->
                <div class="profile-picture-container text-center">
                  <img src="images/profile-pictures/<?php echo $row['image'] ? $row['image'] : "default_profile_picture.png"; ?>" alt="Profile Picture" class="profile-picture">
                </div>
              </div>
            </div>

            <div class="container"> 
              <div class="row" style="padding: 2%;">
                <div class="col-md-6">
                  <div class="form-group">
                    <p class="card-text"><strong>First Name:</strong> <?php echo isset($UserFirstName) ? $UserFirstName : ''; ?></p>
                  </div>
                  <div class="form-group">
                    <p class="card-text"><strong>Last Name:</strong> <?php echo isset($UserLastName) ? $UserLastName : ''; ?></p>
                  </div>
                  <div class="form-group">
                    <p class="card-text"><strong>Age:</strong> <?php echo isset($UserAge) ? $UserAge : ''; ?></p>
                  </div>
                  <div class="form-group">
                    <p class="card-text"><strong>Martial Status:</strong> <?php echo isset($UserMartialStatus) ? $UserMartialStatus : ''; ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <p class="card-text"><strong>Username:</strong> <?php echo isset($UserUserName) ? $UserUserName : ''; ?></p>
                  </div>
                  <div class="form-group">
                    <p class="card-text"><strong>Occupation:</strong> <?php echo isset($UserOccupation) ? $UserOccupation : ''; ?></p>
                  </div>
                  <div class="form-group">
                    <p class="card-text"><strong>Contact Details:</strong> <?php echo isset($UserContactDetails) ? $UserContactDetails : ''; ?></p>
                  </div>
                  <div class="form-group">
                    <p class="card-text"><strong> Email:</strong> <?php echo isset($UserEmail) ? $UserEmail : ''; ?></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="text-center">
              <a href="profile-update.php" class="btn btn-primary">Update</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('include/footer.php'); ?>
