<?php include('includes/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change User Password</h1>
        <br>
        <br>

        <?php
            // Get id of the selected admin
            $UserID = isset($_GET['UserID']) ? $_GET['UserID'] : null;

            // Check if UserID is not set or not numeric
            if (!isset($UserID) || !is_numeric($UserID)) {
                header('Location: manage-user.php');
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
                        <input type="password" name="UserPwd" placeholder="Previous Password">
                    </td>
                </tr>

                <tr>
                    <td>
                        New Password:
                    </td>
                    <td>
                        <input type="password" name="NewUserPassword" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>
                        Confirm Password:
                    </td>
                    <td>
                        <input type="password" name="ConfirmUserPassword" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
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
    $UserID = $_POST['UserID'];
    // $PrePassword = md5($_POST['adminPwd']);
    $NewUserPassword = crypt($_POST['NewUserPassword'], $key);
    $ConfirmUserPassword = crypt($_POST['ConfirmUserPassword'], $key);
    $UserPwd = crypt($_POST['UserPwd'], $key);

    // Make update query.
    // $query = "SELECT * FROM admin WHERE UserID=$UserID AND adminPwd='$PrePassword'";
    $query = "SELECT * FROM user WHERE UserID=$UserID";
    
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
                $query2 = " UPDATE user SET
                UserPwd='$UserPwd'
                WHERE UserID=$UserID
                ";

                // execute the query
                $result2 = mysqli_query($dbc, $query2);

                // check query executed 
                if ($result2) {
                    // display success message
                    $_SESSION['ChangeUserPassword'] = "<div class='success'>Password changed successfully.</div>";
                    header('Location: http://localhost/php-projects/CommuniHub/admin/manage-user.php');
                    exit();
                } else {
                    // display error message
                    $_SESSION['ChangeUserPassword'] = "<div class='error'>Password failed to change: " . mysqli_error($dbc) . "</div>";
                    header('Location: http://localhost/php-projects/CommuniHub/admin/manage-user.php');
                    exit();
                }
            } else {
                // redirect to manage admin page
                $_SESSION['UserpasswordNotMatched'] = "<div class='error'>Failed to change password user: Passwords do not match.</div>";
                header('Location: http://localhost/php-projects/CommuniHub/admin/manage-user.php');
                exit();
            }
        } else {
            // user does not exist
            $_SESSION['user-not-found'] = "<div class='error'>Failed to change password user: User not found.</div>";
            header('Location: http://localhost/php-projects/CommuniHub/admin/manage-user.php');
            exit();
        }
    } else {
        // display error message
        $_SESSION['UserChangePassword'] = "<div class='error'>Password failed to change: " . mysqli_error($dbc) . "</div>";
        header('Location: http://localhost/php-projects/CommuniHub/admin/manage-user.php');
        exit();
    }
}
?>

<?php include('includes/footer.php'); ?>
