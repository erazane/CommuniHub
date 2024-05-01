<?php include('includes/menuCom.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    
<link rel="stylesheet" type="text/css" href="../Styles/userprofile.css">

</head>
</html>

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

    // if ($result) {
    //     // If the user information is successfully updated
    //     $_SESSION['update'] = "<div class='success'>Profile updated successfully</div>";
    //     // Redirect to the profile page
    //     header('Location: http://localhost/php-projects/CommuniHub/commitee/Committee-profile.php');
    //     exit();
    // } else {
    //     // If an error occurs during the update process
    //     $_SESSION['update'] = "<div class='error'>Failed to update profile: " . mysqli_error($dbc) . "</div>";
    //     header('Location: http://localhost/php-projects/CommuniHub/commitee/Committee-profile.php');
    //     exit();
    // }

    
    // Process profile picture upload
    $profile_picture = 'images/default_profile_picture.png'; // Default profile picture path
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
                $img_upload_path = 'images/' . $new_img_name;
    
                // Move uploaded file to destination
                move_uploaded_file($tmp_name, $img_upload_path);
    
                // Update user's profile picture in the database
                $sql = "UPDATE user SET UserImg='$new_img_name' WHERE UserID=$UserID";
                $dbc->query($sql);
    
                // Redirect to the current page to avoid form resubmission
                // header('Location: ' . $_SERVER['PHP_SELF']);
                // header('Location: http://localhost/php-projects/CommuniHub/commitee/Committee-profile-read.php');

            }
        }
    }

    header('Location: http://localhost/php-projects/CommuniHub/commitee/Committee-profile-read.php');
    exit();
} 


?>

<div class="main-content">
    <div class="wrapper">
        <h1>User Profile</h1>
        <br>
        <br>

        <form 
            action="#"
            method="post"
            enctype="multipart/form-data">
            <?php
            session_start();
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
            
            <!-- <form action="#" method="post"> -->
            <table class="tbl-30">
                <tr>
                    <td>
                        <!-- Display profile picture here -->
                        <img src="images/<?php echo $row['UserImg'] ? $row['UserImg'] : "default_profile_picture.png"; ?>" alt="Profile Picture" class="profile-picture">
                        <br>
                    </td>
                </tr>
                <tr>
                    <td>First Name: </td>
                    <td><input type="text" name="UserFirstName" placeholder="Enter First Name" size="20" maxlength="40" value="<?php if (isset($UserFirstName)) echo $UserFirstName; ?>" /></td>
                </tr>

                <tr>
                    <td>Last Name: </td>
                    <td><input type="text" name="UserLastName" placeholder="Enter Last Name"  size="20" maxlength="40" value="<?php if (isset($UserLastName)) echo $UserLastName; ?>"  /></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="UserUserName" placeholder="Enter Username"  size="20" maxlength="40" value="<?php if (isset($UserUserName)) echo $UserUserName; ?>"  /></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="UserPwd" placeholder="Enter Password" size="20" maxlength="40" value="<?php if (isset($UserPwd)) echo $UserPwd; ?>"  /></td>
                </tr>

                <tr>
                    <td>Age: </td>
                    <td><input type="text" name="UserAge" placeholder="Enter Age" size="20" maxlength="40" value="<?php if (isset($UserAge)) echo $UserAge; ?>" /></td>
                </tr>

                <tr>
                    <td>Martial Status: </td>
                    <td>
                        <select name="UserMartialStatus">
                            <option value="" disabled selected>Select Status</option>
                            <option value="Married" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Married') echo 'selected="selected"'; ?>>Married</option>
                            <option value="Unmmaried" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Unmmaried') echo 'selected="selected"'; ?>>Unmmaried</option>
                            <option value="Divorced" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Divorced') echo 'selected="selected"'; ?>>Divorced</option>
                            <option value="Widowed" <?php if (isset($UserMartialStatus) && $UserMartialStatus == 'Widowed') echo 'selected="selected"'; ?>>Widowed</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Occupation: </td>
                    <td><input type="text" name="UserOccupation" placeholder="Enter Occupation" size="20" maxlength="40" value="<?php if (isset($UserOccupation)) echo $UserOccupation; ?>" /></td>
                </tr>

                <tr>
                    <td>Contact Details: </td>
                    <td><input type="text" name="UserContactDetails" placeholder="Enter Contact Number" size="20" maxlength="40" value="<?php if (isset($UserContactDetails)) echo $UserContactDetails; ?>" /></td>
                </tr>

                <tr>
                    <td>Update Profile Picture: </td>
                    <td>
                        <input type="file" name="profile_picture">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                        <input type="submit" name="Submit" value="Submit" class="btn-primary"/>
                        
                    </td>
                </tr>
            </table>
	        
        </form>
    </div>
</div>



<?php include('includes/footerCom.php'); ?> 
