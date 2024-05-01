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

<div class="main-content">
    <div class="wrapper">
        <h1>User Profile</h1>
        <br>
        <br>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            method="post"
            enctype="multipart/form-data">
            <?php
            session_start();
            $userId = $_SESSION["UserID"];
            $query = "SELECT * FROM user WHERE user.UserID=$userId";
            $result = @mysqli_query ($dbc,$query); // Run the query.
            $row=mysqli_fetch_assoc($result);
            $profileImage = $row["UserImg"];
            // print_r($_SESSION);
            ?>
            <table class="tbl-30">
            <tr>
                   
                    <td>
                        <!-- Display profile picture here -->
                        <img src="images/<?php echo $profileImage; ?>" alt="Profile Picture" class="profile-picture">
                        <br>
                        
                    </td>
                </tr>
                <tr>
                    <td>First Name: </td>
                    <td><input type="text" name="UserFirstName" placeholder="Enter First Name" size="20" maxlength="40" value="<?php if (isset($row['UserFirstName'])) echo $row['UserFirstName']; ?>"  /></td>
                </tr>
               
                <tr>
                    <td>Last Name: </td>
                    <td><input type="text" name="UserLastName" placeholder="Enter Last Name"  size="20" maxlength="40" value="<?php if (isset($row['UserLastName'])) echo $row['UserLastName']; ?>"  /></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="UserUserName" placeholder="Enter Username"  size="20" maxlength="40" value="<?php if (isset($row['UserUserName'])) echo $row['UserUserName']; ?>"  /></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="UserPwd" placeholder="Enter Password" size="20" maxlength="40" value="<?php if (isset($row['UserPwd'])) echo $row['UserPwd']; ?>"  /></td>
                </tr>
                <tr>
                    <td>Age: </td>
                    <td><input type="text" name="UserAge" placeholder="Enter Age" size="20" maxlength="40" value="<?php if (isset($row['UserAge'])) echo $row['UserAge']; ?>" /></td>
                </tr>
                <tr>
                    <td>Martial Status: </td>
                    <td>
                        <select name="UserMartialStatus">
                            <option value="" disabled selected>Select Status</option>
                            <option value="Married" <?php if (isset($row['UserMartialStatus']) && $row['UserMartialStatus'] == 'Married') echo 'selected="selected"'; ?>>Married</option>
                            <option value="Unmmaried" <?php if (isset($row['UserMartialStatus']) && $row['UserMartialStatus'] == 'Unmmaried') echo 'selected="selected"'; ?>>Unmmaried</option>
                            <option value="Divorced" <?php if (isset($row['UserMartialStatus']) && $row['UserMartialStatus'] == 'Divorced') echo 'selected="selected"'; ?>>Divorced</option>
                            <option value="Widowed" <?php if (isset($row['UserMartialStatus']) && $row['UserMartialStatus'] == 'Widowed') echo 'selected="selected"'; ?>>Widowed</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Occupation: </td>
                    <td><input type="text" name="UserOccupation" placeholder="Enter Occupation" size="20" maxlength="40" value="<?php if (isset($row['UserOccupation'])) echo $row['UserOccupation']; ?>" /></td>
                </tr>

                <tr>
                    <td>Contact Number: </td>
                    <td><input type="text" name="UserContactDetails" placeholder="Enter Contact Number" size="20" maxlength="40" value="<?php if (isset($row['UserContactDetails'])) echo $row['UserContactDetails']; ?>" /></td>
                </tr>
                <tr>
                    <td>Update Profile Picture: </td>
                    <td>
                        <input type="file" name="profile_picture">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="Submit" value="Submit" class="btn-primary"/>
                        
                    </td>
                </tr>
            </table>
	        
        </form>
    </div>
</div>

<?php
//check form is submitted and save the value or not

//check if button is clicked or not
if (isset($_POST['Submit'])){

    require_once ('../Database/database.php');
    $errors = array();

    //Get data from the form

    //check for user first name
    if (empty($_POST['UserFirstName'])) {
		$errors[] = 'Must fill in first name.';
	} else {
		$UserFirstName = ($_POST['UserFirstName']);
	}
	
	// Check for user last name.
	if (empty($_POST['UserLastName'])) {
		$errors[] = 'Must fill in last name';
	} else {
		$UserLastName = ($_POST['UserLastName']);
	}

    //check username
	if (empty($_POST['UserUserName'])) {
		$errors[] = 'Must fill in Username';
	} else {
		$UserUserName = ($_POST['UserUserName']);
	}

    //check for user password
    if (empty($_POST['UserPwd'])) {
		$errors[] = 'Must include password.';
	} else {
       // Hash the user password using crypt
       $UserPwd = crypt($_POST['UserPwd'], 'ahookdemok');

        // // Debugging: Output the hashed password to check
        // echo "Hashed password: " . $UserPwd;
	} 
    // Check for user age
	if (empty($_POST['UserAge'])) {
		$errors[] = 'Must include age.';
	} else {
		$UserAge = ($_POST['UserAge']);  
	} 

    //check user martial status
    if (empty($_POST['UserMartialStatus'])) {
		$errors[] = 'Must include full name.';
	} else {
		$UserMartialStatus = ($_POST['UserMartialStatus']);
	}
	
	// Check for user occupation.
	if (empty($_POST['UserOccupation'])) {
		$errors[] = 'Must include occupation';
	} else {
		$UserOccupation = ($_POST['UserOccupation']);
	}

    // Check for user contant details.
	if (empty($_POST['UserContactDetails'])) {
		$errors[] = 'Must include contact details.';
	} else {
		$UserContactDetails = ($_POST['UserContactDetails']);  //password encryption with md5
	} 
    // if (empty($_POST['UserType'])) {
	// 	$errors[] = 'Must include user type.';
	// } else {
	// 	$UserType = ($_POST['UserType']);
	// }
	
    $profile_picture = 'images/default_profile_picture.png'; // Default profile picture path
    var_dump($_FILES, $_POST);
    if (isset($_FILES['profile_picture']['name']) && !empty($_FILES['profile_picture']['name'])) {
        $errors[] =  "there\n";
        // Process uploaded profile picture
        // $upload_dir = 'images/'; // Directory to save uploaded images
        // $profile_picture_name = $_FILES['profile_picture']['name'];
        // $profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];
        // $profile_picture = $upload_dir . $profile_picture_name;
        // move_uploaded_file($profile_picture_tmp, $profile_picture);
         $img_name = $_FILES['profile_picture']['name'];
         $tmp_name = $_FILES['profile_picture']['tmp_name'];
         $error = $_FILES['profile_picture']['error'];
         
         if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs)){
                $new_img_name = uniqid($row['UserUserName'], true).'.'.$img_ex_to_lc;
                $img_upload_path = 'images/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                $sql = "UPDATE user SET user.UserImg='$new_img_name' WHERE user.UserID=$userId";
                $dbc->query($sql);
                header('Location: '.$_SERVER['PHP_SELF']);
                // exit;
            }
            // else {
            //    $em = "You can't upload files of this type";
            //    header("Location: ../index.php?error=$em&$data");
            //    exit;
            // }
        }
        // else {
        //     $em = "unknown error occurred!";
        //     header("Location: ../index.php?error=$em&$data");
        //     exit;
        // }
    }
    //end

    // Display errors (if any)
    if (!empty($errors)) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    } else {
        // Process the form data if no errors
        //processing the data goes here wowowo

        //get data

        $UserFirstName=$_POST['UserFirstName'];
        $UserLastName=$_POST['UserLastName'];
        $UserUserName=$_POST['UserUserName'];
        // $UserPwd=$_POST['UserPwd'];
        $UserAge=$_POST['UserAge'];
        $UserMartialStatus=$_POST['UserMartialStatus'];
        $UserOccupation=$_POST['UserOccupation'];
        $UserContactDetails=$_POST['UserContactDetails'];
        $UserType=$_POST['UserType'];
      
       //SQL query to save data in database
      // Make the query.
      if (empty($errors)) { 

        // Check for previous registration.
        $query = "SELECT UserID FROM user WHERE UserFirstName='$UserFirstName' AND UserLastName='$UserLastName'";
        $result = @mysqli_query ($dbc,$query); // Run the query.
        if (mysqli_num_rows($result) == 0) {

        $query = "INSERT INTO user (UserFirstName, UserLastName,UserUserName, UserPwd ,UserAge , UserMartialStatus,UserOccupation,UserContactDetails,UserType) 
        VALUES ('$UserFirstName', '$UserLastName','$UserUserName', '$UserPwd', '$UserAge' , '$UserMartialStatus', '$UserOccupation', '$UserContactDetails', '$UserType')";		
        $result = @mysqli_query ($dbc,$query);

        if ($result) { // If it ran OK. == IF TRUE
            
            // Print a message.
            echo '<h1 id="mainhead">Successful Registration</h1>
            <p>The user is now added. </p><p><br /></p>';
            
        } else { // If it did not run OK.
            echo '<h1 id="mainhead">System Error</h1>
            <p class="error">User could not be registered due to a system error. We apologize for any inconvenience.</p>'; // Public message.
            echo '<p>' . mysqli_error($dbc)  . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.

            exit();
        }// end if for run message

      }else { // Already registered.
        echo '<h1 id="mainhead">Error!</h1>
        <p class="error">This User has already been added to the database.</p>';
    }//end else for register

    }else { // Report the errors.
	
		echo '<h1 id="mainhead">Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.
		
    } // End of the main Submit conditional.
        
    
}//end conditional for submitted button

?>

<?php include('includes/footerCom.php'); ?> 

