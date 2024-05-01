<?php
session_start();
include('include/header.php');

?>
</div>

<?php
//check form is submitted and save the value or not
// Check if button is clicked or not
if (isset($_POST['Submit'])) {
    require_once ('../Database/database.php');
    $errors = array();

    // Get values from the form
     // Get values from the form
     $UserID = $_POST['UserID'];
     $UserFirstName = mysqli_real_escape_string($dbc, $_POST['UserFirstName']);
     $UserLastName = mysqli_real_escape_string($dbc, $_POST['UserLastName']);
     $UserUserName = mysqli_real_escape_string($dbc, $_POST['UserUserName']);
     $UserPwd = mysqli_real_escape_string($dbc, $_POST['UserPwd']);
     $UserAge = mysqli_real_escape_string($dbc, $_POST['UserAge']);
     // Check if UserMartialStatus is set before accessing it
     $UserMartialStatus = isset($_POST['UserMartialStatus']) ? mysqli_real_escape_string($dbc, $_POST['UserMartialStatus']) : '';
     $UserOccupation = mysqli_real_escape_string($dbc, $_POST['UserOccupation']);
     $UserContactDetails = mysqli_real_escape_string($dbc, $_POST['UserContactDetails']);
     
    
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
   
    $result = @mysqli_query($dbc, $query);


    
    // Process profile picture upload
    $profile_picture = 'images/profile-pictures/default_profile_picture.png'; // Default profile picture path
    var_dump($_FILES, $_POST);
    if (isset($_FILES['profile_picture']['name']) && !empty($_FILES['profile_picture']['name'])) {
        $img_name = $_FILES['profile_picture']['name'];
        $tmp_name = $_FILES['profile_picture']['tmp_name'];
        $error = $_FILES['profile_picture']['error'];
        
        if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);
    
            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
                // Generate unique filename
                $new_img_name = uniqid($UserUserName, true) . '.' . $img_ex_to_lc;
                $img_upload_path = 'images/profile-pictures/' . $new_img_name;
    
                // Move uploaded file to destination
                move_uploaded_file($tmp_name, $img_upload_path);
    
                // Update user's profile picture in the database
                $sql = "UPDATE user SET image='$new_img_name' WHERE UserID=$UserID";
                $dbc->query($sql);
    
                
            }
        }
    }

    header('Location: http://localhost/php-projects/CommuniHub/Committee/profile-read.php');
    exit();
} 


?>

<div class="main-content">
    <div class="wrapper">
        
        <br>
        <br>

        <form 
            action="#"
            method="post"
            enctype="multipart/form-data">
            <?php
            
            require_once ('../Database/database.php');
            //get user ID
            $UserID = $_SESSION["UserID"];

            $query = "SELECT * FROM user WHERE UserID = '$UserID'";
            // $query = "SELECT * FROM user WHERE user.UserID=$UserID";
            $result = @mysqli_query ($dbc,$query); // Run the query.
            // $row=mysqli_fetch_assoc($result);
            // $profileImage = $row["UserImg"];
            // print_r($_SESSION);

            // Check if the query executed successfully
            if ($result && mysqli_num_rows($result) == 1) {
                // Assign values to variables
                $row=mysqli_fetch_assoc($result);
                // print_r($row["UserFirstName"]);
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
                // header('Location: Committee-profile-read.php');
                // exit();
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
              <img src="profileImages/default_profile_picture.png" class="img-fluid rounded-circle" alt="Profile Picture" style="max-width: 350px;">
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


<?php include('include/footer.php'); ?>
