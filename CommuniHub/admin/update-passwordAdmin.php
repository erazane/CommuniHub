<?php include('includes/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <br>

        <?php
            // Get id of the selected admin
            $AdminID = isset($_GET['adminID']) ? $_GET['adminID'] : null;

            // Check if adminID is not set or not numeric
            if (!isset($AdminID) || !is_numeric($AdminID)) {
                header('Location: manage-admin.php');
                exit();
            }
        ?>

        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>
                        Previous Password:
                    </td>
                    <td>
                        <input type="password" name="adminPwd" placeholder="Previous Password">
                    </td>
                </tr>

                <tr>
                    <td>
                        New Password:
                    </td>
                    <td>
                        <input type="password" name="NewPassword" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>
                        Confirm Password:
                    </td>
                    <td>
                        <input type="password" name="ConfirmPassword" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="adminID" value="<?php echo $AdminID; ?>">
                        <input type="Submit" name="Submit" value="Change Password" class="btn-primary">
                    </td>
                </tr> 
            </table>
        </form>
    </div>
</div>

<?php 
session_start();
require_once('../Database/database.php');

// Check if the form is submitted
if (isset($_POST['Submit'])) {
    $key = 'ahookdemok';
    // Get values
    $AdminID = $_POST['adminID'];
    // $PrePassword = md5($_POST['adminPwd']);
    $NewPassword = crypt($_POST['NewPassword'], $key);
    $ConfirmPassword = crypt($_POST['ConfirmPassword'], $key);
    $PrePassword = crypt($_POST['adminPwd'], $key);

    // Make update query.
    // $query = "SELECT * FROM admin WHERE adminID=$AdminID AND adminPwd='$PrePassword'";
    $query = "SELECT * FROM admin WHERE adminID=$AdminID";
    
    // if($query['adminPwd'] != $PrePassword) {
    //     $_SESSION['passwordNotMatched'] = "<div class='error'>wrong pre-password.</div>";
    //     header('Location: http://localhost/php-projects/CommuniHub/admin/manage-admin.php');
    //     exit();
    // }   

    // Execute query
    $result = mysqli_query($dbc, $query);

    // Check if query is successful
    if ($result) {
        $num = mysqli_num_rows($result);

        if ($num == 1) {
            // user exists and password can be changed

            if ($NewPassword == $ConfirmPassword) {
                // update password
                $query2 = " UPDATE admin SET
                adminPwd='$NewPassword'
                WHERE adminID=$AdminID
                ";

                // execute the query
                $result2 = mysqli_query($dbc, $query2);

                // check query executed 
                if ($result2) {
                    // display success message
                    $_SESSION['ChangePassword'] = "<div class='success'>Password changed successfully.</div>";
                    header('Location: http://localhost/php-projects/CommuniHub/admin/manage-admin.php');
                    exit();
                } else {
                    // display error message
                    $_SESSION['ChangePassword'] = "<div class='error'>Password failed to change: " . mysqli_error($dbc) . "</div>";
                    header('Location: http://localhost/php-projects/CommuniHub/admin/manage-admin.php');
                    exit();
                }
            } else {
                // redirect to manage admin page
                $_SESSION['passwordNotMatched'] = "<div class='error'>Failed to change password admin: Passwords do not match.</div>";
                header('Location: http://localhost/php-projects/CommuniHub/admin/manage-admin.php');
                exit();
            }
        } else {
            // user does not exist
            $_SESSION['user-not-found'] = "<div class='error'>Failed to change password admin: User not found.</div>";
            header('Location: http://localhost/php-projects/CommuniHub/admin/manage-admin.php');
            exit();
        }
    } else {
        // display error message
        $_SESSION['ChangePassword'] = "<div class='error'>Password failed to change: " . mysqli_error($dbc) . "</div>";
        header('Location: http://localhost/php-projects/CommuniHub/admin/manage-admin.php');
        exit();
    }
}
?>

<?php include('includes/footer.php'); ?>
