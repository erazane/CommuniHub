<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="../user/loginStyle.css">
    </head>

    <body>
        <div class="login">
        <h1 class="text-center"> User Login</h1>
                      
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
            <input type="text" name="UserUserName" placeholder="Username">
            <br>
            <br>
            <label> Password </label>
            <input type="Password" name="UserPwd" placeholder="password">
            <br>
            <br>
            <input type="Submit" name="Submit" value="Login" class="btn-primary">

            </form>
                <br>
                <br>
           
        </div>
    </body>
</html>

<?php 

require_once ('../Database/database.php'); // Connect to the db.

if (isset($_POST['Submit'])) {
    $UserUserName = mysqli_real_escape_string($dbc, $_POST['UserUserName']);
    $UserPwd = crypt($_POST['UserPwd'], 'ahookdemok'); // Consider using password_hash() in the future

    $query = "SELECT * FROM user WHERE UserUserName='$UserUserName' AND UserPwd='$UserPwd'
    ";
    $result = @mysqli_query($dbc, $query); // Run the query.

    if (mysqli_num_rows($result) == 1) {

        while ($row=mysqli_fetch_assoc($result)) {
            $_SESSION['UserID'] = $row["UserID"];
        }

        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";

        //to check wheather the user is logged in or not and logount will unset it
        $_SESSION['user'] = $AdminUsername;

        header('Location: http://localhost/php-projects/CommuniHub/front-end/indexLogin.php');
        exit();
    } else {
        $_SESSION['login'] = "<div class='error text-center'>Username or password is incorrect.</div>";
        header('Location: http://localhost/php-projects/CommuniHub/user/userLogin.php');
        exit();
    }   
}
?>