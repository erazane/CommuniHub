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
    session_start();
    require_once ('../Database/database.php');
    //get user ID
    $UserID = $_SESSION["UserID"];

    $query = "SELECT * FROM user WHERE UserID = '$UserID'";
    $result = @mysqli_query ($dbc,$query); // Run the query.

    // Check if the query executed successfully
    if ($result && mysqli_num_rows($result) == 1) {
        // Assign values to variables
        $row=mysqli_fetch_assoc($result);
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
        header('Location: Committee-profile.php');
        exit();
    }

?>

<div class="main-content">
    <div class="wrapper">
        <h1>User Profile</h1>
        <br>
        <br>
            
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
                <td><?php if (isset($UserFirstName)) echo $UserFirstName; ?></td>
            </tr>

            <tr>
                <td>Last Name: </td>
                <td><?php if (isset($UserLastName)) echo $UserLastName; ?></td>
            </tr>

            <tr>
                <td>Username: </td>
                <td><?php if (isset($UserUserName)) echo $UserUserName; ?></td>
            </tr>

            <tr>
                <td>Age: </td>
                <td><?php if (isset($UserAge)) echo $UserAge; ?></td>
            </tr>

            <tr>
                <td>Martial Status: </td>
                <td><?php if (isset($UserMartialStatus)) echo $UserMartialStatus; ?></td>
            </tr>

            <tr>
                <td>Occupation: </td>
                <td><?php if (isset($UserOccupation)) echo $UserOccupation; ?></td>
            </tr>

            <tr>
                <td>Contact Number: </td>
                <td><?php if (isset($UserContactDetails)) echo $UserContactDetails; ?></td>
            </tr>

            <tr>
                <td>
                    <a href="Committee-profile.php" class="btn-primary">Update</a>
                </td>
            </tr>
            
        </table>
	        
    </div>
</div>

<?php include('includes/footerCom.php'); ?> 
