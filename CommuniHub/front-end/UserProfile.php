<?php include('include/header.php'); ?>

    <!-- end header section -->
  </div>

<!-- User Profile Form -->
<?php
session_start();
require_once('../Database/database.php');

if (isset($_POST['Submit'])) {
    // Get UserID from session
    $UserID = $_SESSION['UserID'];

    // Escape user inputs to prevent SQL injection
    $UserFirstName = mysqli_real_escape_string($dbc, $_POST['first_name']);
    $UserLastName = mysqli_real_escape_string($dbc, $_POST['last_name']);
    $UserUserName = mysqli_real_escape_string($dbc, $_POST['username']);
    $UserPwd = mysqli_real_escape_string($dbc, $_POST['password']);
    $UserAge = mysqli_real_escape_string($dbc, $_POST['age']);
    $UserMartialStatus = isset($_POST['marital_status']) ? mysqli_real_escape_string($dbc, $_POST['marital_status']) : '';
    $UserOccupation = mysqli_real_escape_string($dbc, $_POST['occupation']);
    $UserContactDetails = mysqli_real_escape_string($dbc, $_POST['contact_details']);

    // Update user information in the database
    $query = "UPDATE user SET 
              UserFirstName='$UserFirstName', 
              UserLastName='$UserLastName', 
              UserUserName='$UserUserName',
              UserPwd='$UserPwd',
              UserAge='$UserAge',
              UserMartialStatus='$UserMartialStatus',
              UserOccupation='$UserOccupation',
              UserContactDetails='$UserContactDetails' 
              WHERE UserID='$UserID'";

    $result = mysqli_query($dbc, $query);

    // Handle file upload
    if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $img_name = $_FILES['profile_picture']['name'];
        $tmp_name = $_FILES['profile_picture']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $new_img_name = uniqid($UserUserName, true) . '.' . $img_ex;
        $img_upload_path = 'images/' . $new_img_name;

        if (move_uploaded_file($tmp_name, $img_upload_path)) {
            // Update user's profile picture in the database
            $sql = "UPDATE user SET UserImg='$new_img_name' WHERE UserID=$UserID";
            mysqli_query($dbc, $sql);
        }
    }

    // Redirect after form submission
    header('Location: http://localhost/php-projects/CommuniHub/commitee/UserProfile-read.php');
    exit();
}

// Fetch user's existing information if form is not submitted
$UserID = $_SESSION['UserID'];
$query = "SELECT * FROM user WHERE UserID='$UserID'";
$result = mysqli_query($dbc, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $UserFirstName = $row['UserFirstName'];
    $UserLastName = $row['UserLastName'];
    $UserUserName = $row['UserUserName'];
    $UserAge = $row['UserAge'];
    $UserMartialStatus = $row['UserMartialStatus'];
    $UserOccupation = $row['UserOccupation'];
    $UserContactDetails = $row['UserContactDetails'];
    $UserEmail= $row['UserEmail'];
}
?>


<section class="user_profile_section layout_padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="user_profile_container">
          <div class="heading_container heading_center">
            <h2>User Profile</h2>
          </div>

          <div class="form-group text-center">
            <label>Uploaded Profile Picture:</label>
            <div class="profile_picture_container">
            <img src="images/profile-pictures/<?php echo $row['image'] ? $row['image'] : "default_profile_picture.png"; ?>" alt="Profile Picture" class="profile-picture">

              <!-- <img src="profileImages/default_profile_picture.png" class="img-fluid rounded-circle" alt="Profile Picture" style="max-width: 350px;"> -->
            </div>
          </div>

          <form action="#" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">First Name:</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $UserFirstName ?>" required>
                </div>
                <div class="form-group">
                  <label for="last_name">Last Name:</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" value="<?php if (isset($UserLastName)) echo $UserLastName; ?>" required>
                </div>
                <div class="form-group">
                  <label for="age">Age:</label>
                  <input type="number" class="form-control" id="age" name="age" value="<?php if (isset($UserAge)) echo $UserAge; ?>"  required>
                </div>
                <div class="form-group">
                  <label for="marital_status">Marital Status:</label>
                  <select class="form-control" id="marital_status" name="marital_status">
                  <option value="" disabled selected>Select Status</option>
                            <option value="Married" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Married') echo 'selected="selected"'; ?>>Married</option>
                            <option value="Unmmaried" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Unmmaried') echo 'selected="selected"'; ?>>Unmmaried</option>
                            <option value="Divorced" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Divorced') echo 'selected="selected"'; ?>>Divorced</option>
                            <option value="Widowed" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Widowed') echo 'selected="selected"'; ?>>Widowed</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?php if (isset($UserUserName)) echo $UserUserName; ?>"  required>
                </div>
                <div class="form-group">
                  <label for="occupation">Occupation:</label>
                  <input type="text" class="form-control" id="occupation" name="occupation" value="<?php if (isset($UserOccupation)) echo $UserOccupation; ?>" required>
                </div>
                <div class="form-group">
                  <label for="contact_details">Contact Details:</label>
                  <input type="text" class="form-control" id="contact_details" name="contact_details" value="<?php if (isset($UserContactDetails)) echo $UserContactDetails; ?>" required>
                </div>
                <div class="form-group">
                  <label for="UserEmail">Email:</label>
                  <input type="text" class="form-control" id="UserEmail" name="UserEmail" value="<?php if (isset($UserEmail)) echo $UserEmail; ?>" required>
                </div>
                <!-- <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="password" name="password" value="<?php if (isset($UserPwd)) echo $UserPwd; ?>"  required>
                </div> -->
                <br>
                
                <div class="form-group">
                  <label for="profile_picture">Profile Picture:
                  <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" accept="image/*"></label>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button> 
              <a href="UserProfile-read.php" class="btn btn-primary">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>




<!-- end user profile form -->
   <!-- end service section -->

   <?php include('include/footer.php'); ?>
