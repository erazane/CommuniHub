<html>
    <head>
        <title>Committee Login </title>
        <link rel="stylesheet" href="./loginStyle.css">

    </head>

    <body>
        <div class="login">
        <h1 class="text-center"> Committee Login</h1>
                      
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

            <?php 
                if(isset($_SESSION['login_page_error']))
                {
                    //display the session message
                    echo '<div class="session-message">' . $_SESSION['login_page_error'] . '</div>';   
                    //remove session message
                    unset($_SESSION['login_page_error']);
                }
            ?>

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
            <p class="text-center">Final Year Project | Nazeera Binti Nasharuddin</p>
        </div>
    </body>
</html>

<?php 

require_once ('../../Database/database.php'); // Connect to the db.
global $dbc;

if (isset($_POST['Submit'])) {
    $UserUserName = mysqli_real_escape_string($dbc, $_POST['UserUserName']);
    // Consider using password_hash() in the future
    $inputPwd = crypt($_POST['UserPwd'], 'ahookdemok');
    // echo $inputPwd; exit();

    if (empty($UserUserName)) {
        $errors[] = 'Please enter username.';
    }
    if (empty($inputPwd)) {
        $errors[] = 'Please enter password.';
    }

    // Display errors
    if (!empty($errors)) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
        exit();
    }

    $query = "SELECT user.*, commitee.CommiteeID FROM user INNER JOIN commitee ON user.UserID = commitee.UserID WHERE UserUserName='$UserUserName' ";

    $result = mysqli_query($dbc, $query); // Run the query.

    if (mysqli_num_rows($result) == 0) { // No rows returned
        $_SESSION['login_page_error'] = "<div class='error text-center'>Username does not exist.</div>";
        header('Location: http://localhost/php-projects/CommuniHub/commitee/login/commiteeLogin.php');
        exit();
    }

    while ($row=mysqli_fetch_assoc($result)) {
        $UserPwd = $row['UserPwd'];
        $_SESSION['UserID'] = $row["UserID"];
    }

    if ($UserPwd != $inputPwd) { // wrong password
        $_SESSION['login_page_error'] = "<div class='error text-center'>Username or password is incorrect.</div>";
        header('Location: http://localhost/php-projects/CommuniHub/commitee/login/commiteeLogin.php');
        exit();
    }


    $_SESSION['login'] = "<div class='success'>Login Successful.</div>";

    //to check wheather the user is logged in or not and logount will unset it
    $_SESSION['user'] = $UserUserName;


    header('Location: http://localhost/php-projects/CommuniHub/Committee/index.php');
    exit();

}

?>