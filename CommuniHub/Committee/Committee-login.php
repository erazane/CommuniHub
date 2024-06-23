<?php
session_start();
require_once ('../Database/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Committee Login Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-box {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            padding: 20px;
            border-radius: 2px;
            background-color: #ffffff;
        }
        .login-image {
            width: 100%;
            height: auto;
        }
        .login-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
            padding: 2%;
        }
    </style>
</head>
<body>

<?php
if (isset($_POST['Submit'])) {
    $UserUserName = mysqli_real_escape_string($dbc, $_POST['UserUserName']);
    $inputPwd = $_POST['UserPwd'];

    // Query to get the user details including the hashed password
    $query = "SELECT user.*, commitee.CommiteeID FROM user INNER JOIN commitee ON user.UserID = commitee.UserID WHERE UserUserName='$UserUserName'";
    $result = mysqli_query($dbc, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $userRow = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($inputPwd, $userRow['UserPwd'])) {
            $_SESSION['UserID'] = $userRow['UserID'];
            $_SESSION['user'] = $UserUserName;
            $_SESSION['UserFirstName'] = $userRow['UserFirstName'];
            $_SESSION['UserLastName'] = $userRow['UserLastName'];

            header('Location: http://localhost/php-projects/CommuniHub/Committee/index.php');
            exit();
        } else {
            $_SESSION['login_error'] = "Username or password is incorrect.";
        }
    } else {
        $_SESSION['login_error'] = "Username or password is incorrect.";
    }
}
?>

<div class="container-fluid">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-8">
            <div class="login-box">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-fluid login-image" src="../Administator/images/loginpic.jpg" alt="login picture">
                    </div>
                    <div class="col-md-6">
                        <div class="login-title">
                            <h2>Committee Login</h2>
                            <?php
                            if (isset($_SESSION['login_error'])) {
                                echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['login_error']) . '</div>';
                                unset($_SESSION['login_error']);
                            }
                            ?>
                        </div>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="user-details">
                                <div class="form-group">
                                    <h5>Username :</h5>
                                    <input type="text" class="form-control" id="UserUserName" name="UserUserName" placeholder="Enter username" required>
                                </div>
                                <div class="form-group">
                                     <h5>Password :</h5>
                                    <input type="password" class="form-control" id="UserPwd" name="UserPwd" placeholder="Enter password" required>
                                </div>
                                <div class="form-group">
                                    <input type="Submit" name="Submit" value="Login" class="btn btn-primary btn-lg btn-block btn-login">
                                    <a href="../front-end/index.php"class="btn btn-secondary btn-lg btn-block btn-back">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
