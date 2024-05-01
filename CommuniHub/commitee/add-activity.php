<?php include('../commitee/includes/menuCom.php'); ?>

<?php
// Initialize variables
$ActivityName = '';
$ActivityLocation = '';
$ActivityDate	 = '';
$ActivityTime = '';
$ActivityType = '';
$errors = [];

// Check if form is submitted
if (isset($_POST['Submit'])) {
    require_once('../Database/database.php');

    // Validate and assign Garbage Day
    if (!empty($_POST['ActivityName'])) {
        $ActivityName = $_POST['ActivityName'];
    } else {
        $errors[] = 'Activity name must be filled out.';
    }

    // Validate and assign Garbage Pickup Hour
    if (!empty($_POST['ActivityLocation'])) {
        $ActivityLocation = $_POST['ActivityLocation'];
    } else {
        $errors[] = 'Activity Location must be filled out';
    }

    // Validate and assign Garbage Pickup Minute
    if (!empty($_POST['ActivityDate'])) {
        $ActivityDate	 = $_POST['ActivityDate'];
    } else {
        $errors[] = 'Activity Date must be filled out.';
    }
    
    // Validate and assign Garbage Pickup Minute
    if (!empty($_POST['ActivityTime'])) {
        $ActivityTime	 = $_POST['ActivityTime'];
    } else {
        $errors[] = 'Activity Time must be filled out';
    }

    // Validate and assign Garbage Pickup Minute
    if (!empty($_POST['ActivityType'])) {
        $ActivityType	 = $_POST['ActivityType'];
    } else {
        $errors[] = 'Must select an activity type.';
    }



    // Insert into database if no errors
    if (empty($errors)) {
        $query = "INSERT INTO activities 
        (ActivityName, ActivityLocation,
         ActivityDate,ActivityTime,ActivityType
        ) 
         VALUES (
            '$ActivityName', '$ActivityLocation', 
            '$ActivityDate' ,'$ActivityTime','$ActivityType'	
             )";
        $result = @mysqli_query($dbc, $query);

        if ($result) {
            echo '<h1>Successful Registration</h1><p>Activity has been created.</p>';
        } else {
            echo "<h1>System Error</h1><p class='error'>Activity could not be registered due to a system error. We apologize for any inconvenience.</p>";
            // Debugging
            echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $query . '</p>';
        }
    } else {
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }

    
    mysqli_close($dbc);
}


?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Activity</h1>
        <br>
        <br>



        <form action="#" method="post">
            <table class="tbl-30">
                <tr>
                    <td> Title: </td>
                    <td><input type="text" name="ActivityName" placeholder="Activity Title" size="20" maxlength="40" value="<?php if (isset($_POST['ActivityName'])) echo $_POST['ActivityName']; ?>"  /></td>
                </tr>
               
                <tr>
                    <td>Location: </td>
                    <td><input type="text" name="ActivityLocation" placeholder="Activity Location"  size="20" maxlength="40" value="<?php if (isset($_POST['ActivityLocation'])) echo $_POST['ActivityLocation']; ?>"  /></td>
                </tr>

                <tr>
                    <td>Date: </td>
                    <td><input type="date" name="ActivityDate" placeholder="Enter Date" size="20" maxlength="40" value="<?php if (isset($_POST['ActivityDate'])) echo $_POST['ActivityDate']; ?>"  /></td>
                </tr>
                <tr>
                    <td>Time: </td>
                    <td><input type="time" name="ActivityTime" placeholder="Enter time" size="20" maxlength="40" value="<?php if (isset($_POST['ActivityTime'])) echo $_POST['ActivityTime']; ?>"  /></td>
                </tr>
                <tr>
                <td>Type: </td>
                <td>
                    <select name="ActivityType" >
                        <option value="" disabled selected>Select Status</option>
                        <option value="Clean-up Day">Clean-up Day</option>
                        <option value="Block-Party">Block Party</option>
                        <option value="Community-Garden">Community Garden</option>
                        <option value="Fitness-Classes">Fitness Classes</option>
                        <option value="Holiday-Celebrations">Holiday Celebrations</option>
                        <option value="Workshops">Workshops</option>
                       
                    </select>
                </td>
            </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="Submit" value="Add Activity" class="btn-primary"/>
                        <a href="manage-activities.php" class="btn-primary">Manage Activities</a> 
                    </td>
                </tr>
            </table>
	        
        </form>
    </div>
</div>
        
                 

       
           


<?php include('../commitee/includes/footerCom.php'); ?> 

