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
    } else {
        // Redirect or show error message if no data found
        // header('Location: UserProfile.php');
        exit();
    }
?>


<section class="user_profile_section layout_padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="detail-box">
        <div class="card">
          <div class="card-body">
            <div class="heading_container heading_center">
              <h2>User Profile</h2>
            </div>

            <!-- Nested Child Card -->
            <div class="card">
              <div class="card-body">
                <!-- Display uploaded profile picture -->
                <div class="profile_picture_container text-center">
                  <img src="profileImages/default_profile_picture.png" class="img-fluid rounded-circle" alt="Profile Picture" style="max-width: 350px;">
                </div>
              </div>
            </div>

            <div class="container"> 
             <div class="row" style="padding: 2%;">
             <div class="col-md-6">
            <br>
            <div class="form-group" style="margin-right: 30px;">
                <p class="card-text"><strong>First Name:</strong> <?php echo isset($UserFirstName) ? $UserFirstName : ''; ?></p>
            </div>
            <div class="form-group" style="margin-right: 30px;">
                <p class="card-text"><strong>Last Name:</strong> <?php echo isset($UserLastName) ? $UserLastName : ''; ?></p>
            </div>
            <div class="form-group" style="margin-right: 30px;">
                <p class="card-text"><strong>Age:</strong> <?php echo isset($UserAge) ? $UserAge : ''; ?></p>
            </div>
            <div class="form-group" style="margin-right: 30px;">
                <p class="card-text"><strong>Martial Status:</strong> <?php echo isset($UserMartialStatus) ? $UserMartialStatus : ''; ?></p>
            </div>
             </div>
             <div class="col-md-6">
            <br>
            <div class="form-group" style="margin-left: 30px;">
                <p class="card-text"><strong>Username:</strong> <?php echo isset($UserUserName) ? $UserUserName : ''; ?></p>
            </div>
            <div class="form-group" style="margin-left: 30px;">
                <p class="card-text"><strong>Occupation:</strong> <?php echo isset($UserOccupation) ? $UserOccupation : ''; ?></p>
            </div>
            <div class="form-group" style="margin-left: 30px;">
                <p class="card-text"><strong>Contact Details:</strong> <?php echo isset($UserContactDetails) ? $UserContactDetails : ''; ?></p>
            </div>
            

        </div>
    </div>
</div>

<br>

            <div class="text-center">
              <a href="UserProfile.php" class="btn btn-primary">Update</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>






<!-- end user profile form -->
    
  <!-- end service section -->

  <?php include('include/footer.php'); ?>
