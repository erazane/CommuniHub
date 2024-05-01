<html>
    <head>
        <title>Admin Login Page</title>
        <link rel="stylesheet" href="../../CommuniHub/user/loginStyle.css">
    </head>

    <body>
        <div class="login">
        <h1 class="text-center"> Administrator Login</h1>
                      
            <br>
            <br>
            <br>

            <!--session for when login is successful-->
            <?php
            session_start();
            if(isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']); // Clear the message after displaying

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            }
            ?>
            <br>

            <!--start of login form-->
            <form action="#" method="post" class="text-center">
  

            <?php if(isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <label> Username </label>
            <input type="text" name="adminUserName" placeholder="Username">
            <br>
            <br>
            <label> Password </label>
            <input type="Password" name="adminPwd" placeholder="password">
            <br>
            <br>
            <input type="Submit" name="Submit" value="Login" class="btn-primary">

            </form>
                <br>
                <br>
            <p class="text-center">Final Year Project | Nazeera Binti Nasharuddin</p>
        </div>
    </body>
</html>

<?php 

require_once ('../Database/database.php'); // Connect to the db.

if (isset($_POST['Submit'])) {
    $AdminUsername = mysqli_real_escape_string($dbc, $_POST['adminUserName']);
    $AdminPassword = crypt($_POST['adminPwd'], 'ahookdemok'); // Consider using password_hash() in the future

    $query = "SELECT * FROM admin WHERE adminUserName='$AdminUsername' AND adminPwd='$AdminPassword'
    ";
    $result = @mysqli_query($dbc, $query); // Run the query.

    if (mysqli_num_rows($result) == 1) {

        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";

        //to check wheather the user is logged in or not and logount will unset it
        $_SESSION['user'] = $AdminUsername;

        header('Location: http://localhost/php-projects/CommuniHub/Administator/index.php');
        exit();
    } else {
        $_SESSION['login'] = "<div class='error text-center'>Username or password is incorrect.</div>";
        header('Location: http://localhost/php-projects/CommuniHub/Administator/admin-login.php');
        exit();
    }   
}
?>

