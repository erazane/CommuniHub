<?php include('includes/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update User</h1>
        <br><br>

        <?php

        session_start();
        require_once ('../Database/database.php');

        // Get id of the selected admin
        $UserID = isset($_GET['UserID']) ? $_GET['UserID'] : null;

        // Check if UserID is not set or not numeric
        if (!isset($UserID) || !is_numeric($UserID)) {
            header('Location: manage-user.php');
            exit();
        }

        // Create SQL query to get data for the specified admin
        $query = "SELECT * FROM user WHERE UserID = '$UserID'";

        // Execute the query
        $result = mysqli_query($dbc, $query);

        // Check if the query executed successfully
        if ($result) {
            // Check if data is available
            $num = mysqli_num_rows($result);
            if ($num == 1) {
                // Get details
                $row = mysqli_fetch_assoc($result);

                $UserFirstName=$row['UserFirstName'];
                $UserLastName=$row['UserLastName'];
                $UserUserName=$row['UserUserName'];
                $UserAge=$row['UserAge'];
                $UserMartialStatus=$row['UserMartialStatus'];
                $UserOccupation=$row['UserOccupation'];
                $UserContactDetails=$row['UserContactDetails'];
                //$UserType=$row['UserType'];

            } else {
                // Redirect to manage admin page if no data found
                header('Location: manage-user.php');
                exit();
            }
        } else {
            // Handle query execution error
            echo "Error executing query: " . mysqli_error($dbc);
            exit();
        }
        ?>
        <form action="#" method="post">
        <table class="tbl-30">
                <tr>
                    <td>First Name: </td>
                    <td><input type="text" name="UserFirstName" placeholder="Enter First Name" size="20" maxlength="40" value="<?php if (isset($_POST['UserFirstName'])) echo $_POST['UserFirstName']; ?>"  /></td>
                </tr>
               
                <tr>
                    <td>Last Name: </td>
                    <td><input type="text" name="UserLastName" placeholder="Enter Last Name"  size="20" maxlength="40" value="<?php if (isset($_POST['UserLastName'])) echo $_POST['UserLastName']; ?>"  /></td>
                </tr>
                <tr>
                    <td>Age: </td>
                    <td><input type="text" name="UserAge" placeholder="Enter Age" size="20" maxlength="40" value="<?php if (isset($_POST['UserAge'])) echo $_POST['UserAge']; ?>"  /></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="UserUserName" placeholder="Enter Username" size="20" maxlength="40" value="<?php if (isset($_POST['UserUserName'])) echo $_POST['UserUserName']; ?>"  /></td>
                </tr>
                <tr>
                    <td>Martial Status: </td>
                    <td>
                    <select name="UserMartialStatus" >
                        <option value="" disabled selected>Select Status</option>
                        <option value="Married">Married</option>
                        <option value="Unmmaried">Unmmaried</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                    </td>
                </tr>
               
                <tr>
                    <td>Occupation: </td>
                    <td><input type="text" name="UserOccupation" placeholder="Enter Occupation"  size="20" maxlength="40" value="<?php if (isset($_POST['UserOccupation'])) echo $_POST['UserOccupation']; ?>"  /></td>
                </tr>

                <tr>
                    <td>Contact Number: </td>
                    <td><input type="text" name="UserContactDetails" placeholder="Enter Contact Number" size="20" maxlength="40" value="<?php if (isset($_POST['UserContactDetails'])) echo $_POST['UserContactDetails']; ?>"  /></td>
                </tr>
                <!-- <tr>
                    <td>User Type: </td>
                    <td>
                    <select name="UserType">
                        <option value="" disabled selected>Select User Type</option>
                        <option value="Resident">Resident</option>
                        <option value="Commitee">Commitee</option>
                    </select>
                    </td>
                </tr> -->
            
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                        <input type="submit" name="Submit" value="Update User" class="btn-primary"/>
                        <a href="manage-user.php" class="btn-primary">Manage user</a> 
                    </td>
                </tr>
            </table>
	        
        </form>
    </div>
</div>

<?php 
if (isset($_POST['Submit'])){
    // GET VALUES
    $UserID = $_POST['UserID'];
    $UserFirstName = mysqli_real_escape_string($dbc, $_POST['UserFirstName']);
    $UserLastName = mysqli_real_escape_string($dbc, $_POST['UserLastName']);
    $UserUserName= mysqli_real_escape_string($dbc, $_POST['UserUserName']);
    $UserAge = mysqli_real_escape_string($dbc, $_POST['UserAge']);
    $UserMartialStatus = mysqli_real_escape_string($dbc, $_POST['UserMartialStatus']);
    $UserOccupation = mysqli_real_escape_string($dbc, $_POST['UserOccupation']);
    $UserContactDetails = mysqli_real_escape_string($dbc, $_POST['UserContactDetails']);
    // $UserType = mysqli_real_escape_string($dbc, $_POST['UserType']);


    // Make update query.
    $query = "UPDATE user SET UserFirstName='$UserFirstName', UserLastName='$UserLastName',UserUserName='$UserUserName', UserAge='$UserAge', UserMartialStatus='$UserMartialStatus' ,UserOccupation='$UserOccupation', UserLastName='$UserLastName',UserContactDetails='$UserContactDetails'
    WHERE UserID='$UserID'";		

    // Execute query
    $result = mysqli_query($dbc, $query);

    // Check if query is successful
    // if($result) {
    //     $_SESSION['updateUser'] = "<div class='success'>User updated Successfully</div>";
    //     header('Location: http://localhost/php-projects/CommuniHub/admin/manage-user.php');
    // } else {
    //     $_SESSION['updateUser'] = "<div class='error'>Failed to update user " . mysqli_error($dbc) . "</div>";
    //     header('Location: http://localhost/php-projects/CommuniHub/admin/manage-user.php');
    //     exit();
    // }
}

?>
<?php include('includes/footer.php'); ?> 

