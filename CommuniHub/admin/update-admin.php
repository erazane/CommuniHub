<?php include('includes/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php

        session_start();
        require_once ('../Database/database.php');

        // Get id of the selected admin
        $AdminID = isset($_GET['adminID']) ? $_GET['adminID'] : null;

        // Check if adminID is not set or not numeric
        if (!isset($AdminID) || !is_numeric($AdminID)) {
            header('Location: manage-admin.php');
            exit();
        }

        // Create SQL query to get data for the specified admin
        $query = "SELECT * FROM admin WHERE adminID = '$AdminID'";

        // Execute the query
        $result = mysqli_query($dbc, $query);

        // Check if the query executed successfully
        if ($result) {
            // Check if data is available
            $num = mysqli_num_rows($result);
            if ($num == 1) {
                // Get details
                $row = mysqli_fetch_assoc($result);

                $NewAdminName = $row['adminName'];
                $AdminUsername = $row['adminUserName'];
            } else {
                // Redirect to manage admin page if no data found
                header('Location: manage-admin.php');
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
                    <td>Full Name: </td>
                    <td><input type="text" name="NewAdminName" placeholder="Enter Full Name" size="20" maxlength="40" value="<?php if (isset($NewAdminName)) echo $NewAdminName; ?>"  /></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="AdminUsername" placeholder="Enter Username" size="20" maxlength="40" value="<?php if (isset($AdminUsername)) echo $AdminUsername; ?>"  /></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="adminID" value="<?php echo $AdminID; ?>">
                        <input type="submit" name="Submit" value="Update Admin" class="btn-primary"/>
                        <a href="manage-admin.php" class="btn-primary">Manage Admin</a> 
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
if (isset($_POST['Submit'])){
    // GET VALUES
    $AdminID = $_POST['adminID'];
    $NewAdminName = mysqli_real_escape_string($dbc, $_POST['NewAdminName']);
    $AdminUsername = mysqli_real_escape_string($dbc, $_POST['AdminUsername']);

    // Make update query.
    $query = "UPDATE admin SET adminName='$NewAdminName', adminUserName='$AdminUsername' WHERE adminID='$AdminID'";		

    // Execute query
    $result = mysqli_query($dbc, $query);

    // Check if query is successful
    if($result) {
        $_SESSION['update'] = "<div class='success'>Admin updated Successfully</div>";
        header('Location: http://localhost/php-projects/CommuniHub/admin/manage-admin.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to update admin: " . mysqli_error($dbc) . "</div>";
        header('Location: http://localhost/php-projects/CommuniHub/admin/manage-admin.php');
        exit();
    }
}

?>
<?php include('includes/footer.php'); ?> 

