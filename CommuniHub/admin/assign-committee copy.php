<?php include('../admin/includes/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Assign Committee</h1>
        <br>
        <br>

        <form action="#" method="post">

            <table class="tbl-30">
                <!-- ... (other user registration fields) ... -->

                <tr>
                    <td>User ID:</td>
                    <td>
                        <select name="UserID" id="UserID">
                            <option value="" disabled selected>Select User ID</option>
                            <?php
                            require_once('../Database/database.php');
                            
                            // Fetch existing User IDs from the 'users' table
                            $userQuery = "SELECT UserID FROM users";
                            $userResult = mysqli_query($dbc, $userQuery);

                            if ($userResult) {
                                while ($user = mysqli_fetch_assoc($userResult)) {
                                    echo '<option value="' . htmlspecialchars($user['UserID']) . '">' . htmlspecialchars($user['UserID']) . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>No User IDs available</option>';
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                <td>Position: </td>
                <td>
                <select name="CommiteePost" >
                        <option value="" disabled selected>Select Status</option>
                        <option value="President">President</option>
                        <option value="Vice President">Vice President</option>
                        <option value="Secretary">Secretary</option>
                        <option value="Vice Secretary">Vice Secretary</option>
                        <option value="Treasurer">Treasurer</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Technical">Technical</option>
                        <!-- will add more later -->
                    </select>
                </td>
                </tr>
                <tr>
                <td>Committee Start Date: </td>
                     <td><input type="date" name="comm-StartDate" placeholder="Enter Start Date"/></td>
                </tr>
                <td>Committee End Date: </td>
                 <td><input type="date" name="comm-EndDate" placeholder="Enter End Date"/></td> 
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="Submit" value="Add User" class="btn-primary"/>
                        <a href="register-committee.php" class="btn-primary">Manage Committee</a> 
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
//check form is submitted and save the value or not

//check if button is clicked or not
if (isset($_POST['Submit'])) {
    require_once('../Database/database.php');
    $errors = array();

    // Get and validate data from the form
    $UserID = mysqli_real_escape_string($dbc, $_POST['UserID']);
    $CommiteePost = mysqli_real_escape_string($dbc, $_POST['CommiteePost']);
    $commStartDate = mysqli_real_escape_string($dbc, $_POST['comm-StartDate']);
    $commEndDate = mysqli_real_escape_string($dbc, $_POST['comm-EndDate']);

    if (empty($UserID)) {
        $errors[] = 'Please select a User ID.';
    }
    if (empty($CommiteePost)) {
        $errors[] = 'Start date is required.';
    }
    if (empty($commStartDate)) {
        $errors[] = 'Start date is required.';
    }
    if (empty($commEndDate)) {
        $errors[] = 'End date is required.';
    }

    // Only proceed if there are no errors
    if (empty($errors)) {
        // Insert data into committee table
        $query = "INSERT INTO committee (UserID, CommitteePost, commStartDate, commEndDate) VALUES ('$UserID', '$CommiteePost', '$commStartDate', '$commEndDate')";
        $result = mysqli_query($dbc, $query);

        if ($result) {
            echo '<p class="success">User successfully added to the committee.</p>';
        } else {
            echo '<p class="error">Error while adding the user to the committee: ' . mysqli_error($dbc) . '</p>';
        }
    }
    // Display errors
    if (!empty($errors)) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    }
}
    mysqli_close($dbc); // Close the database connection.

?>
<?php include('includes/footer.php'); ?> 