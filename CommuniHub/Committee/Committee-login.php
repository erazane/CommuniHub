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

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        body {
            background-color: #f8f9fa; /* Set background color */
        }
        .login-box {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); /* Add shadow */
            padding: 20px;
            border-radius: 2px;
            background-color: #ffffff; /* Set background color */
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


// Check for empty input
if (isset($_POST['Submit'])) {
    $UserUserName = mysqli_real_escape_string($dbc, $_POST['UserUserName']);
    $inputPwd = crypt($_POST['UserPwd'], 'ahookdemok');
    
    $query = "SELECT user.*, commitee.CommiteeID FROM user INNER JOIN commitee ON user.UserID = commitee.UserID WHERE UserUserName='$UserUserName' ";
    $result = mysqli_query($dbc, $query);

    if (mysqli_num_rows($result) == 1) {
        // $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $userRow = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $UserUserName;
        $_SESSION['UserFirstName'] = $userRow['UserFirstName'];
        $_SESSION['UserLastName'] = $userRow['UserLastName'];

        header('Location: http://localhost/php-projects/CommuniHub/Committee/index.php');
    } else {
        // $_SESSION['login'] = "<div class='error text-center'>Username or password is incorrect.</div>";
        header('Location: http://localhost/php-projects/CommuniHub/Committee/Commmittee-login.php');
    }
}
?>
<div class="container-fluid">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-8">
            <div class="login-box"> <!-- Container for the form and image -->
                
                <div class="row">
                    <!-- Left column for image -->
                    <div class="col-md-6">
                        <img class="img-fluid login-image" src="../Administator/images/loginpic.jpg" alt="login picture">
                    </div>
                    <!-- Right column for user details -->
                    <div class="col-md-6">
                        <div class="login-title">
                            <h2>Committee Login</h2>
                            <!-- <p>Dont have an account? <a href="#" class="link-primary">Create your account here !</a></p> -->
                        </div>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                            <div class="user-details">
                                <div class="form-group">
                                    <h5>Username :</h5>
                                    <input type="text" class="form-control" id="UserUserName" name="UserUserName" placeholder="Enter username" required >
                                </div>
                                <div class="form-group">
                                     <h5>Password :</h5>
                                    <input type="password" class="form-control" id="UserPwd" name="UserPwd" placeholder="Enter password" required >
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
